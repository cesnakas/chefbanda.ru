<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Наши магазины");?><h1><?$APPLICATION->IncludeComponent(
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
		"ROOT_MENU_TYPE" => "about_footer",
		"USE_EXT" => "N"
	)
);?><br>
 </h1>
<h1><?$APPLICATION->ShowTitle(true)?></h1>
 <br>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.store", 
	"stores_2", 
	array(
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "stores_2",
		"EMAIL" => "Y",
		"MAP_TYPE" => "0",
		"PHONE" => "Y",
		"SCHEDULE" => "Y",
		"SEF_FOLDER" => "/stores1/",
		"SEF_MODE" => "Y",
		"SET_TITLE" => "N",
		"TITLE" => "Список складов с подробной информацией",
		"SEF_URL_TEMPLATES" => array(
			"liststores" => "",
			"element" => "#store_id#/",
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>