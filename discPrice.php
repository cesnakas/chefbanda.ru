<?
$_SERVER["DOCUMENT_ROOT"] = "/home/c/cc84729/public_html";
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");


$arSelect = Array("ID", "NAME", "IBLOCK_ID");
$arFilter = Array("IBLOCK_ID"=>13, "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("ID" => "ASC"), $arFilter, false, Array("nPageSize"=>15000), $arSelect);
while($ob = $res->GetNextElement())
{
	$minPrice = 0;
	$maxPrice = 0;
	$arFields = $ob->GetFields();
	$rsPrices = CPrice::GetListEx(array(),array(
		'PRODUCT_ID' => $arFields['ID'],
		'CATALOG_GROUP_ID' => 1,
		'CAN_BUY' => 'Y',
		'GROUP_GROUP_ID' => array(2)
		)
	);
	if ($arPrice = $rsPrices->Fetch())
		{

			if ($arOptimalPrice = CCatalogProduct::GetOptimalPrice(
				$arFields['ID'],
				1,
				array(2)
			))
			{
				$minPrice = $arOptimalPrice['DISCOUNT_PRICE'];
				if($minPrice) {
					$ar_res = CPrice::GetBasePrice($arFields['ID']);
					$maxPrice = (float)$ar_res["PRICE"];
				if ($minPrice < $maxPrice) {
					$discPercent = ($maxPrice-$minPrice)/$maxPrice;
					$discPercent100 = round($discPercent*100);
					CIBlockElement::SetPropertyValuesEx($arFields['ID'], false, array("DISCOUNT_PERCENT" => $discPercent100));
					if($discPercent < 0.05) {
						$maxPrice = 1.06*$minPrice;
						$maxPrice = round($maxPrice, 2);
						$fields = Array(
							"PRODUCT_ID" => $arFields['ID'],
							"CATALOG_GROUP_ID" => 1,
							"PRICE" => $maxPrice,
							"CURRENCY" => "RUB"
						);
						CPrice::Update($arPrice["ID"], $fields);
					}
				} else {
					CIBlockElement::SetPropertyValuesEx($arFields['ID'], false, array("DISCOUNT_PERCENT" => 0));
				}

				}
			}
		}

}
file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/successDiscPrice.txt", date("d.m.Y H:i:s", FILE_APPEND));