<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');

$SKU_IBLOCK_ID = 24;

/*$enums = [];
$property_enums = CIBlockPropertyEnum::GetList(Array("VALUE"=>"ASC"), Array("IBLOCK_ID"=>$SKU_IBLOCK_ID, "CODE"=>"RAZMER_ODEZHDY_"));
while($enum_fields = $property_enums->GetNext())
{
	$enums[$enum_fields["VALUE"]] = $enum_fields["ID"];
}*/

$arSelect = Array("ID", "NAME", "IBLOCK_ID");
$arFilter = Array("IBLOCK_ID"=>$SKU_IBLOCK_ID);
$res = CIBlockElement::GetList(Array("NAME" => "ASC"), $arFilter, false, false, $arSelect);

while($ob = $res->GetNextElement())
{
 	$arFields = $ob->GetFields();
	/*$size = substr($arFields['NAME'], strpos($arFields['NAME'], "(")+1, strpos($arFields['NAME'], ",")-strpos($arFields['NAME'], "(")-1);
	if($size !== "0"){
		CIBlockElement::SetPropertyValuesEx($arFields["ID"], false, array("RAZMER_ODEZHDY_" => $enums[$size]));
	}*/
$size = substr($arFields['NAME'], strpos($arFields['NAME'], ",")+1, -1);
var_dump($size);
	echo "<br/>";
	if($size === "0"){
	  CIBlockElement::SetPropertyValuesEx($arFields["ID"], false, array("RAZMER_ODEZHDY_" => 1887));//OS
	}
}