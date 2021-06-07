<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
\Bitrix\Main\Loader::includeModule('iblock');

$iblockId = 23;

$arSelect = Array("ID", "NAME", "IBLOCK_ID");
$arFilter = Array("IBLOCK_ID"=>IntVal($iblockId), "SECTION_ID"=>array(449, 442), "INCLUDE_SUBSECTIONS"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 CIBlockElement::SetPropertyValuesEx($arFields['ID'], $iblockId, array('TIP' => 1380));
}