<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Где купить поварскую форму Bandit, адреса магазинов");
$APPLICATION->SetPageProperty("description", "Адреса магазинов поварской формы Bandit. Поварская униформа от производителя. Ждем Вас каждый день с 10:00-20:00.");
$APPLICATION->SetTitle("Наши магазины");?>
<h1>О компании</h1>
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
		"ROOT_MENU_TYPE" => "about_footer",
		"USE_EXT" => "N"
	)
);?>
 <br>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.store",
	".default",
	Array(
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
		"EMAIL" => "Y",
		"MAP_TYPE" => "0",
		"PHONE" => "Y",
		"SCHEDULE" => "Y",
		"SEF_FOLDER" => "/stores/",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => array("liststores"=>"","element"=>"#store_id#/",),
		"SET_TITLE" => "N",
		"TITLE" => "Список складов с подробной информацией"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>