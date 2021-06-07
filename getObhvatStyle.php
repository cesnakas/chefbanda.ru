<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
if($USER->isAdmin()){
\Bitrix\Main\Loader::includeModule('iblock');

$IBLOCK_ID = 23;
$SKU_ID = 24;

	/*$list = [];
$arSelect = Array("ID", "NAME", "IBLOCK_ID", "PROPERTY_STYLE_2", "PROPERTY_CML2_ARTICLE");
$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID);
$res = CIBlockElement::GetList(Array("NAME" => "ASC"), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
 	$arFields = $ob->GetFields();
var_dump($arFields["PROPERTY_CML2_ARTICLE_VALUE"]);
var_dump($arFields["PROPERTY_STYLE_2_VALUE"]);
	echo "<br/>";
	if($arFields["PROPERTY_STYLE_2_VALUE"]){
		$list[] = [$arFields["PROPERTY_CML2_ARTICLE_VALUE"], $arFields["PROPERTY_STYLE_2_VALUE"]];
	}
}

	$fp = fopen('uuStyle.csv', 'w');
foreach ($list as $fields) {
    fputcsv($fp, $fields, ";");
}

	fclose($fp);*/

$list = [];
$arSelect = Array("ID", "NAME", "IBLOCK_ID", "PROPERTY_CML2_ARTICLE");
$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID);
$res = CIBlockElement::GetList(Array("NAME" => "ASC"), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
 	$arFields = $ob->GetFields();

	$rsOffers = CIBlockElement::GetList(array(),array('IBLOCK_ID' => $SKU_ID, 'PROPERTY_CML2_LINK' => $arFields['ID']));
	while($ob = $rsOffers->GetNextElement()) {
		$arOffer = $ob->GetFields();
		$arOfferProps = $ob->GetProperties();

		var_dump($arFields["PROPERTY_CML2_ARTICLE_VALUE"]);
		var_dump($arOfferProps["RAZMER_ODEZHDY_"]["VALUE"]);
		var_dump($arOfferProps["OBHVAT_GRUDI"]["VALUE"]);
		echo "<br/>";
		if($arOfferProps["OBHVAT_GRUDI"]["VALUE"]){
			$list[] = [
				$arFields["PROPERTY_CML2_ARTICLE_VALUE"], 
				$arOfferProps["RAZMER_ODEZHDY_"]["VALUE"], 
				$arOfferProps["OBHVAT_GRUDI"]["VALUE"]
			];
		}
	}
}

$fp = fopen('uuObhvat.csv', 'w');
foreach ($list as $fields) {
    fputcsv($fp, $fields, ";");
}

	fclose($fp);
	
}