<? 
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); 
global $APPLICATION;
$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"dresscode:menu.sections", 
	"", 
	array(
		"IBLOCK_TYPE" => "1c_catalog",
		"IBLOCK_ID" => "23",
		"DEPTH_LEVEL" => "2",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600000",
		"IS_SEF" => "N",
		"ID" => $_REQUEST["ID"],
		"SECTION_URL" => "",
		"CALC_COUNT_ELEMENTS_IN_SECTION" => "N"
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
); 
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt); 
?>