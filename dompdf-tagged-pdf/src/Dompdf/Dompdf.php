<?php
/**
 * @package dompdf
 * @link    http://dompdf.github.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @author  Fabien Ménager <fabien.menager@gmail.com>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */
namespace Dompdf;

use DOMDocument;
use DOMNode;
use Dompdf\Adapter\CPDF;
use DOMXPath;
use Dompdf\Frame;
use Dompdf\Frame\Factory;
use Dompdf\Frame\FrameTree;
use HTML5_Tokenizer;
use HTML5_TreeBuilder;
use Dompdf\Image\Cache;
use Dompdf\Renderer\ListBullet;
use Dompdf\Renderer;
use Dompdf\Css\Stylesheet;

/**
 * Dompdf - PHP5 HTML to PDF renderer
 *
 * Dompdf loads HTML and does its best to render it as a PDF.  It gets its
 * name from the new DomDocument PHP5 extension.  Source HTML is first
 * parsed by a DomDocument object.  Dompdf takes the resulting DOM tree and
 * attaches a {@link Frame} object to each node.  {@link Frame} objects store
 * positioning and layout information and each has a reference to a {@link
 * Style} object.
 *
 * Style information is loaded and parsed (see {@link Stylesheet}) and is
 * applied to the frames in the tree by using XPath.  CSS selectors are
 * converted into XPath queries, and the computed {@link Style} objects are
 * applied to the {@link Frame}s.
 *
 * {@link Frame}s are then decorated (in the design pattern sense of the
 * word) based on their CSS display property ({@link
 * http://www.w3.org/TR/CSS21/visuren.html#propdef-display}).
 * Frame_Decorators augment the basic {@link Frame} class by adding
 * additional properties and methods specific to the particular type of
 * {@link Frame}.  For example, in the CSS layout model, block frames
 * (display: block;) contain line boxes that are usually filled with text or
 * other inline frames.  The Block therefore adds a $lines
 * property as well as methods to add {@link Frame}s to lines and to add
 * additional lines.  {@link Frame}s also are attached to specific
 * AbstractPositioner and {@link AbstractFrameReflower} objects that contain the
 * positioining and layout algorithm for a specific type of frame,
 * respectively.  This is an application of the Strategy pattern.
 *
 * Layout, or reflow, proceeds recursively (post-order) starting at the root
 * of the document.  Space constraints (containing block width & height) are
 * pushed down, and resolved positions and sizes bubble up.  Thus, every
 * {@link Frame} in the document tree is traversed once (except for tables
 * which use a two-pass layout algorithm).  If you are interested in the
 * details, see the reflow() method of the Reflower classes.
 *
 * Rendering is relatively straightforward once layout is complete. {@link
 * Frame}s are rendered using an adapted {@link Cpdf} class, originally
 * written by Wayne Munro, http://www.ros.co.nz/pdf/.  (Some performance
 * related changes have been made to the original {@link Cpdf} class, and
 * the {@link Dompdf\Adapter\CPDF} class provides a simple, stateless interface to
 * PDF generation.)  PDFLib support has now also been added, via the {@link
 * Dompdf\Adapter\PDFLib}.
 *
 *
 * @package dompdf
 */
class Dompdf
{
    /**
     * DomDocument representing the HTML document
     *
     * @var DOMDocument
     */
    private $dom;

    /**
     * FrameTree derived from the DOM tree
     *
     * @var FrameTree
     */
    private $tree;

    /**
     * Stylesheet for the document
     *
     * @var Stylesheet
     */
    private $css;

    /**
     * @var Canvas
     * @deprecated
     */
    private $pdf;

    /**
     * Actual PDF renderer
     *
     * @var Canvas
     */
    private $canvas;

    /**
     * Desired paper size ('letter', 'legal', 'A4', etc.)
     *
     * @var string
     */
    private $paperSize;

    /**
     * Paper orientation ('portrait' or 'landscape')
     *
     * @var string
     */
    private $paperOrientation = "portrait";

    /**
     * Callbacks on new page and new element
     *
     * @var array
     */
    private $callbacks = array();

    /**
     * Experimental caching capability
     *
     * @var string
     */
    private $cacheId;

    /**
     * Base hostname
     *
     * Used for relative paths/urls
     * @var string
     */
    private $baseHost = "";

    /**
     * Absolute base path
     *
     * Used for relative paths/urls
     * @var string
     */
    private $basePath = "";

    /**
     * Protcol used to request file (file://, http://, etc)
     *
     * @var string
     */
    private $protocol;

    /**
     * HTTP context created with stream_context_create()
     * Will be used for file_get_contents
     *
     * @var resource
     */
    private $httpContext;

    /**
     * Timestamp of the script start time
     *
     * @var int
     */
    private $startTime = null;

    /**
     * The system's locale
     *
     * @var string
     */
    private $systemLocale = null;

    /**
     * Tells if the system's locale is the C standard one
     *
     * @var bool
     */
    private $localeStandard = false;

    /**
     * The default view of the PDF in the viewer
     *
     * @var string
     */
    private $defaultView = "Fit";

    /**
     * The default view options of the PDF in the viewer
     *
     * @var array
     */
    private $defaultViewOptions = array();

    /**
     * Tells wether the DOM document is in quirksmode (experimental)
     *
     * @var bool
     */
    private $quirksmode = false;

    /**
     * @var array
     */
    private $messages = array();

    /**
     * @var Options
     */
    private $options;

    /**
     * @var FontMetrics
     */
    private $fontMetrics;

    /**
     * The list of built-in fonts
     *
     * @var array
     * @deprecated
     */
    public static $native_fonts = array(
        "courier", "courier-bold", "courier-oblique", "courier-boldoblique",
        "helvetica", "helvetica-bold", "helvetica-oblique", "helvetica-boldoblique",
        "times-roman", "times-bold", "times-italic", "times-bolditalic",
        "symbol", "zapfdinbats"
    );

    /**
     * The list of built-in fonts
     *
     * @var array
     */
    public static $nativeFonts = array(
        "courier", "courier-bold", "courier-oblique", "courier-boldoblique",
        "helvetica", "helvetica-bold", "helvetica-oblique", "helvetica-boldoblique",
        "times-roman", "times-bold", "times-italic", "times-bolditalic",
        "symbol", "zapfdinbats"
    );

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->setOptions(new Options);

        $this->localeStandard = sprintf('%.1f', 1.0) == '1.0';
        $this->saveLocale();
        $this->paperSize = $this->options->getDefaultPaperSize();

        $this->setCanvas(CanvasFactory::get_instance($this, $this->paperSize, $this->paperOrientation));
        $this->setFontMetrics(new FontMetrics($this->getCanvas(), $this->getOptions()));
        $this->css = new Stylesheet($this);

        $this->restoreLocale();
    }

    /**
     * Save the system's locale configuration and
     * set the right value for numeric formatting
     */
    private function saveLocale()
    {
        if ($this->localeStandard) {
            return;
        }

        $this->systemLocale = setlocale(LC_NUMERIC, "0");
        setlocale(LC_NUMERIC, "C");
    }

    /**
     * Restore the system's locale configuration
     */
    private function restoreLocale()
    {
        if ($this->localeStandard) {
            return;
        }

        setlocale(LC_NUMERIC, $this->systemLocale);
    }

    /**
     * @param $file
     * @deprecated
     */
    public function load_html_file($file)
    {
        $this->loadHtmlFile($file);
    }

    /**
     * Loads an HTML file
     * Parse errors are stored in the global array _dompdf_warnings.
     *
     * @param string $file a filename or url to load
     *
     * @throws Exception
     */
    public function loadHtmlFile($file)
    {
        $this->saveLocale();

        // Store parsing warnings as messages (this is to prevent output to the
        // browser if the html is ugly and the dom extension complains,
        // preventing the pdf from being streamed.)
        if (!$this->protocol && !$this->baseHost && !$this->basePath) {
            list($this->protocol, $this->baseHost, $this->basePath) = Helpers::explode_url($file);
        }

        if (!$this->options->isRemoteEnabled() && ($this->protocol != "" && $this->protocol !== "file://")) {
            throw new Exception("Remote file requested, but remote file download is disabled.");
        }

        if ($this->protocol == "" || $this->protocol === "file://") {

            // Get the full path to $file, returns false if the file doesn't exist
            $realfile = realpath($file);
            if (!$realfile) {
                throw new Exception("File '$file' not found.");
            }

            $chroot = $this->options->getChroot();
            if (strpos($realfile, $chroot) !== 0) {
                throw new Exception("Permission denied on $file. The file could not be found under the directory specified by Options::chroot.");
            }

            // Exclude dot files (e.g. .htaccess)
            if (substr(basename($realfile), 0, 1) === ".") {
                throw new Exception("Permission denied on $file.");
            }

            $file = $realfile;
        }

        $contents = file_get_contents($file, null, $this->httpContext);
        $encoding = null;

        // See http://the-stickman.com/web-development/php/getting-http-response-headers-when-using-file_get_contents/
        if (isset($http_response_header)) {
            foreach ($http_response_header as $_header) {
                if (preg_match("@Content-Type:\s*[\w/]+;\s*?charset=([^\s]+)@i", $_header, $matches)) {
                    $encoding = strtoupper($matches[1]);
                    break;
                }
            }
        }

        $this->restoreLocale();

        $this->loadHtml($contents, $encoding);
    }

    /**
     * @param $str
     * @param null $encoding
     * @deprecated
     */
    public function load_html($str, $encoding = null)
    {
        $this->loadHtml($str, $encoding);
    }

    /**
     * Loads an HTML string
     * Parse errors are stored in the global array _dompdf_warnings.
     * @todo use the $encoding variable
     *
     * @param string $str HTML text to load
     * @param string $encoding Not used yet
     */
    public function loadHtml($str, $encoding = null)
    {
        $this->saveLocale();

        // FIXME: Determine character encoding, switch to UTF8, update meta tag. Need better http/file stream encoding detection, currently relies on text or meta tag.
        mb_detect_order('auto');

        if (mb_detect_encoding($str) !== 'UTF-8') {
            $metatags = array(
                '@<meta\s+http-equiv="Content-Type"\s+content="(?:[\w/]+)(?:;\s*?charset=([^\s"]+))?@i',
                '@<meta\s+content="(?:[\w/]+)(?:;\s*?charset=([^\s"]+))"?\s+http-equiv="Content-Type"@i',
                '@<meta [^>]*charset\s*=\s*["\']?\s*([^"\' ]+)@i',
            );

            foreach ($metatags as $metatag) {
                if (preg_match($metatag, $str, $matches)) break;
            }

            if (mb_detect_encoding($str) == '') {
                if (isset($matches[1])) {
                    $encoding = strtoupper($matches[1]);
                } else {
                    $encoding = 'UTF-8';
                }
            } else {
                if (isset($matches[1])) {
                    $encoding = strtoupper($matches[1]);
                } else {
                    $encoding = 'auto';
                }
            }

            if ($encoding !== 'UTF-8') {
                $str = mb_convert_encoding($str, 'UTF-8', $encoding);
            }

            if (isset($matches[1])) {
                $str = preg_replace('/charset=([^\s"]+)/i', 'charset=UTF-8', $str);
            } else {
                $str = str_replace('<head>', '<head><meta http-equiv="Content-Type" content="text/html;charset=UTF-8">', $str);
            }
        } else {
            $encoding = 'UTF-8';
        }

        // remove BOM mark from UTF-8, it's treated as document text by DOMDocument
        // FIXME: roll this into the encoding detection using UTF-8/16/32 BOM (http://us2.php.net/manual/en/function.mb-detect-encoding.php#91051)?
        if (substr($str, 0, 3) == chr(0xEF) . chr(0xBB) . chr(0xBF)) {
            $str = substr($str, 3);
        }

        // Parse embedded php, first-pass
        if ($this->options->isPhpEnabled()) {
            ob_start();
            eval("?" . ">$str");
            $str = ob_get_clean();
        }

        // if the document contains non utf-8 with a utf-8 meta tag chars and was
        // detected as utf-8 by mbstring, problems could happen.
        // http://devzone.zend.com/article/8855
        if ($encoding !== 'UTF-8') {
            $re = '/<meta ([^>]*)((?:charset=[^"\' ]+)([^>]*)|(?:charset=["\'][^"\' ]+["\']))([^>]*)>/i';
            $str = preg_replace($re, '<meta $1$3>', $str);
        }

        // Store parsing warnings as messages
        set_error_handler(array("\\Dompdf\\Helpers", "record_warnings"));

        // @todo Take the quirksmode into account
        // http://hsivonen.iki.fi/doctype/
        // https://developer.mozilla.org/en/mozilla's_quirks_mode
        $quirksmode = false;

        if ($this->options->isHtml5ParserEnabled()) {
            $tokenizer = new HTML5_Tokenizer($str);
            $tokenizer->parse();
            $doc = $tokenizer->save();

            // Remove #text children nodes in nodes that shouldn't have
            $tag_names = array("html", "table", "tbody", "thead", "tfoot", "tr");
            foreach ($tag_names as $tag_name) {
                $nodes = $doc->getElementsByTagName($tag_name);

                foreach ($nodes as $node) {
                    self::remove_text_nodes($node);
                }
            }

            $quirksmode = ($tokenizer->getTree()->getQuirksMode() > HTML5_TreeBuilder::NO_QUIRKS);
        } else {
            // loadHTML assumes ISO-8859-1 unless otherwise specified, but there are
            // bugs in how DOMDocument determines the actual encoding. Converting to
            // HTML-ENTITIES prior to import appears to resolve the issue.
            // http://devzone.zend.com/1538/php-dom-xml-extension-encoding-processing/ (see #4)
            // http://stackoverflow.com/a/11310258/264628
            $doc = new DOMDocument();
            $doc->preserveWhiteSpace = true;
            $doc->loadHTML(mb_convert_encoding($str, 'HTML-ENTITIES', 'UTF-8'));

            // If some text is before the doctype, we are in quirksmode
            if (preg_match("/^(.+)<!doctype/i", ltrim($str), $matches)) {
                $quirksmode = true;
            } // If no doctype is provided, we are in quirksmode
            elseif (!preg_match("/^<!doctype/i", ltrim($str), $matches)) {
                $quirksmode = true;
            } else {
                // HTML5 <!DOCTYPE html>
                if (!$doc->doctype->publicId && !$doc->doctype->systemId) {
                    $quirksmode = false;
                }

                // not XHTML
                if (!preg_match("/xhtml/i", $doc->doctype->publicId)) {
                    $quirksmode = true;
                }
            }
        }

        $this->dom = $doc;
        $this->quirksmode = $quirksmode;

        $this->tree = new FrameTree($this->dom);

        restore_error_handler();

        $this->restoreLocale();
    }

    /**
     * @param DOMNode $node
     * @deprecated
     */
    public static function remove_text_nodes(DOMNode $node)
    {
        self::removeTextNodes($node);
    }

    /**
     * @param DOMNode $node
     */
    public static function removeTextNodes(DOMNode $node)
    {
        $children = array();
        for ($i = 0; $i < $node->childNodes->length; $i++) {
            $child = $node->childNodes->item($i);
            if ($child->nodeName === "#text") {
                $children[] = $child;
            }
        }

        foreach ($children as $child) {
            $node->removeChild($child);
        }
    }

    /**
     * Builds the {@link FrameTree}, loads any CSS and applies the styles to
     * the {@link FrameTree}
     */
    private function processHtml()
    {
        $this->tree->build_tree();

        $this->css->load_css_file(Stylesheet::getDefaultStylesheet(), Stylesheet::ORIG_UA);

        $acceptedmedia = Stylesheet::$ACCEPTED_GENERIC_MEDIA_TYPES;
        $acceptedmedia[] = $this->options->getDefaultMediaType();

        // <base href="" />
        $base_nodes = $this->dom->getElementsByTagName("base");
        if ($base_nodes->length && ($href = $base_nodes->item(0)->getAttribute("href"))) {
            list($this->protocol, $this->baseHost, $this->basePath) = Helpers::explode_url($href);
        }

        // Set the base path of the Stylesheet to that of the file being processed
        $this->css->set_protocol($this->protocol);
        $this->css->set_host($this->baseHost);
        $this->css->set_base_path($this->basePath);

        // Get all the stylesheets so that they are processed in document order
        $xpath = new DOMXPath($this->dom);
        $stylesheets = $xpath->query("//*[name() = 'link' or name() = 'style']");

        foreach ($stylesheets as $tag) {
            switch (strtolower($tag->nodeName)) {
                // load <link rel="STYLESHEET" ... /> tags
                case "link":
                    if (mb_strtolower(stripos($tag->getAttribute("rel"), "stylesheet") !== false) || // may be "appendix stylesheet"
                        mb_strtolower($tag->getAttribute("type")) === "text/css"
                    ) {
                        //Check if the css file is for an accepted media type
                        //media not given then always valid
                        $formedialist = preg_split("/[\s\n,]/", $tag->getAttribute("media"), -1, PREG_SPLIT_NO_EMPTY);
                        if (count($formedialist) > 0) {
                            $accept = false;
                            foreach ($formedialist as $type) {
                                if (in_array(mb_strtolower(trim($type)), $acceptedmedia)) {
                                    $accept = true;
                                    break;
                                }
                            }

                            if (!$accept) {
                                //found at least one mediatype, but none of the accepted ones
                                //Skip this css file.
                                continue;
                            }
                        }

                        $url = $tag->getAttribute("href");
                        $url = Helpers::build_url($this->protocol, $this->baseHost, $this->basePath, $url);

                        $this->css->load_css_file($url, Stylesheet::ORIG_AUTHOR);
                    }
                    break;

                // load <style> tags
                case "style":
                    // Accept all <style> tags by default (note this is contrary to W3C
                    // HTML 4.0 spec:
                    // http://www.w3.org/TR/REC-html40/present/styles.html#adef-media
                    // which states that the default media type is 'screen'
                    if ($tag->hasAttributes() &&
                        ($media = $tag->getAttribute("media")) &&
                        !in_array($media, $acceptedmedia)
                    ) {
                        continue;
                    }

                    $css = "";
                    if ($tag->hasChildNodes()) {
                        $child = $tag->firstChild;
                        while ($child) {
                            $css .= $child->nodeValue; // Handle <style><!-- blah --></style>
                            $child = $child->nextSibling;
                        }
                    } else {
                        $css = $tag->nodeValue;
                    }

                    $this->css->load_css($css);
                    break;
            }
        }
    }

    /**
     * @param string $cacheId
     * @deprecated
     */
    public function enable_caching($cacheId)
    {
        $this->enableCaching($cacheId);
    }

    /**
     * Enable experimental caching capability
     *
     * @param string $cacheId
     */
    public function enableCaching($cacheId)
    {
        $this->cacheId = $cacheId;
    }

    /**
     * @param string $value
     * @return bool
     * @deprecated
     */
    public function parse_default_view($value)
    {
        return $this->parseDefaultView($value);
    }

    /**
     * @param string $value
     * @return bool
     */
    public function parseDefaultView($value)
    {
        $valid = array("XYZ", "Fit", "FitH", "FitV", "FitR", "FitB", "FitBH", "FitBV");

        $options = preg_split("/\s*,\s*/", trim($value));
        $defaultView = array_shift($options);

        if (!in_array($defaultView, $valid)) {
            return false;
        }

        $this->setDefaultView($defaultView, $options);
        return true;
    }

    /**
     * Renders the HTML to PDF
     */
    public function render()
    {
        $this->saveLocale();

        $logOutputFile = $this->options->getLogOutputFile();
        if ($logOutputFile) {
            if (!file_exists($logOutputFile) && is_writable(dirname($logOutputFile))) {
                touch($logOutputFile);
            }

            $this->startTime = microtime(true);
            ob_start();
        }

        //enable_mem_profile();

        $this->processHtml();

        $this->css->apply_styles($this->tree);

        // @page style rules : size, margins
        $pageStyles = $this->css->get_page_styles();

        $basePageStyle = $pageStyles["base"];
        unset($pageStyles["base"]);

        foreach ($pageStyles as $pageStyle) {
            $pageStyle->inherit($basePageStyle);
        }

        if (is_array($basePageStyle->size)) {
            $this->setPaper(array(0, 0, $basePageStyle->size[0], $basePageStyle->size[1]));
        }
        
        //TODO: We really shouldn't be doing this; properties were already set in the constructor. We should add Canvas methods to set the page size and orientation after instantiaion.
        $this->setCanvas(CanvasFactory::get_instance($this, $this->paperSize, $this->paperOrientation));
        $this->setFontMetrics(new FontMetrics($this->pdf, $this->getOptions()));

        if ($this->options->isFontSubsettingEnabled() && $this->pdf instanceof CPDF) {
            foreach ($this->tree->get_frames() as $frame) {
                $style = $frame->get_style();
                $node = $frame->get_node();

                // Handle text nodes
                if ($node->nodeName === "#text") {
                    $this->getCanvas()->register_string_subset($style->font_family, $node->nodeValue);
                    continue;
                }

                // Handle generated content (list items)
                if ($style->display === "list-item") {
                    $chars = ListBullet::get_counter_chars($style->list_style_type);
                    $this->getCanvas()->register_string_subset($style->font_family, $chars);
                    continue;
                }

                // Handle other generated content (pseudo elements)
                // FIXME: This only captures the text of the stylesheet declaration,
                //        not the actual generated content, and forces all possible counter
                //        values. See notes in issue #750.
                if ($frame->get_node()->nodeName == "dompdf_generated") {
                    // all possible counter values
                    $chars = ListBullet::get_counter_chars('decimal');
                    $this->getCanvas()->register_string_subset($style->font_family, $chars);
                    $chars = ListBullet::get_counter_chars('upper-alpha');
                    $this->getCanvas()->register_string_subset($style->font_family, $chars);
                    $chars = ListBullet::get_counter_chars('lower-alpha');
                    $this->getCanvas()->register_string_subset($style->font_family, $chars);
                    $chars = ListBullet::get_counter_chars('lower-greek');
                    $this->getCanvas()->register_string_subset($style->font_family, $chars);
                    // the text of the stylesheet declaration
                    $this->getCanvas()->register_string_subset($style->font_family, $style->content);
                    continue;
                }
            }
        }

        $root = null;

        foreach ($this->tree->get_frames() as $frame) {
            // Set up the root frame
            if (is_null($root)) {
                $root = Factory::decorate_root($this->tree->get_root(), $this);
                continue;
            }

            // Create the appropriate decorators, reflowers & positioners.
            Factory::decorate_frame($frame, $this, $root);
        }

        // Add meta information
        $title = $this->dom->getElementsByTagName("title");
        if ($title->length) {
            $this->getCanvas()->add_info("Title", trim($title->item(0)->nodeValue));
        }

        $metas = $this->dom->getElementsByTagName("meta");
        $labels = array(
            "author" => "Author",
            "keywords" => "Keywords",
            "description" => "Subject",
        );
        foreach ($metas as $meta) {
            $name = mb_strtolower($meta->getAttribute("name"));
            $value = trim($meta->getAttribute("content"));

            if (isset($labels[$name])) {
                $this->pdf->add_info($labels[$name], $value);
                continue;
            }

            if ($name === "dompdf.view" && $this->parseDefaultView($value)) {
                $this->getCanvas()->set_default_view($this->defaultView, $this->defaultViewOptions);
            }
        }

        $root->set_containing_block(0, 0, $this->getCanvas()->get_width(), $this->getCanvas()->get_height());
        $root->set_renderer(new Renderer($this));

        // This is where the magic happens:
        $root->reflow();

        // Clean up cached images
        Cache::clear();

        global $_dompdf_warnings, $_dompdf_show_warnings;
        if ($_dompdf_show_warnings) {
            echo '<b>Dompdf Warnings</b><br><pre>';
            foreach ($_dompdf_warnings as $msg) {
                echo $msg . "\n";
            }
            echo $this->getCanvas()->get_cpdf()->messages;
            echo '</pre>';
            flush();
        }

        $this->restoreLocale();
    }

    /**
     * Add meta information to the PDF after rendering
     */
    public function add_info($label, $value)
    {
        if (!is_null($this->pdf)) {
            $this->pdf->add_info($label, $value);
        }
    }

    /**
     * Writes the output buffer in the log file
     *
     * @return void
     */
    private function write_log()
    {
        $log_output_file = $this->get_option("log_output_file");
        if (!$log_output_file || !is_writable($log_output_file)) {
            return;
        }

        $frames = Frame::$ID_COUNTER;
        $memory = Helpers::DOMPDF_memory_usage() / 1024;
        $time = (microtime(true) - $this->startTime) * 1000;

        $out = sprintf(
            "<span style='color: #000' title='Frames'>%6d</span>" .
            "<span style='color: #009' title='Memory'>%10.2f KB</span>" .
            "<span style='color: #900' title='Time'>%10.2f ms</span>" .
            "<span  title='Quirksmode'>  " .
            ($this->quirksmode ? "<span style='color: #d00'> ON</span>" : "<span style='color: #0d0'>OFF</span>") .
            "</span><br />", $frames, $memory, $time);

        $out .= ob_get_clean();

        $log_output_file = $this->get_option("log_output_file");
        file_put_contents($log_output_file, $out);
    }

    /**
     * Streams the PDF to the client
     *
     * The file will open a download dialog by default.  The options
     * parameter controls the output.  Accepted options are:
     *
     * 'Accept-Ranges' => 1 or 0 - if this is not set to 1, then this
     *    header is not included, off by default this header seems to
     *    have caused some problems despite the fact that it is supposed
     *    to solve them, so I am leaving it off by default.
     *
     * 'compress' = > 1 or 0 - apply content stream compression, this is
     *    on (1) by default
     *
     * 'Attachment' => 1 or 0 - if 1, force the browser to open a
     *    download dialog, on (1) by default
     *
     * @param string $filename the name of the streamed file
     * @param array $options header options (see above)
     */
    public function stream($filename, $options = null)
    {
        $this->saveLocale();

        $this->write_log();

        if (!is_null($this->pdf)) {
            $this->pdf->stream($filename, $options);
        }

        $this->restoreLocale();
    }

    /**
     * Returns the PDF as a string
     *
     * The file will open a download dialog by default.  The options
     * parameter controls the output.  Accepted options are:
     *
     *
     * 'compress' = > 1 or 0 - apply content stream compression, this is
     *    on (1) by default
     *
     *
     * @param array $options options (see above)
     *
     * @return string
     */
    public function output($options = null)
    {
        $this->saveLocale();

        $this->write_log();

        if (is_null($this->pdf)) {
            return null;
        }

        $output = $this->pdf->output($options);

        $this->restoreLocale();

        return $output;
    }

    /**
     * @return string
     * @deprecated
     */
    public function output_html()
    {
        return $this->outputHtml();
    }

    /**
     * Returns the underlying HTML document as a string
     *
     * @return string
     */
    public function outputHtml()
    {
        return $this->dom->saveHTML();
    }

    /**
     * Get the dompdf option value
     *
     * @param string $key
     * @return mixed
     * @deprecated
     */
    public function get_option($key)
    {
        return $this->options->get($key);
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     * @deprecated
     */
    public function set_option($key, $value)
    {
        $this->options->set($key, $value);
        return $this;
    }

    /**
     * @param array $options
     * @return $this
     * @deprecated
     */
    public function set_options(array $options)
    {
        $this->options->set($options);
        return $this;
    }

    /**
     * @param string $size
     * @param string $orientation
     * @deprecated
     */
    public function set_paper($size, $orientation = "portrait")
    {
        $this->setPaper($size, $orientation);
    }

    /**
     * Sets the paper size & orientation
     *
     * @param string $size 'letter', 'legal', 'A4', etc. {@link Dompdf\Adapter\CPDF::$PAPER_SIZES}
     * @param string $orientation 'portrait' or 'landscape'
     * @return $this
     */
    public function setPaper($size, $orientation = "portrait")
    {
        $this->paperSize = $size;
        $this->paperOrientation = $orientation;
        return $this;
    }

    /**
     * @param FrameTree $tree
     * @return $this
     */
    public function setTree(FrameTree $tree)
    {
        $this->tree = $tree;
        return $this;
    }

    /**
     * @return FrameTree
     * @deprecated
     */
    public function get_tree()
    {
        return $this->getTree();
    }

    /**
     * Returns the underlying {@link FrameTree} object
     *
     * @return FrameTree
     */
    public function getTree()
    {
        return $this->tree;
    }

    /**
     * @param string $protocol
     * @return $this
     * @deprecated
     */
    public function set_protocol($protocol)
    {
        return $this->setProtocol($protocol);
    }

    /**
     * Sets the protocol to use
     * FIXME validate these
     *
     * @param string $protocol
     * @return $this
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
        return $this;
    }

    /**
     * @return string
     * @deprecated
     */
    public function get_protocol()
    {
        return $this->getProtocol();
    }

    /**
     * Returns the protocol in use
     *
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @param string $host
     * @deprecated
     */
    public function set_host($host)
    {
        $this->setBaseHost($host);
    }

    /**
     * Sets the base hostname
     *
     * @param string $baseHost
     * @return $this
     */
    public function setBaseHost($baseHost)
    {
        $this->baseHost = $baseHost;
        return $this;
    }

    /**
     * @return string
     * @deprecated
     */
    public function get_host()
    {
        return $this->getBaseHost();
    }

    /**
     * Returns the base hostname
     *
     * @return string
     */
    public function getBaseHost()
    {
        return $this->baseHost;
    }

    /**
     * Sets the base path
     *
     * @param string $path
     * @deprecated
     */
    public function set_base_path($path)
    {
        $this->setBasePath($path);
    }

    /**
     * Sets the base path
     *
     * @param string $basePath
     * @return $this
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
        return $this;
    }

    /**
     * @return string
     * @deprecated
     */
    public function get_base_path()
    {
        return $this->getBasePath();
    }

    /**
     * Returns the base path
     *
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * @param string $default_view The default document view
     * @param array $options The view's options
     * @return $this
     * @deprecated
     */
    public function set_default_view($default_view, $options)
    {
        return $this->setDefaultView($default_view, $options);
    }

    /**
     * Sets the default view
     *
     * @param string $defaultView The default document view
     * @param array $options The view's options
     * @return $this
     */
    public function setDefaultView($defaultView, $options)
    {
        $this->defaultView = $defaultView;
        $this->defaultViewOptions = $options;
        return $this;
    }

    /**
     * @param resource $http_context
     * @return $this
     * @deprecated
     */
    public function set_http_context($http_context)
    {
        return $this->setHttpContext($http_context);
    }

    /**
     * Sets the HTTP context
     *
     * @param resource $httpContext
     * @return $this
     */
    public function setHttpContext($httpContext)
    {
        $this->httpContext = $httpContext;
        return $this;
    }

    /**
     * @return resource
     * @deprecated
     */
    public function get_http_context()
    {
        return $this->getHttpContext();
    }

    /**
     * Returns the HTTP context
     *
     * @return resource
     */
    public function getHttpContext()
    {
        return $this->httpContext;
    }

    /**
     * @param Canvas $canvas
     * @return $this
     */
    public function setCanvas(Canvas $canvas)
    {
        $this->pdf = $canvas;
        $this->canvas = $canvas;
        return $this;
    }

    /**
     * @return Canvas
     * @deprecated
     */
    public function get_canvas()
    {
        return $this->getCanvas();
    }

    /**
     * Return the underlying Canvas instance (e.g. Dompdf\Adapter\CPDF, Dompdf\Adapter\GD)
     *
     * @return Canvas
     */
    public function getCanvas()
    {
        if (null === $this->canvas && null !== $this->pdf) {
            return $this->pdf;
        }
        return $this->canvas;
    }

    /**
     * @param Stylesheet $css
     * @return $this
     */
    public function setCss(Stylesheet $css)
    {
        $this->css = $css;
        return $this;
    }

    /**
     * @return Stylesheet
     * @deprecated
     */
    public function get_css()
    {
        return $this->getCss();
    }

    /**
     * Returns the stylesheet
     *
     * @return Stylesheet
     */
    public function getCss()
    {
        return $this->css;
    }

    /**
     * @param DOMDocument $dom
     * @return $this
     */
    public function setDom(DOMDocument $dom)
    {
        $this->dom = $dom;
        return $this;
    }

    /**
     * @return DOMDocument
     * @deprecated
     */
    public function get_dom()
    {
        return $this->getDom();
    }

    /**
     * @return DOMDocument
     */
    public function getDom()
    {
        return $this->dom;
    }

    /**
     * @param Options $options
     * @return $this
     */
    public function setOptions(Options $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return Options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @return array
     * @deprecated
     */
    public function get_callbacks()
    {
        return $this->getCallbacks();
    }

    /**
     * Returns the callbacks array
     *
     * @return array
     */
    public function getCallbacks()
    {
        return $this->callbacks;
    }

    /**
     * @param array $callbacks the set of callbacks to set
     * @deprecated
     */
    public function set_callbacks($callbacks)
    {
        $this->setCallbacks($callbacks);
    }

    /**
     * Sets callbacks for events like rendering of pages and elements.
     * The callbacks array contains arrays with 'event' set to 'begin_page',
     * 'end_page', 'begin_frame', or 'end_frame' and 'f' set to a function or
     * object plus method to be called.
     *
     * The function 'f' must take an array as argument, which contains info
     * about the event.
     *
     * @param array $callbacks the set of callbacks to set
     */
    public function setCallbacks($callbacks)
    {
        if (is_array($callbacks)) {
            $this->callbacks = array();
            foreach ($callbacks as $c) {
                if (is_array($c) && isset($c['event']) && isset($c['f'])) {
                    $event = $c['event'];
                    $f = $c['f'];
                    if (is_callable($f) && is_string($event)) {
                        $this->callbacks[$event][] = $f;
                    }
                }
            }
        }
    }

    /**
     * @return boolean
     * @deprecated
     */
    public function get_quirksmode()
    {
        return $this->getQuirksmode();
    }

    /**
     * Get the quirks mode
     *
     * @return boolean true if quirks mode is active
     */
    public function getQuirksmode()
    {
        return $this->quirksmode;
    }

    /**
     * @param FontMetrics $fontMetrics
     * @return $this
     */
    public function setFontMetrics(FontMetrics $fontMetrics)
    {
        $this->fontMetrics = $fontMetrics;
        return $this;
    }

    /**
     * @return FontMetrics
     */
    public function getFontMetrics()
    {
        return $this->fontMetrics;
    }
}