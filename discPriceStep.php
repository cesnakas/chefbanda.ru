<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
	CModule::IncludeModule("iblock");
	CModule::IncludeModule("catalog");
	CModule::IncludeModule("sale");

$arInfo = CCatalogSKU::GetInfoByProductIBlock(17); 
$arSelect = Array("ID", "NAME", "IBLOCK_ID");
$arFilter = Array("IBLOCK_ID"=>17, "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>5000), $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
	echo $arFields["NAME"]."<br/>";
if (is_array($arInfo)) 
{ 
     $rsOffers = CIBlockElement::GetList(array(),array('IBLOCK_ID' => $arInfo['IBLOCK_ID'], 'PROPERTY_'.$arInfo['SKU_PROPERTY_ID'] => $arFields["ID"])); 
	$price = array();
     while ($ob = $rsOffers->GetNextElement()) 
    {  
	$arOffer = $ob->GetFields();
	$res2 = CPrice::GetList(
        array(),
        array(
                "PRODUCT_ID" => $arOffer['ID'],
                "CATALOG_GROUP_ID" => 2
            )
    );

	if ($arr = $res2->Fetch())
	{
		$price[] = $arr["PRICE"];
	}

	}
	if($price) {
		$minprice = intval(min($price));
	} else {
		$res3 = CPrice::GetList(
			array(),
			array(
					"PRODUCT_ID" => $arFields['ID'],
					"CATALOG_GROUP_ID" => 2
				)
		);
	
		if ($arr3 = $res3->Fetch())
		{
			$minprice = intval($arr3["PRICE"]);
		}

	}
	CIBlockElement::SetPropertyValuesEx($arFields["ID"], false, array("MINIMUM_PRICE" => $minprice));
}
}