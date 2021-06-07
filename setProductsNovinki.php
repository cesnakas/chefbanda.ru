<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');

$offers_ids = array("Новинка" => 1164, "Хит продаж" => 1165, "Распродажа" => 1166, "Рекомендуем" => 1167, "Уценка -10%" => 1168);

$data2 = file_get_contents($_SERVER['DOCUMENT_ROOT']."/bestPrice.csv");
		$data = explode("\n", $data2);

foreach($data as $key => $d2) {

$d = explode(";", $d2);
$d[0] = trim($d[0]);
$d[1] = trim($d[1]);
var_dump($d[1]);
$arSelect = Array("ID", "NAME", "IBLOCK_ID", "XML_ID");
$arFilter = Array("IBLOCK_ID"=>17, "=XML_ID" => $d[1]);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
if($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
$arProps = $ob->GetProperties();
var_dump($arFields['NAME']);
var_dump($arProps['OFFERS']['VALUE']);
$offers = array();
	if($arProps['OFFERS']['VALUE']){
		if(is_array($arProps['OFFERS']['VALUE'])){
			foreach($arProps['OFFERS']['VALUE'] as $offer){
				$offers[] = $offers_ids[$offer];
			}
		}
	}
$offers[] = 1168;
var_dump($offers);
	CIBlockElement::SetPropertyValuesEx($arFields['ID'], false, array('OFFERS' => $offers));
}

}