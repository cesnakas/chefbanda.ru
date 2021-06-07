<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
CModule::IncludeModule('catalog');

$IBLOCK_ID = 23;

$arInfo = CCatalogSKU::GetInfoByProductIBlock($IBLOCK_ID); 

$arSelect = Array("ID", "NAME", "IBLOCK_ID");
$arFilter = Array("IBLOCK_ID"=>IntVal($IBLOCK_ID), "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("NAME" => "ASC"), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
 	$arFields = $ob->GetFields();
	$price = 0;
	if (is_array($arInfo))
	{ 
		$rsOffers = CIBlockElement::GetList(array(),array('IBLOCK_ID' => $arInfo['IBLOCK_ID'], 'ACTIVE' => 'Y', 'PROPERTY_'.$arInfo['SKU_PROPERTY_ID'] => $arFields['ID']));
		while($ob2 = $rsOffers->GetNextElement()) {
			$arOffer = $ob2->GetFields();
			$dbPrice = CPrice::GetList(
						array("SORT" => "ASC"),
						array("PRODUCT_ID" => $arOffer['ID'], "CATALOG_GROUP_ID" => 2),
						false,
						false,
						array("ID", "CATALOG_GROUP_ID", "PRICE", "CURRENCY")
					)->Fetch();
			if($dbPrice['PRICE'] > 0 && ($price == 0 || $dbPrice['PRICE'] < $price)) {
				$price = $dbPrice['PRICE'];
			}
		}
	}
	if($price > 0) {
		CIBlockElement::SetPropertyValuesEx($arFields['ID'], false, array('MINIMUM_PRICE' => $price));
	}
	/*var_dump($arFields['NAME']);
		var_dump($price);
		echo "<br/>";*/
}