<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');

$IBLOCK_ID = 23;
$SKU_ID = 24;

$style1 = ['MF1', 'CF1', 'GF1'];
$style2 = ['MF2', 'CF2', 'GF2'];
$style3 = ['MF1', 'RF1', 'GF1'];
$style4 = ['MF2', 'RF2', 'GF2'];
$style5 = ['CF1', 'SF1'];

$arSelect = Array("ID", "NAME", "IBLOCK_ID", "IBLOCK_SECTION_ID");
$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("NAME" => "ASC"), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
 	$arFields = $ob->GetFields();
	$arProp = $ob->GetProperties();
	$arInfo = CCatalogSKU::GetInfoByProductIBlock($IBLOCK_ID);
		if (is_array($arInfo))
		{ 
			$rsOffers = CIBlockElement::GetList(array(),array('IBLOCK_ID' => $arInfo['IBLOCK_ID'], 'PROPERTY_'.$arInfo['SKU_PROPERTY_ID'] => $arFields['ID']));
			while($ob2 = $rsOffers->GetNextElement()) {
				$grud = false;
				$tal = false;
				$shov = false;
				$arOffer = $ob2->GetFields(); 
				var_dump($arOffer['NAME']);

				$arOfferProp = $ob2->GetProperties(); 
				if(($arFields['IBLOCK_SECTION_ID'] == 443 || $arFields['IBLOCK_SECTION_ID'] == 444) && in_array($arProp['STYLE_2']['VALUE'], $style1)){
					switch($arOfferProp['RAZMER_ODEZHDY_']['VALUE']){
						case 'XS' : $grud = "81/86"; break;
						case 'S' : $grud = "91/97"; break;
						case 'M' : $grud = "102/107"; break;
						case 'L' : $grud = "112/117"; break;
						case 'XL' : $grud = "122/127"; break;
						case '2XL' : $grud = "132/137"; break;
						case '3XL' : $grud = "142/147"; break;
						case '4XL' : $grud = "152/157"; break;
						case '5XL' : $grud = "163/168"; break;
						case '6XL' : $grud = "173/178"; break;
						case '7XL' : $grud = "183/188"; break;
					}
				} elseif(($arFields['IBLOCK_SECTION_ID'] == 443 || $arFields['IBLOCK_SECTION_ID'] == 444) && in_array($arProp['STYLE_2']['VALUE'], $style2)){
					switch($arOfferProp['RAZMER_ODEZHDY_']['VALUE']){
						case '30' : $grud = "76"; break;
						case '32' : $grud = "81"; break;
						case '34' : $grud = "86"; break;
						case '36' : $grud = "91"; break;
						case '38' : $grud = "96"; break;
						case '40' : $grud = "102"; break;
						case '42' : $grud = "107"; break;
						case '44' : $grud = "115"; break;
						case '46' : $grud = "117"; break;
						case '48' : $grud = "122"; break;
						case '50' : $grud = "127"; break;
						case '52' : $grud = "132"; break;
						case '54' : $grud = "137"; break;
						case '56' : $grud = "142"; break;
						case '58' : $grud = "147"; break;
						case '60' : $grud = "152"; break;
						case '62' : $grud = "157"; break;
						case '64' : $grud = "163"; break;
						case '66' : $grud = "168"; break;
						case '68' : $grud = "173"; break;
					}
				} elseif($arFields['IBLOCK_SECTION_ID'] == 445 && in_array($arProp['STYLE_2']['VALUE'], $style3)){
					switch($arOfferProp['RAZMER_ODEZHDY_']['VALUE']){
						case 'XS' : $tal = "66/71"; $shov = "80"; break;
						case 'S' : $tal = "76/81"; $shov = "80"; break;
						case 'M' : $tal = "86/91"; $shov = "81,5"; break;
						case 'L' : $tal = "97/102"; $shov = "81,5"; break;
						case 'XL' : $tal = "107/112"; $shov = "81,5"; break;
						case '2XL' : $tal = "117/122"; $shov = "81,5"; break;
						case '3XL' : $tal = "127/132"; $shov = "81,5"; break;
						case '4XL' : $tal = "137/142"; $shov = "81,5"; break;
						case '5XL' : $tal = "147/152"; $shov = "81,5"; break;
						case '6XL' : $tal = "157/162"; $shov = "81,5"; break;
						case '7XL' : $tal = "167/172"; $shov = "81,5"; break;
					}
				} elseif($arFields['IBLOCK_SECTION_ID'] == 445 && in_array($arProp['STYLE_2']['VALUE'], $style4)){
					switch($arOfferProp['RAZMER_ODEZHDY_']['VALUE']){
						case '00' : $tal = "61"; $shov = "80"; break;
						case '0' : $tal = "66"; $shov = "80"; break;
						case '2' : $tal = "71"; $shov = "80"; break;
						case '4' : $tal = "76"; $shov = "80"; break;
						case '6' : $tal = "81"; $shov = "80"; break;
						case '8' : $tal = "86"; $shov = "81,5"; break;
						case '10' : $tal = "91"; $shov = "81,5"; break;
						case '12' : $tal = "97"; $shov = "81,5"; break;
						case '14' : $tal = "102"; $shov = "81,5"; break;
						case '16' : $tal = "107"; $shov = "81,5"; break;
						case '18' : $tal = "112"; $shov = "81,5"; break;
					}
				} elseif(($arFields['IBLOCK_SECTION_ID'] == 450 || $arFields['IBLOCK_SECTION_ID'] == 451) && in_array($arProp['STYLE_2']['VALUE'], $style5)){
					switch($arOfferProp['RAZMER_ODEZHDY_']['VALUE']){
						case 'XS' : $grud = "76/81"; break;
						case 'S' : $grud = "86/91"; break;
						case 'M' : $grud = "97/102"; break;
						case 'L' : $grud = "107/112"; break;
						case 'XL' : $grud = "117/122"; break;
						case '2XL' : $grud = "127/132"; break;
						case '3XL' : $grud = "137/142"; break;
						case '4XL' : $grud = "147/152"; break;
						case '5XL' : $grud = "157/163"; break;
					}
				} elseif($arFields['IBLOCK_SECTION_ID'] == 452 && in_array($arProp['STYLE_2']['VALUE'], $style3)){
					switch($arOfferProp['RAZMER_ODEZHDY_']['VALUE']){
						case 'XS' : $tal = "66/71"; $shov = "80"; break;
						case 'S' : $tal = "76/81"; $shov = "80"; break;
						case 'M' : $tal = "86/91"; $shov = "80"; break;
						case 'L' : $tal = "97/102"; $shov = "81"; break;
						case 'XL' : $tal = "107/112"; $shov = "81"; break;
						case '2XL' : $tal = "117/122"; $shov = "81"; break;
						case '3XL' : $tal = "127/132"; $shov = "81"; break;
					}
				} elseif($arFields['IBLOCK_SECTION_ID'] == 452 && in_array($arProp['STYLE_2']['VALUE'], $style4)){
					switch($arOfferProp['RAZMER_ODEZHDY_']['VALUE']){
						case '00' : $tal = "61"; $shov = "80"; break;
						case '0' : $tal = "66"; $shov = "80"; break;
						case '2' : $tal = "71"; $shov = "80"; break;
						case '4' : $tal = "76"; $shov = "80"; break;
						case '6' : $tal = "81"; $shov = "80"; break;
						case '8' : $tal = "86"; $shov = "80"; break;
						case '10' : $tal = "91"; $shov = "80"; break;
						case '12' : $tal = "97"; $shov = "81"; break;
						case '14' : $tal = "102"; $shov = "81"; break;
						case '16' : $tal = "107"; $shov = "81"; break;
						case '18' : $tal = "112"; $shov = "81"; break;
					}
				} 
var_dump($grud);
var_dump($tal);
var_dump($shov);
				echo "<br/>";
				//if($grud){
					CIBlockElement::SetPropertyValuesEx($arOffer['ID'], false, array('OBHVAT_GRUDI' => $grud));
				//}  
				//if($tal){
					CIBlockElement::SetPropertyValuesEx($arOffer['ID'], false, array('OBHVAT_TALII' => $tal));
				//}
				//if($shov){
					CIBlockElement::SetPropertyValuesEx($arOffer['ID'], false, array('INNER_SHOV' => $shov));
				//}
			}

		}
}