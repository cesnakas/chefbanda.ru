<?
$_SERVER["DOCUMENT_ROOT"] = __DIR__;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
\Bitrix\Main\Loader::includeModule("catalog");

$ID = 2;

$arFields = array(
	'RATE' => 20,
	'NAME' => 'НДС 20%'
);
CCatalogVat::Update($ID, $arFields);