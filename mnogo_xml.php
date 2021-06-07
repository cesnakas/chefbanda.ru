<?php 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('sale');

$enterpriseGroup = 2055; // Идентификатор Партнера
$accountGroup = 2897480; // Идентификатор Бонусной программы

$arFilter = Array(
   ">=DATE_INSERT" => date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), mktime(0, 0, 0, date("n"), date("j")-1, date("Y"))),
   "<DATE_INSERT" => date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), mktime(0, 0, 0, date("n"), date("j"), date("Y"))),
   );

$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter, false, array("nTopCount" => 200));

$xml = '<?xml version="1.0" encoding="windows-1251"?>
<batch>
<enterpriseGroup enterpriseId="'.$enterpriseGroup.'">
<accountGroup accountId="'.$accountGroup.'">';
//echo "<pre>";
while ($ar_sales = $db_sales->Fetch())
{
$cart = false;
$orderId = $ar_sales["ID"];
   $order_props = CSaleOrderPropsValue::GetOrderProps($orderId);
	while ($arProps = $order_props->Fetch())
	  {
		if ($arProps["CODE"] == "CART_MNOGO")
		{
			$cart = $arProps["VALUE"];
		}
	
	  }
var_dump($cart);
	if($cart) {
	if($ar_sales['CANCELED']=='Y') {
		$action = "reject";
		$date = date("Y-m-d", strtotime($ar_sales['DATE_CANCELED']));
		$status = "rejected";
	} elseif($ar_sales["PAYED"]=='Y') {
		$action = "approve";
		$date = date("Y-m-d", strtotime($ar_sales['DATE_PAYED']));
		$status = "approved";
	} else {
		$action = "create";
		$date = date("Y-m-d", strtotime($ar_sales['DATE_STATUS']));
		$status = "waiting";
	}
$orderDate = date("Y-m-d", strtotime($ar_sales['DATE_INSERT']));
$price = (int)$ar_sales['PRICE'].".00";

$xml .= '<receipt number="'.$orderId.'" date="'.$date.'" card="'.$cart.'" action="'.$action.'" status="'.$status.'">
<entry name="orderDate" value="'.$orderDate.'" />
<entry name="sum" value="'.$price.'" />
</receipt>';
}

}
$xml .= '</accountGroup>
</enterpriseGroup>
</batch>';

$date_doc = date("Ymd");
$filename = $enterpriseGroup."_".$date_doc;
file_put_contents("mnogoxml/".$filename.".xml", $xml);