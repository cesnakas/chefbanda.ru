<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
CModule::IncludeModule('catalog');

$IBLOCK_ID = 23;
$arInfo = CCatalogSKU::GetInfoByProductIBlock($IBLOCK_ID);
$arSelect = Array("ID", "NAME", "IBLOCK_ID");
$arFilter = Array("IBLOCK_ID" => $IBLOCK_ID, "SECTION_ID" => 456, "INCLUDE_SUBSECTIONS" => "Y");
$res = CIBlockElement::GetList(Array("NAME" => "ASC"), $arFilter, false, false, $arSelect);

while($ob = $res->GetNextElement())
{
 	$arFields = $ob->GetFields();
	$rsOffers = CIBlockElement::GetList(array(),array('IBLOCK_ID' => $arInfo['IBLOCK_ID'], 
					'PROPERTY_'.$arInfo['SKU_PROPERTY_ID'] => $arFields['ID']));
	while($ob2 = $rsOffers->GetNextElement()) {
		$arOffer = $ob2->GetFields();
		CCatalogProduct::Update($arOffer['ID'], array("WEIGHT"=>100));
	}

}