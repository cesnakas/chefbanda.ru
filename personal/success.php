<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
use Bitrix\Sale;

\Bitrix\Main\Loader::includeModule('sale');
global $USER;
$userId = $USER->GetID();

if($userId){
$orders = Sale\Order::getList(array(
'filter' => array('=USER_ID' => $userId),
'order' => array('ID' => 'DESC'),
'limit' => 1
));
if($arOrder = $orders->fetch()){
$date = $arOrder['DATE_INSERT']->getTimestamp();
?>
<h1><?$APPLICATION->ShowTitle(false)?></h1>
<table class="sale_order_full_table">
	<tbody><tr>
		<td>
			Ваш заказ <b>№<?=$arOrder['ACCOUNT_NUMBER']?></b> от <?=date("d.m.Y H:i:s", $date)?> успешно оплачен.<br><br>
			Вы можете следить за выполнением своего заказа в <a href="/personal/">Персональном разделе сайта</a>. Обратите внимание, что для входа в этот раздел вам необходимо будет ввести логин и пароль пользователя сайта.			</td>
	</tr>
</tbody></table>
<?}
}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>