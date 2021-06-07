<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
\Bitrix\Main\Loader::includeModule('iblock');
\Bitrix\Main\Loader::includeModule('sender');

$email = htmlspecialchars($_REQUEST['email']);
\Bitrix\Sender\Subscription::subscribe(array("EMAIL" => $email, "SUBSCRIBE_LIST" => array("MAILING_ID" => 1)));