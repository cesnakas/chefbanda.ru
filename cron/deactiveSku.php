<?php 
$_SERVER["DOCUMENT_ROOT"] = dirname(__DIR__);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('iblock');
\Bitrix\Main\Loader::includeModule('catalog');

$iblockId = 24;
$typePrice = 2;

$arSelect = Array("ID", "NAME");
$arFilter = Array("IBLOCK_ID"=>$iblockId, "ACTIVE" => "Y", "CATALOG_PRICE_".$typePrice => false);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
	$arFields = $ob->GetFields();

	$el = new CIBlockElement;
	$el->Update($arFields['ID'], ["ACTIVE" => "N"]);
}