<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Страница поиска");
?><?$APPLICATION->IncludeComponent(
	"dresscode:search", 
	"search", 
	array(
		"IBLOCK_TYPE" => "1c_catalog",
		"IBLOCK_ID" => "23",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600000",
		"PRICE_CODE" => array(
			0 => "Розничная цена",
		),
		"COMPONENT_TEMPLATE" => "search",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB",
		"PROPERTY_CODE" => array(
			0 => "BLOG_POST_ID",
			1 => "BLOG_COMMENTS_CNT",
			2 => "CML2_ARTICLE",
			3 => "OFFERS",
			4 => "ATT_BRAND",
			5 => "COLLECTION",
			6 => "TOTAL_OUTPUT_POWER",
			7 => "VID_ZASTECHKI",
			8 => "VID_SUMKI",
			9 => "VIDEO",
			10 => "VYSOTA_RUCHEK",
			11 => "WARRANTY",
			12 => "OTSEKOV",
			13 => "CONVECTION",
			14 => "NAZNAZHENIE",
			15 => "BULK",
			16 => "PODKLADKA",
			17 => "SEASON",
			18 => "REF",
			19 => "COUNTRY_BRAND",
			20 => "SKU_COLOR",
			21 => "DELIVERY",
			22 => "PICKUP",
			23 => "USER_ID",
			24 => "VOTE_COUNT",
			25 => "SHOW_MENU",
			26 => "SIMILAR_PRODUCT",
			27 => "RATING",
			28 => "RELATED_PRODUCT",
			29 => "VOTE_SUM",
			30 => "COLOR",
			31 => "ZOOM2",
			32 => "BATTERY_LIFE",
			33 => "SWITCH",
			34 => "GRAF_PROC",
			35 => "LENGTH_OF_CORD",
			36 => "DISPLAY",
			37 => "LOADING_LAUNDRY",
			38 => "FULL_HD_VIDEO_RECORD",
			39 => "INTERFACE",
			40 => "COMPRESSORS",
			41 => "Number_of_Outlets",
			42 => "MAX_RESOLUTION_VIDEO",
			43 => "MAX_BUS_FREQUENCY",
			44 => "MAX_RESOLUTION",
			45 => "FREEZER",
			46 => "POWER_SUB",
			47 => "POWER",
			48 => "HARD_DRIVE_SPACE",
			49 => "MEMORY",
			50 => "OS",
			51 => "ZOOM",
			52 => "PAPER_FEED",
			53 => "SUPPORTED_STANDARTS",
			54 => "VIDEO_FORMAT",
			55 => "SUPPORT_2SIM",
			56 => "MP3",
			57 => "ETHERNET_PORTS",
			58 => "MATRIX",
			59 => "CAMERA",
			60 => "PHOTOSENSITIVITY",
			61 => "DEFROST",
			62 => "SPEED_WIFI",
			63 => "SPIN_SPEED",
			64 => "PRINT_SPEED",
			65 => "SOCKET",
			66 => "IMAGE_STABILIZER",
			67 => "GSM",
			68 => "SIM",
			69 => "TYPE",
			70 => "MEMORY_CARD",
			71 => "TYPE_BODY",
			72 => "TYPE_MOUSE",
			73 => "TYPE_PRINT",
			74 => "CONNECTION",
			75 => "TYPE_OF_CONTROL",
			76 => "TYPE_DISPLAY",
			77 => "TYPE2",
			78 => "REFRESH_RATE",
			79 => "RANGE",
			80 => "AMOUNT_MEMORY",
			81 => "MEMORY_CAPACITY",
			82 => "VIDEO_BRAND",
			83 => "DIAGONAL",
			84 => "RESOLUTION",
			85 => "TOUCH",
			86 => "CORES",
			87 => "LINE_PROC",
			88 => "PROCESSOR",
			89 => "CLOCK_SPEED",
			90 => "TYPE_PROCESSOR",
			91 => "PROCESSOR_SPEED",
			92 => "HARD_DRIVE",
			93 => "HARD_DRIVE_TYPE",
			94 => "Number_of_memory_slots",
			95 => "MAXIMUM_MEMORY_FREQUENCY",
			96 => "TYPE_MEMORY",
			97 => "BLUETOOTH",
			98 => "FM",
			99 => "GPS",
			100 => "HDMI",
			101 => "SMART_TV",
			102 => "USB",
			103 => "WIFI",
			104 => "FLASH",
			105 => "ROTARY_DISPLAY",
			106 => "SUPPORT_3D",
			107 => "SUPPORT_3G",
			108 => "WITH_COOLER",
			109 => "FINGERPRINT",
			110 => "HTML",
			111 => "PROFILE",
			112 => "GAS_CONTROL",
			113 => "GRILL",
			114 => "MORE_PROPERTIES",
			115 => "GENRE",
			116 => "INTAKE_POWER",
			117 => "SURFACE_COATING",
			118 => "brand_tyres",
			119 => "SEASONOST",
			120 => "DUST_COLLECTION",
			121 => "DRYING",
			122 => "REMOVABLE_TOP_COVER",
			123 => "CONTROL",
			124 => "FINE_FILTER",
			125 => "FORM_FAKTOR",
			126 => "MARKER_PHOTO",
			127 => "NEW",
			128 => "DELIVERY_DESC",
			129 => "SALE",
			130 => "MARKER",
			131 => "POPULAR",
			132 => "WEIGHT",
			133 => "HEIGHT",
			134 => "DEPTH",
			135 => "WIDTH",
			136 => "",
		),
		"HIDE_NOT_AVAILABLE" => "Y",
		"CONVERT_CASE" => "N",
		"HIDE_MEASURES" => "N",
		"FILTER_PRICE_CODE" => array(
			0 => "Розничная цена",
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>