<?define("INDEX_PAGE", "Y");?><?define("MAIN_PAGE", true);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Поварская форма в интернет-магазине Chef Works");
$APPLICATION->SetPageProperty("description", "Интернет-магазин Chef Works предлагает широкий выбор поварской формы от производителя. У нас вы можете купить поварские кители, фартуки, колпаки и многое другое!");

\Bitrix\Main\Loader::includeModule('iblock');
$arSelect = Array("ID", "NAME", "IBLOCK_ID", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "PREVIEW_TEXT");
$arFilter = Array("IBLOCK_ID"=>array(6, 14, 22), "PROPERTY_OPEN_GRAPH_VALUE" => "Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
if($ob = $res->GetNextElement())
{
 	$arFields = $ob->GetFields();
	$img = CFile::GetFileArray($arFields['PREVIEW_PICTURE']);
	$src = $img['SRC'];
	$url = $arFields['DETAIL_PAGE_URL'];
	$text = strip_tags($arFields['PREVIEW_TEXT']);
	$name = $arFields['NAME'];

	$APPLICATION->AddHeadString("<meta property='og:title' content='".$name."' />", true);
	 $APPLICATION->AddHeadString("<meta property='og:description' content='".$text."' />", true);
	 $APPLICATION->AddHeadString("<meta property='og:url' content='https://chefworks.ru".$url."' />", true);
	 $APPLICATION->AddHeadString("<meta property='og:type' content='website' />", true);
	 $APPLICATION->AddHeadString("<meta property='og:image' content='https://chefworks.ru".$src."' />", true);
} else {
	$APPLICATION->AddHeadString("<meta property='og:title' content='Chefworks.ru' />", true);
	 $APPLICATION->AddHeadString("<meta property='og:description' content='Официальный сайт производителя поварской формы Chef Works в России.' />", true);
	 $APPLICATION->AddHeadString("<meta property='og:url' content='https://chefworks.ru' />", true);
	 $APPLICATION->AddHeadString("<meta property='og:type' content='website' />", true);
	$APPLICATION->AddHeadString("<meta property='og:image' content='https://chefworks.ru/upload/og-main.png' />", true);
}?>
<div id="promoBlock">
		<?$APPLICATION->IncludeComponent(
	"dresscode:slider",
	"promoSlider",
	Array(
		"CACHE_TIME" => "3600000",
		"CACHE_TYPE" => "Y",
		"IBLOCK_ID" => "7",
		"IBLOCK_TYPE" => "slider",
		"PICTURE_HEIGHT" => "555",
		"PICTURE_WIDTH" => "1181"
	)
);?>
	</div>
	
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"indexBanners",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "indexBanners",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"ID",1=>"CODE",2=>"XML_ID",3=>"NAME",4=>"TAGS",5=>"SORT",6=>"PREVIEW_TEXT",7=>"PREVIEW_PICTURE",8=>"DETAIL_TEXT",9=>"DETAIL_PICTURE",10=>"DATE_ACTIVE_FROM",11=>"ACTIVE_FROM",12=>"DATE_ACTIVE_TO",13=>"ACTIVE_TO",14=>"SHOW_COUNTER",15=>"SHOW_COUNTER_START",16=>"IBLOCK_TYPE_ID",17=>"IBLOCK_ID",18=>"IBLOCK_CODE",19=>"IBLOCK_NAME",20=>"IBLOCK_EXTERNAL_ID",21=>"DATE_CREATE",22=>"CREATED_BY",23=>"CREATED_USER_NAME",24=>"TIMESTAMP_X",25=>"MODIFIED_BY",26=>"USER_NAME",27=>"",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "info",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "6",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Банеры",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"",1=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?>


<?$APPLICATION->IncludeComponent("dresscode:special.product", "special", array(
	"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "N",
		"CATALOG_ITEM_TEMPLATE" => "special",
		"COMPONENT_TEMPLATE" => "special",
		"CONVERT_CURRENCY" => "N",
		"ELEMENTS_COUNT" => "10",
		"HIDE_MEASURES" => "N",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "6",
		"IBLOCK_TYPE" => "info",
		"PICTURE_HEIGHT" => "181",
		"PICTURE_WIDTH" => "200",
		"PRODUCT_PRICE_CODE" => "",
		"PROP_NAME" => "PRODUCT_DAY",
		"SORT_PROPERTY_NAME" => "SORT",
		"SORT_VALUE" => "ASC"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?>


<?$APPLICATION->IncludeComponent(
	"dresscode:offers.product", 
	".default", 
	array(
		"CACHE_TIME" => "3600000",
		"CACHE_TYPE" => "Y",
		"CATALOG_ITEM_TEMPLATE" => ".default",
		"COMPONENT_TEMPLATE" => ".default",
		"CONVERT_CURRENCY" => "N",
		"ELEMENTS_COUNT" => "10",
		"HIDE_MEASURES" => "N",
		"HIDE_NOT_AVAILABLE" => "Y",
		"IBLOCK_ID" => "23",
		"IBLOCK_TYPE" => "1c_catalog",
		"PICTURE_HEIGHT" => "242",
		"PICTURE_WIDTH" => "266",
		"PRODUCT_PRICE_CODE" => array(
			0 => "Розничная цена",
		),
		"PROP_NAME" => "OFFERS",
		"PROP_VALUE" => array(
			0 => "_5584",
			1 => "_5581",
			2 => "_5582",
			3 => "_5583",
			4 => "_5580",
		),
		"SORT_PROPERTY_NAME" => "SORT",
		"SORT_VALUE" => "ASC"
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);?>

<?$APPLICATION->IncludeComponent(
	"dresscode:pop.section",
	".default",
	Array(
		"CACHE_TIME" => "3600000",
		"CACHE_TYPE" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"ELEMENTS_COUNT" => isMobile() ? "6" : "10",
		"IBLOCK_ID" => "23",
		"IBLOCK_TYPE" => "1c_catalog",
		"PICTURE_HEIGHT" => "143",
		"PICTURE_WIDTH" => "176",
		"POP_LAST_ELEMENT" => "Y",
		"PROP_NAME" => "UF_POPULAR",
		"PROP_VALUE" => "Y",
		"SELECT_FIELDS" => array(0=>"NAME",1=>"SECTION_PAGE_URL",2=>"DETAIL_PICTURE",3=>"UF_IMAGES",4=>"UF_MARKER",5=>"",),
		"SORT_PROPERTY_NAME" => "7",
		"SORT_VALUE" => "DESC"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?>
<?$APPLICATION->IncludeComponent(
	"dresscode:slider",
	"middle",
	Array(
		"CACHE_TIME" => "3600000",
		"CACHE_TYPE" => "Y",
		"IBLOCK_ID" => "8",
		"IBLOCK_TYPE" => "slider",
		"PICTURE_HEIGHT" => "202",
		"PICTURE_WIDTH" => "1476"
	)
);?>
	<div id="brandList" data-page="1">
		<a href="<?=SITE_DIR?>nam_doveryaut/"><span class="heading">Нам доверяют</span></a>

<?$APPLICATION->IncludeComponent(
	"dresscode:brands.list", 
	".default", 
	array(
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
		"ELEMENTS_COUNT" => isMobile() ? "6" : "15",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "info",
		"PICTURE_HEIGHT" => "144",
		"PICTURE_WIDTH" => "180",
		"PROP_NAME" => "",
		"PROP_VALUE" => "",
		"SELECT_FIELDS" => array(
			0 => "",
			1 => "*",
			2 => "",
		),
		"SORT_PROPERTY_NAME" => "sort",
		"SORT_VALUE" => "ASC",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);?>
</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	".default",
	Array(
		"AREA_FILE_RECURSIVE" => "Y",
		"AREA_FILE_SHOW" => "sect",
		"AREA_FILE_SUFFIX" => "simplyText",
		"COMPONENT_TEMPLATE" => ".default",
		"EDIT_TEMPLATE" => ""
	)
);?>

<!--Инстаграмм и Ютуб-->

<?/*
<div class="b-inst">
	<iframe class="inwidget" src='https://chefworks.ru/inwidget/index.php?width=800&inline=5&view=14&toolbar=false&adaptive=true' data-inwidget scrolling='no' frameborder='no' style='border:none;width:100%;height:420px;overflow:hidden;'></iframe>
</div>
<? 
$url = "https://www.youtube.com/feeds/videos.xml?channel_id=UCOMLHf-vXkfr8U6bhxmvi6w";
$buf = file_get_contents($url);
$movies = new SimpleXMLElement($buf);
?>

<div class="youtube-slider-box">
	<span><a href="https://www.youtube.com/channel/UCOMLHf-vXkfr8U6bhxmvi6w" target="_blank" class="heading" style="text-decoration: none;">
		Youtube</a>
	</span>
<div class="inner">
<div class="youtube-slider youtube-slider-js">
<?foreach($movies->entry as $key=>$video) {
	$video_id = $video->id;
	$code = str_replace("yt:video:", "", $video_id);
	?>
	<div class="slide">
	<div class="items js-videoWrapper">
		<button class="videoPoster js-videoPoster" style="background-image:url(//img.youtube.com/vi/<?=$code?>/0.jpg);"><img src="//img.youtube.com/vi/<?=$code?>/0.jpg" /></button>
<iframe class="videoIframe js-videoIframe" src="" frameborder="0" allowTransparency="true"  data-src="https://www.youtube.com/embed/<?=$code?>?autoplay=1& modestbranding=1&rel=0&hl=ru" allowfullscreen></iframe>
		<!--<iframe class="js-videoIframe" width="560" height="315" src="" data-src="https://www.youtube.com/embed/<?=$code?>" frameborder="0" allow="autoplay" allowfullscreen></iframe>-->

	</div>
	</div>
<?}  ?>
</div>
</div>
</div>
*/?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>