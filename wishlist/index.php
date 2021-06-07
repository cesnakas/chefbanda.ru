<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Избранное");?><h1>Избранное</h1><?$APPLICATION->IncludeComponent(
	"dresscode:wishlist", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_TYPE" => "1c_catalog",
		"IBLOCK_ID" => "23",
		"PRICE_CODE" => array(
			0 => "Розничная цена",
		),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600000",
		"HIDE_MEASURES" => "N",
		"CONVERT_CURRENCY" => "N",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		)
	),
	false
);?><br /><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>