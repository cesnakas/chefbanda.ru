<?// require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//
//$newlogin = 'ROOT_USER';
//
//$newemail = 'mail@mail.ru';
//
//$newpassword = 'ROOT_USER';
//
//$group = array(1);
//
//
//
//$user = new CUser;
//
//$arFields = array(
//
//"EMAIL"             => $newemail,
//
//"LOGIN"             => $newlogin,
//
//"LID"               => "ru",
//
//"ACTIVE"            => "Y",
//
//"GROUP_ID"          => $group,
//
//"PASSWORD"          => $newpassword,
//
//"CONFIRM_PASSWORD"  => $newpassword
//
//);
//
//
//
//$ID = $user->Add($arFields);
//
//if(intval($ID) > 0) echo 'Администратор создан';
//
//else echo $user->LAST_ERROR;
//
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");