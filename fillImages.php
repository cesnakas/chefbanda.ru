<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');

$IBLOCK_ID = 23;
$SKU_ID = 24;

$sizes = ["XS", 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL', '7XL', 'XXL'];

$arSelect = Array("ID", "NAME", "IBLOCK_ID");
$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID);
$res = CIBlockElement::GetList(Array("NAME" => "ASC"), $arFilter, false, Array("nPageSize"=>10000), $arSelect);
while($ob = $res->GetNextElement())
{
 	$arFields = $ob->GetFields();
	$arInfo = CCatalogSKU::GetInfoByProductIBlock($IBLOCK_ID);
	if (is_array($arInfo))
	{ 
		$rsOffers = CIBlockElement::GetList(array(),array('IBLOCK_ID' => $arInfo['IBLOCK_ID'], 'PROPERTY_'.$arInfo['SKU_PROPERTY_ID'] => $arFields['ID']));
		$param = [];
			$offerImage = [];
		while($ob2 = $rsOffers->GetNextElement()) {
			$arOffer = $ob2->GetFields();
			$arOfferProps = $ob2->GetProperties();

			$color = substr($arOffer['NAME'], strpos($arOffer['NAME'], ",")+1, -1);
			if($color === "0"){
				$color = substr($arOffer['NAME'], strpos($arOffer['NAME'], "(")+1, -3);
			}
			if(in_array($color, $sizes)){
				$color = substr($arOffer['NAME'], strpos($arOffer['NAME'], "(")+1, strpos($arOffer['NAME'], ",")-strpos($arOffer['NAME'], "(")-1);
			}
			if($arOfferProps['MORE_PHOTO']['VALUE']) {

			} else {
				//$color = substr($arOffer['NAME'], strpos($arOffer['NAME'], "(")+1, strpos($arOffer['NAME'], ", "));
			}
			var_dump($arOffer['NAME']);
			$offerImage[$arOffer['ID']] = ['photo' => $arOfferProps['MORE_PHOTO']['VALUE'], 'color' => $color];
		}

			foreach($offerImage as $val){
				$val['color'] = trim($val['color']);
				if($val['photo']) $param[$val['color']] = $val['photo'][0];
			}
		echo "<pre>"; var_dump($param); echo "</pre>";
			foreach($offerImage as $element_id => $val){
$val['color'] = trim($val['color']);
				if(!$val['photo'] ) {
					//var_dump($element_id);
var_dump($val['color']);
					//var_dump($param);
var_dump($param[$val['color']]);
					//var_dump(CFile::MakeFileArray($param[$val['color']]));
					CIBlockElement::SetPropertyValuesEx($element_id, $SKU_ID, ['MORE_PHOTO' => array(
						'VALUE' => CFile::MakeFileArray($param[$val['color']]),
						'DESCRIPTION' => 'New File')]);
				}
			}
		//var_dump($offerImage);
			echo "<br/>";
	}
}