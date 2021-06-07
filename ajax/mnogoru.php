<?php 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$cart = htmlspecialchars($_REQUEST['cart']);
$balls = (int)$_REQUEST['balls'];

$_SESSION["cart"] = $cart;
$_SESSION["balls"] = $balls;