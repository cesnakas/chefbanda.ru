<?php 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');

$arSelect = Array("ID", "NAME", "IBLOCK_ID", "CODE");
$arFilter = Array("IBLOCK_ID"=>17, "SECTION_ID"=>251,"ACTIVE"=>"Y");
$res = CIBlockSection::GetList(Array(), $arFilter, false, $arSelect);
while($arSect = $res->GetNext())
{
var_dump($arSect['CODE']);
$bs = new CIBlockSection;
$arLoadArray = Array(
	"CODE"   => $arSect['CODE'].'-u',
  );

	$bs->Update($arSect['ID'], $arLoadArray);
}

