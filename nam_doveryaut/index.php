<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Нам доверяют. Мы дорожим нашими клиентами и партнерами - они доверили нам стиль своей компании.");
$APPLICATION->SetPageProperty("title", "Клиенты и партнеры компании Chef Works");
$APPLICATION->SetTitle("Нам доверяют");
?><h1><?=$APPLICATION->showTitle(false);?></h1>
 <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"personal",
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "",
		"COMPONENT_TEMPLATE" => "personal",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(),
		"MENU_CACHE_TIME" => "3600000",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "left2",
		"USE_EXT" => "N"
	)
);?> <?
$letters = array();
$arSelect = Array("ID", "NAME", "IBLOCK_ID", "PROPERTY_BRAND_NAME");
$arFilter = Array("IBLOCK_ID"=>1, "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>500), $arSelect);
while($ob = $res->GetNextElement())
{
 	$arFields = $ob->GetFields();
	$letter = strtoupper(substr($arFields['PROPERTY_BRAND_NAME_VALUE'], 0, 1));
	if($letter && !in_array($letter, $letters)){
		$letters[] = $letter;
	}
}
sort($letters);
?>

<script>
	$(document).ready(function(){
		$("ul.first_ul li a").click(function(){
			var letter = $(this).text();
			$.ajax({
				type: "POST",
				url: '/ajax/changeBrand.php',
				data:{letter: letter},
				success: function(data){
					$("#brandList").html(data);
				}
			});
		});
	});
</script>
<?$APPLICATION->IncludeComponent(
	"bitrix:news",
	"brands",
	Array(
		"ADD_ELEMENT_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"CHECK_DATES" => "Y",
		"COLOR_NEW" => "3E74E6",
		"COLOR_OLD" => "C0C0C0",
		"COMPONENT_TEMPLATE" => "brands",
		"DETAIL_ACTIVE_DATE_FORMAT" => "",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array(0=>"",1=>"",),
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => array(0=>"",1=>"",),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DISPLAY_AS_RATING" => "rating",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FILTER_PRICE_CODE" => array(),
		"FONT_MAX" => "50",
		"FONT_MIN" => "10",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"HIDE_MEASURES" => "N",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "info",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"LIST_ACTIVE_DATE_FORMAT" => "",
		"LIST_FIELD_CODE" => array(0=>"ID",1=>"CODE",2=>"XML_ID",3=>"NAME",4=>"TAGS",5=>"SORT",6=>"PREVIEW_TEXT",7=>"PREVIEW_PICTURE",8=>"DETAIL_TEXT",9=>"DETAIL_PICTURE",10=>"",),
		"LIST_PROPERTY_CODE" => array(0=>"OFFERS",1=>"",),
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "100",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "Производители",
		"PERIOD_NEW_TAGS" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PRODUCT_CONVERT_CURRENCY" => "Y",
		"PRODUCT_CURRENCY_ID" => "RUB",
		"PRODUCT_FILTER_NAME" => "arrFilter",
		"PRODUCT_IBLOCK_ID" => "15",
		"PRODUCT_IBLOCK_TYPE" => "catalog",
		"PRODUCT_PRICE_CODE" => array(0=>"BASE",),
		"PRODUCT_PROPERTY_CODE" => array(0=>"OFFERS",1=>"ATT_BRAND",2=>"COLLECTION",3=>"TOTAL_OUTPUT_POWER",4=>"VID_ZASTECHKI",5=>"VID_SUMKI",6=>"VIDEO",7=>"VYSOTA_RUCHEK",8=>"WARRANTY",9=>"OTSEKOV",10=>"CONVECTION",11=>"NAZNAZHENIE",12=>"BULK",13=>"PODKLADKA",14=>"SEASON",15=>"REF",16=>"COUNTRY_BRAND",17=>"SKU_COLOR",18=>"CML2_ARTICLE",19=>"DELIVERY",20=>"PICKUP",21=>"USER_ID",22=>"BLOG_POST_ID",23=>"BLOG_COMMENTS_CNT",24=>"VOTE_COUNT",25=>"SHOW_MENU",26=>"SIMILAR_PRODUCT",27=>"RATING",28=>"RELATED_PRODUCT",29=>"VOTE_SUM",30=>"COLOR",31=>"ZOOM2",32=>"BATTERY_LIFE",33=>"SWITCH",34=>"GRAF_PROC",35=>"LENGTH_OF_CORD",36=>"DISPLAY",37=>"LOADING_LAUNDRY",38=>"FULL_HD_VIDEO_RECORD",39=>"INTERFACE",40=>"COMPRESSORS",41=>"Number_of_Outlets",42=>"MAX_RESOLUTION_VIDEO",43=>"MAX_BUS_FREQUENCY",44=>"MAX_RESOLUTION",45=>"FREEZER",46=>"POWER_SUB",47=>"POWER",48=>"HARD_DRIVE_SPACE",49=>"MEMORY",50=>"OS",51=>"ZOOM",52=>"PAPER_FEED",53=>"SUPPORTED_STANDARTS",54=>"VIDEO_FORMAT",55=>"SUPPORT_2SIM",56=>"MP3",57=>"ETHERNET_PORTS",58=>"MATRIX",59=>"CAMERA",60=>"PHOTOSENSITIVITY",61=>"DEFROST",62=>"SPEED_WIFI",63=>"SPIN_SPEED",64=>"PRINT_SPEED",65=>"SOCKET",66=>"IMAGE_STABILIZER",67=>"GSM",68=>"SIM",69=>"TYPE",70=>"MEMORY_CARD",71=>"TYPE_BODY",72=>"TYPE_MOUSE",73=>"TYPE_PRINT",74=>"CONNECTION",75=>"TYPE_OF_CONTROL",76=>"TYPE_DISPLAY",77=>"TYPE2",78=>"REFRESH_RATE",79=>"RANGE",80=>"AMOUNT_MEMORY",81=>"MEMORY_CAPACITY",82=>"VIDEO_BRAND",83=>"DIAGONAL",84=>"RESOLUTION",85=>"TOUCH",86=>"CORES",87=>"LINE_PROC",88=>"PROCESSOR",89=>"CLOCK_SPEED",90=>"TYPE_PROCESSOR",91=>"PROCESSOR_SPEED",92=>"HARD_DRIVE",93=>"HARD_DRIVE_TYPE",94=>"Number_of_memory_slots",95=>"MAXIMUM_MEMORY_FREQUENCY",96=>"TYPE_MEMORY",97=>"BLUETOOTH",98=>"FM",99=>"GPS",100=>"HDMI",101=>"SMART_TV",102=>"USB",103=>"WIFI",104=>"FLASH",105=>"ROTARY_DISPLAY",106=>"SUPPORT_3D",107=>"SUPPORT_3G",108=>"WITH_COOLER",109=>"FINGERPRINT",110=>"HTML",111=>"PROFILE",112=>"GAS_CONTROL",113=>"GRILL",114=>"MORE_PROPERTIES",115=>"GENRE",116=>"INTAKE_POWER",117=>"SURFACE_COATING",118=>"brand_tyres",119=>"SEASONOST",120=>"DUST_COLLECTION",121=>"DRYING",122=>"REMOVABLE_TOP_COVER",123=>"CONTROL",124=>"FINE_FILTER",125=>"FORM_FAKTOR",126=>"MARKER_PHOTO",127=>"NEW",128=>"DELIVERY_DESC",129=>"SALE",130=>"MARKER",131=>"POPULAR",132=>"WEIGHT",133=>"HEIGHT",134=>"DEPTH",135=>"WIDTH",136=>"",),
		"SEF_FOLDER" => "/nam_doveryaut/",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => array("news"=>"","section"=>"","detail"=>"#ELEMENT_CODE#/",),
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "TIMESTAMP_X",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N",
		"TAGS_CLOUD_ELEMENTS" => "150",
		"TAGS_CLOUD_WIDTH" => "100%",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N"
	)
);?>
<?$APPLICATION->IncludeComponent(
	"dresscode:slider",
	"middle",
	Array(
		"CACHE_TIME" => "3600000",
		"CACHE_TYPE" => "Y",
		"COMPONENT_TEMPLATE" => "middle",
		"IBLOCK_ID" => "9",
		"IBLOCK_TYPE" => "slider",
		"PICTURE_HEIGHT" => "202",
		"PICTURE_WIDTH" => "1476"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>