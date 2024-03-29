<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Каталог формы для поваров в интернет-магазине Chef Banda");
$APPLICATION->SetPageProperty("description", "В каталоге интернет-магазина формы для поваров Chef Banda представлена только профессиональная униформа.");
$APPLICATION->SetTitle("Лучшая цена");
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:catalog", 
	"detail", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_ELEMENT_CHAIN" => "Y",
		"ADD_PICT_PROP" => "MORE_PHOTO",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_SECTION_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"ALSO_BUY_ELEMENT_COUNT" => "4",
		"ALSO_BUY_MIN_BUYES" => "1",
		"BASKET_URL" => "/personal/cart/",
		"BIG_DATA_RCM_TYPE" => "any",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHEAPER_FORM_ID" => "3",
		"COMMON_ADD_TO_BASKET_ACTION" => "ADD",
		"COMMON_SHOW_CLOSE_POPUP" => "N",
		"COMPATIBLE_MODE" => "N",
		"COMPONENT_TEMPLATE" => "detail",
		"CONVERT_CURRENCY" => "N",
		"CURRENCY_ID" => "RUB",
		"DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
		"DETAIL_ADD_TO_BASKET_ACTION" => array(
			0 => "BUY",
		),
		"DETAIL_BACKGROUND_IMAGE" => "-",
		"DETAIL_BLOG_EMAIL_NOTIFY" => "N",
		"DETAIL_BLOG_URL" => "catalog_comments",
		"DETAIL_BLOG_USE" => "Y",
		"DETAIL_BRAND_PROP_CODE" => array(
			0 => "",
			1 => "BRAND_REF",
			2 => "",
		),
		"DETAIL_BRAND_USE" => "Y",
		"DETAIL_BROWSER_TITLE" => "-",
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
		"DETAIL_DETAIL_PICTURE_MODE" => "IMG",
		"DETAIL_DISPLAY_NAME" => "Y",
		"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
		"DETAIL_FB_APP_ID" => "",
		"DETAIL_FB_USE" => "Y",
		"DETAIL_META_DESCRIPTION" => "-",
		"DETAIL_META_KEYWORDS" => "-",
		"DETAIL_OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_OFFERS_PROPERTY_CODE" => array(
			0 => "RAZMER_OBUVI",
			1 => "RAZMER_ODEZHDY_",
			2 => "TSVET",
			3 => "OBHVAT_GRUDI",
			4 => "OBHVAT_TALII",
			5 => "INNER_SHOV",
			6 => "CML2_ARTICLE",
			7 => "RAZMER",
			8 => "ARTNUMBER",
			9 => "SIZES_SHOES",
			10 => "SIZES_CLOTHES",
			11 => "RAZMER",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "SOSTAV",
			1 => "BLOG_POST_ID",
			2 => "BLOG_COMMENTS_CNT",
			3 => "SHOW_MENU",
			4 => "CML2_ARTICLE",
			5 => "MINIMUM_PRICE",
			6 => "OFFERS",
			7 => "NEWPRODUCT",
			8 => "ATT_BRAND",
			9 => "PRODUCT_DAY",
			10 => "COLLECTION",
			11 => "TOTAL_OUTPUT_POWER",
			12 => "VID_ZASTECHKI",
			13 => "VID_SUMKI",
			14 => "VIDEO",
			15 => "VYSOTA_RUCHEK",
			16 => "WARRANTY",
			17 => "OTSEKOV",
			18 => "CONVECTION",
			19 => "NAZNAZHENIE",
			20 => "BULK",
			21 => "PODKLADKA",
			22 => "SEASON",
			23 => "REF",
			24 => "COUNTRY_BRAND",
			25 => "SKU_COLOR",
			26 => "DELIVERY",
			27 => "PICKUP",
			28 => "USER_ID",
			29 => "VOTE_COUNT",
			30 => "SIMILAR_PRODUCT",
			31 => "RATING",
			32 => "RELATED_PRODUCT",
			33 => "VOTE_SUM",
			34 => "TIMER_LOOP",
			35 => "TIMER_DATE",
			36 => "COLOR",
			37 => "ZOOM2",
			38 => "BATTERY_LIFE",
			39 => "SWITCH",
			40 => "GRAF_PROC",
			41 => "LENGTH_OF_CORD",
			42 => "DISPLAY",
			43 => "LOADING_LAUNDRY",
			44 => "FULL_HD_VIDEO_RECORD",
			45 => "INTERFACE",
			46 => "COMPRESSORS",
			47 => "Number_of_Outlets",
			48 => "MAX_RESOLUTION_VIDEO",
			49 => "MAX_BUS_FREQUENCY",
			50 => "MAX_RESOLUTION",
			51 => "FREEZER",
			52 => "POWER_SUB",
			53 => "POWER",
			54 => "HARD_DRIVE_SPACE",
			55 => "MEMORY",
			56 => "OS",
			57 => "ZOOM",
			58 => "PAPER_FEED",
			59 => "SUPPORTED_STANDARTS",
			60 => "VIDEO_FORMAT",
			61 => "SUPPORT_2SIM",
			62 => "MP3",
			63 => "ETHERNET_PORTS",
			64 => "MATRIX",
			65 => "CAMERA",
			66 => "PHOTOSENSITIVITY",
			67 => "DEFROST",
			68 => "SPEED_WIFI",
			69 => "SPIN_SPEED",
			70 => "PRINT_SPEED",
			71 => "SOCKET",
			72 => "IMAGE_STABILIZER",
			73 => "GSM",
			74 => "SIM",
			75 => "TYPE",
			76 => "MEMORY_CARD",
			77 => "TYPE_BODY",
			78 => "TYPE_MOUSE",
			79 => "TYPE_PRINT",
			80 => "CONNECTION",
			81 => "TYPE_OF_CONTROL",
			82 => "TYPE_DISPLAY",
			83 => "TYPE2",
			84 => "REFRESH_RATE",
			85 => "RANGE",
			86 => "AMOUNT_MEMORY",
			87 => "MEMORY_CAPACITY",
			88 => "VIDEO_BRAND",
			89 => "DIAGONAL",
			90 => "RESOLUTION",
			91 => "TOUCH",
			92 => "CORES",
			93 => "LINE_PROC",
			94 => "PROCESSOR",
			95 => "CLOCK_SPEED",
			96 => "TYPE_PROCESSOR",
			97 => "PROCESSOR_SPEED",
			98 => "HARD_DRIVE",
			99 => "HARD_DRIVE_TYPE",
			100 => "Number_of_memory_slots",
			101 => "MAXIMUM_MEMORY_FREQUENCY",
			102 => "TYPE_MEMORY",
			103 => "BLUETOOTH",
			104 => "FM",
			105 => "GPS",
			106 => "HDMI",
			107 => "SMART_TV",
			108 => "USB",
			109 => "WIFI",
			110 => "FLASH",
			111 => "ROTARY_DISPLAY",
			112 => "SUPPORT_3D",
			113 => "SUPPORT_3G",
			114 => "WITH_COOLER",
			115 => "FINGERPRINT",
			116 => "VOZRAST",
			117 => "ENERGOPOTREB",
			118 => "OBOROTY",
			119 => "MINI_BAR",
			120 => "SIZES_PRODUCT",
			121 => "DISPLAY_TYPE",
			122 => "TIP_ELEMENTOV_PITANIA",
			123 => "BELKI",
			124 => "ZHIRY",
			125 => "CALORIES",
			126 => "UGLEVODY",
			127 => "PROFILE",
			128 => "GAS_CONTROL",
			129 => "GRILL",
			130 => "MORE_PROPERTIES",
			131 => "GENRE",
			132 => "MATERIAL",
			133 => "INTAKE_POWER",
			134 => "SURFACE_COATING",
			135 => "brand_tyres",
			136 => "SEASONOST",
			137 => "DUST_COLLECTION",
			138 => "DRYING",
			139 => "REMOVABLE_TOP_COVER",
			140 => "TEST_TEST",
			141 => "CONTROL",
			142 => "FINE_FILTER",
			143 => "FORM_FAKTOR",
			144 => "MAXIMUM_PRICE",
			145 => "HTML",
			146 => "199",
			147 => "ATT_BRAND2",
			148 => "MANUFACTURER",
			149 => "RAZMER",
		),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
		"DETAIL_SHOW_BASIS_PRICE" => "Y",
		"DETAIL_SHOW_MAX_QUANTITY" => "N",
		"DETAIL_STRICT_SECTION_CHECK" => "Y",
		"DETAIL_USE_COMMENTS" => "Y",
		"DETAIL_USE_VOTE_RATING" => "Y",
		"DETAIL_VK_USE" => "N",
		"DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_CHEAPER" => "N",
		"DISPLAY_OFFERS_TABLE" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "id",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "asc",
		"FIELDS" => array(
			0 => "TITLE",
			1 => "ADDRESS",
			2 => "DESCRIPTION",
			3 => "PHONE",
			4 => "SCHEDULE",
			5 => "EMAIL",
			6 => "IMAGE_ID",
			7 => "COORDINATES",
			8 => "",
		),
		"FILE_404" => "",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "arrFilter",
		"FILTER_OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PRICE_CODE" => array(
			0 => "BASE",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "OFFERS",
			1 => "ATT_BRAND",
			2 => "COLOR",
			3 => "ZOOM2",
			4 => "BATTERY_LIFE",
			5 => "SWITCH",
			6 => "GRAF_PROC",
			7 => "LENGTH_OF_CORD",
			8 => "DISPLAY",
			9 => "LOADING_LAUNDRY",
			10 => "FULL_HD_VIDEO_RECORD",
			11 => "INTERFACE",
			12 => "COMPRESSORS",
			13 => "Number_of_Outlets",
			14 => "MAX_RESOLUTION_VIDEO",
			15 => "MAX_BUS_FREQUENCY",
			16 => "MAX_RESOLUTION",
			17 => "FREEZER",
			18 => "POWER_SUB",
			19 => "POWER",
			20 => "HARD_DRIVE_SPACE",
			21 => "MEMORY",
			22 => "OS",
			23 => "ZOOM",
			24 => "PAPER_FEED",
			25 => "SUPPORTED_STANDARTS",
			26 => "VIDEO_FORMAT",
			27 => "SUPPORT_2SIM",
			28 => "MP3",
			29 => "ETHERNET_PORTS",
			30 => "MATRIX",
			31 => "CAMERA",
			32 => "PHOTOSENSITIVITY",
			33 => "DEFROST",
			34 => "SPEED_WIFI",
			35 => "SPIN_SPEED",
			36 => "PRINT_SPEED",
			37 => "SOCKET",
			38 => "IMAGE_STABILIZER",
			39 => "GSM",
			40 => "SIM",
			41 => "TYPE",
			42 => "MEMORY_CARD",
			43 => "TYPE_BODY",
			44 => "TYPE_MOUSE",
			45 => "TYPE_PRINT",
			46 => "CONNECTION",
			47 => "TYPE_OF_CONTROL",
			48 => "TYPE_DISPLAY",
			49 => "TYPE2",
			50 => "REFRESH_RATE",
			51 => "RANGE",
			52 => "AMOUNT_MEMORY",
			53 => "MEMORY_CAPACITY",
			54 => "VIDEO_BRAND",
			55 => "DIAGONAL",
			56 => "RESOLUTION",
			57 => "TOUCH",
			58 => "CORES",
			59 => "LINE_PROC",
			60 => "PROCESSOR",
			61 => "CLOCK_SPEED",
			62 => "TYPE_PROCESSOR",
			63 => "PROCESSOR_SPEED",
			64 => "HARD_DRIVE",
			65 => "HARD_DRIVE_TYPE",
			66 => "Number_of_memory_slots",
			67 => "MAXIMUM_MEMORY_FREQUENCY",
			68 => "TYPE_MEMORY",
			69 => "BLUETOOTH",
			70 => "FM",
			71 => "GPS",
			72 => "HDMI",
			73 => "SMART_TV",
			74 => "USB",
			75 => "WIFI",
			76 => "FLASH",
			77 => "ROTARY_DISPLAY",
			78 => "SUPPORT_3D",
			79 => "SUPPORT_3G",
			80 => "WITH_COOLER",
			81 => "FINGERPRINT",
			82 => "COLLECTION",
			83 => "TOTAL_OUTPUT_POWER",
			84 => "VID_ZASTECHKI",
			85 => "VID_SUMKI",
			86 => "PROFILE",
			87 => "VYSOTA_RUCHEK",
			88 => "GAS_CONTROL",
			89 => "WARRANTY",
			90 => "GRILL",
			91 => "MORE_PROPERTIES",
			92 => "GENRE",
			93 => "OTSEKOV",
			94 => "CONVECTION",
			95 => "INTAKE_POWER",
			96 => "NAZNAZHENIE",
			97 => "BULK",
			98 => "PODKLADKA",
			99 => "SURFACE_COATING",
			100 => "brand_tyres",
			101 => "SEASON",
			102 => "SEASONOST",
			103 => "DUST_COLLECTION",
			104 => "REF",
			105 => "COUNTRY_BRAND",
			106 => "DRYING",
			107 => "REMOVABLE_TOP_COVER",
			108 => "TEST_TEST",
			109 => "CONTROL",
			110 => "FINE_FILTER",
			111 => "FORM_FAKTOR",
			112 => "SKU_COLOR",
			113 => "CML2_ARTICLE",
			114 => "DELIVERY",
			115 => "PICKUP",
			116 => "USER_ID",
			117 => "BLOG_POST_ID",
			118 => "VIDEO",
			119 => "BLOG_COMMENTS_CNT",
			120 => "VOTE_COUNT",
			121 => "SHOW_MENU",
			122 => "SIMILAR_PRODUCT",
			123 => "RATING",
			124 => "RELATED_PRODUCT",
			125 => "VOTE_SUM",
			126 => "",
		),
		"FILTER_VIEW_MODE" => "VERTICAL",
		"FORUM_ID" => "1",
		"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "12",
		"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
		"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "12",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
		"GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "12",
		"GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "Y",
		"HIDE_AVAILABLE_TAB" => "N",
		"HIDE_DELIVERY_CALC" => "N",
		"HIDE_MEASURES" => "N",
		"HIDE_NOT_AVAILABLE" => "Y",
		"HIDE_NOT_AVAILABLE_OFFERS" => "Y",
		"IBLOCK_ID" => "23",
		"IBLOCK_TYPE" => "1c_catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "3",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"LINK_IBLOCK_ID" => "",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_PROPERTY_SID" => "",
		"LIST_BROWSER_TITLE" => "-",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_META_KEYWORDS" => "-",
		"LIST_OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_OFFERS_LIMIT" => "0",
		"LIST_OFFERS_PROPERTY_CODE" => array(
			0 => "RAZMER",
			1 => "SIZES_SHOES",
			2 => "SIZES_CLOTHES",
			3 => "ARTNUMBER",
			4 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "BLOG_POST_ID",
			1 => "BLOG_COMMENTS_CNT",
			2 => "SHOW_MENU",
			3 => "CML2_ARTICLE",
			4 => "MINIMUM_PRICE",
			5 => "OFFERS",
			6 => "NEWPRODUCT",
			7 => "ATT_BRAND",
			8 => "PRODUCT_DAY",
			9 => "COLLECTION",
			10 => "TOTAL_OUTPUT_POWER",
			11 => "VID_ZASTECHKI",
			12 => "VID_SUMKI",
			13 => "VIDEO",
			14 => "VYSOTA_RUCHEK",
			15 => "WARRANTY",
			16 => "OTSEKOV",
			17 => "CONVECTION",
			18 => "NAZNAZHENIE",
			19 => "BULK",
			20 => "PODKLADKA",
			21 => "SEASON",
			22 => "REF",
			23 => "COUNTRY_BRAND",
			24 => "SKU_COLOR",
			25 => "DELIVERY",
			26 => "PICKUP",
			27 => "USER_ID",
			28 => "VOTE_COUNT",
			29 => "SIMILAR_PRODUCT",
			30 => "RATING",
			31 => "RELATED_PRODUCT",
			32 => "VOTE_SUM",
			33 => "TIMER_LOOP",
			34 => "TIMER_DATE",
			35 => "COLOR",
			36 => "ZOOM2",
			37 => "BATTERY_LIFE",
			38 => "SWITCH",
			39 => "GRAF_PROC",
			40 => "LENGTH_OF_CORD",
			41 => "DISPLAY",
			42 => "LOADING_LAUNDRY",
			43 => "FULL_HD_VIDEO_RECORD",
			44 => "INTERFACE",
			45 => "COMPRESSORS",
			46 => "Number_of_Outlets",
			47 => "MAX_RESOLUTION_VIDEO",
			48 => "MAX_BUS_FREQUENCY",
			49 => "MAX_RESOLUTION",
			50 => "FREEZER",
			51 => "POWER_SUB",
			52 => "POWER",
			53 => "HARD_DRIVE_SPACE",
			54 => "MEMORY",
			55 => "OS",
			56 => "ZOOM",
			57 => "PAPER_FEED",
			58 => "SUPPORTED_STANDARTS",
			59 => "VIDEO_FORMAT",
			60 => "SUPPORT_2SIM",
			61 => "MP3",
			62 => "ETHERNET_PORTS",
			63 => "MATRIX",
			64 => "CAMERA",
			65 => "PHOTOSENSITIVITY",
			66 => "DEFROST",
			67 => "SPEED_WIFI",
			68 => "SPIN_SPEED",
			69 => "PRINT_SPEED",
			70 => "SOCKET",
			71 => "IMAGE_STABILIZER",
			72 => "GSM",
			73 => "SIM",
			74 => "TYPE",
			75 => "MEMORY_CARD",
			76 => "TYPE_BODY",
			77 => "TYPE_MOUSE",
			78 => "TYPE_PRINT",
			79 => "CONNECTION",
			80 => "TYPE_OF_CONTROL",
			81 => "RAZMER",
		),
		"MAIN_TITLE" => "Наличие на складах",
		"MESSAGES_PER_PAGE" => "10",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_COMPARE" => "Сравнение",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"MIN_AMOUNT" => "10",
		"OFFERS_CART_PROPERTIES" => array(
		),
		"OFFERS_SORT_FIELD" => "",
		"OFFERS_SORT_FIELD2" => "",
		"OFFERS_SORT_ORDER" => "",
		"OFFERS_SORT_ORDER2" => "",
		"OFFERS_TABLE_DISPLAY_PICTURE_COLUMN" => "Y",
		"OFFERS_TABLE_PAGER_COUNT" => "10",
		"OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
		"OFFER_TREE_PROPS" => array(
			0 => "TSVET",
		),
		"PAGER_BASE_LINK" => "",
		"PAGER_BASE_LINK_ENABLE" => "Y",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
		"PAGER_PARAMS_NAME" => "arrPager",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "round",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "30",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
		"PRICE_CODE" => array(
			0 => "Розничная цена",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"PRODUCT_DISPLAY_MODE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"QUANTITY_FLOAT" => "N",
		"REVIEW_AJAX_POST" => "Y",
		"REVIEW_IBLOCK_ID" => "23",
		"REVIEW_IBLOCK_TYPE" => "1c_catalog",
		"SALE_IBLOCK_ID" => "6",
		"SALE_IBLOCK_TYPE" => "info",
		"SECTIONS_SHOW_PARENT_NAME" => "N",
		"SECTIONS_VIEW_MODE" => "TEXT",
		"SECTION_ADD_TO_BASKET_ACTION" => "ADD",
		"SECTION_BACKGROUND_IMAGE" => "-",
		"SECTION_COUNT_ELEMENTS" => "Y",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_TOP_DEPTH" => "4",
		"SEF_FOLDER" => "/catalog/",
		"SEF_MODE" => "Y",
		"SERVICES_IBLOCK_ID" => "11",
		"SERVICES_IBLOCK_TYPE" => "info",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_404" => "Y",
		"SHOW_AVAILABLE_TAB" => "Y",
		"SHOW_DEACTIVATED" => "N",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_EMPTY_STORE" => "Y",
		"SHOW_GENERAL_STORE_INFORMATION" => "N",
		"SHOW_LINK_TO_FORUM" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SECTION_BANNER" => "Y",
		"SHOW_SERVICES" => "Y",
		"SHOW_TOP_ELEMENTS" => "N",
		"STORES" => array(
			0 => "1",
		),
		"STORE_PATH" => "/store/#store_id#",
		"TEMPLATE_THEME" => "site",
		"TOP_ADD_TO_BASKET_ACTION" => "ADD",
		"URL_TEMPLATES_READ" => "",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"USE_ALSO_BUY" => "N",
		"USE_BIG_DATA" => "Y",
		"USE_CAPTCHA" => "Y",
		"USE_COMMON_SETTINGS_BASKET_POPUP" => "N",
		"USE_COMPARE" => "N",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_FILTER" => "Y",
		"USE_GIFTS_DETAIL" => "Y",
		"USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
		"USE_GIFTS_SECTION" => "Y",
		"USE_MAIN_ELEMENT_SECTION" => "Y",
		"USE_MIN_AMOUNT" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "Y",
		"USE_REVIEW" => "Y",
		"USE_SALE_BESTSELLERS" => "Y",
		"USE_STORE" => "N",
		"USE_STORE_PHONE" => "Y",
		"USE_STORE_SCHEDULE" => "Y",
		"SEF_URL_TEMPLATES" => array(
			"sections" => "",
			"section" => "#SECTION_CODE#/",
			"element" => "#SECTION_CODE#/#ELEMENT_CODE#/",
			"compare" => "compare/",
			"smart_filter" => "#SECTION_CODE#/filter/#SMART_FILTER_PATH#/apply/",
		)
	),
	false
);?>
<? //echo $APPLICATION->GetTitle(); ?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
