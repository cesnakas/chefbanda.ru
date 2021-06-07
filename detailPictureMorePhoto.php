<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

$SKU_ID = 24;

$arFile = [];
$arFile["MODULE_ID"] = "iblock";
$arFile["del"] = "Y";

echo "<pre>";
$i = 0;
$arSelect = Array("ID", "NAME", "IBLOCK_ID");
$arFilter = Array("IBLOCK_ID"=>$SKU_ID, "DETAIL_PICTURE" => false, "!PROPERTY_MORE_PHOTO" => false);
$res = CIBlockElement::GetList(Array("NAME" => "ASC"), $arFilter, false, Array("nPageSize"=>6000), $arSelect);
while($ob = $res->GetNextElement())
{
 	$arFields = $ob->GetFields();
	$arProps = $ob->GetProperties();
	var_dump($arFields['NAME']);
	$img = $arProps['MORE_PHOTO']['VALUE'][0];

	//$el = new CIBlockElement;

	//$arLoadProductArray = Array(
	//	"DETAIL_PICTURE" => CFile::MakeFileArray(CFile::GetPath($img))
	// );

	//$el->Update($arFields['ID'], $arLoadProductArray);
	//CIBlockElement::SetPropertyValueCode($arFields['ID'], "MORE_PHOTO", Array (
	//$arProps['MORE_PHOTO']['PROPERTY_VALUE_ID'][0] => Array("VALUE"=>$arFile)));
	$i++;
	echo $i;
}

echo "</pre>";