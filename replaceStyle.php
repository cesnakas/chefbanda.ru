<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');

$SKU_ID = 24;

$arSelect = Array("ID", "NAME", "IBLOCK_ID", "PROPERTY_STYLE", "PROPERTY_CML2_LINK");
$arFilter = Array("IBLOCK_ID"=>IntVal($SKU_ID), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
 	$arFields = $ob->GetFields();
	//var_dump($arFields['PROPERTY_CML2_LINK_VALUE']);
	//echo "<br/>";
	if(!empty($arFields['PROPERTY_STYLE_VALUE'])){
		CIBlockElement::SetPropertyValuesEx($arFields['PROPERTY_CML2_LINK_VALUE'], false, array('STYLE_2' => $arFields['PROPERTY_STYLE_VALUE']));
	}
}