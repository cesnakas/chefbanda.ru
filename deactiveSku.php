<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');

$SKU_ID = 24;

echo "<pre>";
$arSelect = Array("ID", "NAME", "IBLOCK_ID", "PROPERTY_CML2_ARTICLE");
$arFilter = Array("IBLOCK_ID" => $SKU_ID, "ACTIVE" => "Y");
$res = CIBlockElement::GetList(Array("NAME" => "ASC"), $arFilter, false, Array("nPageSize"=>10000), $arSelect);
while($ob = $res->GetNextElement())
{
 	$arFields = $ob->GetFields();
	if(!$arFields['PROPERTY_CML2_ARTICLE_VALUE']){
		$el = new CIBlockElement;
		$arLoadProductArray = Array(
		  "ACTIVE"         => "N"
		  );
		$el->Update($arFields['ID'], $arLoadProductArray);
	}
}

echo "</pre>";