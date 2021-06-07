<?php 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');

$arSelect = Array("ID", "NAME", "IBLOCK_ID", "CODE");
$arFilter = Array("IBLOCK_ID"=>17, "SECTION_ID"=>109, "INCLUDE_SUBSECTIONS" => "Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>5000), $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
$el = new CIBlockElement;


$arLoadProductArray = Array(
 	"NAME"   => $arFields['NAME'].' Ж',
	"CODE"   => $arFields['CODE'].'-zh',
  );

$el->Update($arFields['ID'], $arLoadProductArray);
}

