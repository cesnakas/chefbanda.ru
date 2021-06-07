<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
$curDay = date("d");
$curMonth = date("m");
$curYear = date("Y");
$dbBasketItems = CSaleBasket::GetList(
     array(
                "USER_ID" => "ASC",
                "ID" => "ASC"
             ),
     array(
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL",
		 		">=DATE_INSERT" => date($DB->DateFormatToPHP(CLang::GetDateFormat("SHORT")), mktime(0, 0, 0, $curMonth, $curDay, $curYear))
             ),
     false,
     false,
     array("ID", "PRODUCT_ID", "QUANTITY", "PRICE", "NAME", "USER_ID", "DATE_INSERT")
             );
$i=0;
$item = array();
while ($arItems[$i] = $dbBasketItems->Fetch())
{
$item[$arItems[$i]["USER_ID"]]["USER_ID"] = $arItems[$i]["USER_ID"];
$item[$arItems[$i]["USER_ID"]][] = $arItems[$i];
$i++;
}

foreach($item as $val) {
	if($val["USER_ID"]){
		$rsUser = CUser::GetByID($val["USER_ID"]);
		$arUser = $rsUser->Fetch();
		$field["EMAIL"] = $arUser["EMAIL"];
		$field["BASKET"] = "<table>";
		$field["SUM"] = 0;
		foreach($val as $key => $tovar) {
			if($key === "USER_ID") continue;
			$n = $key+1;
			$field["BASKET"] .= "<tr>
									<td>".$n."</td>
									<td>".$tovar['NAME']."</td>
									<td>".$tovar['QUANTITY']."</td>
									<td>".round($tovar['PRICE'])." руб.</td>
								</tr>";
			$field["SUM"] += $tovar['QUANTITY']*$tovar['PRICE'];
		}
		$field["BASKET"] .= "</table>";
		CEvent::Send("BROKEN_BASKET", SITE_ID, $field);
		file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/brokenBasket.txt", "[".date('d.m.Y H:i:s')."] ".var_export($val, 1), FILE_APPEND);
	}
}