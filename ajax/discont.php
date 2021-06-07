<?php 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$discont = htmlspecialchars($_REQUEST['discont']);

$_SESSION["discont"] = $discont;