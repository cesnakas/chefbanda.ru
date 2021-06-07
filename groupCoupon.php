<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $USER;
$filter = Array("GROUPS_ID" => Array(6));
$rsUsers = CUser::GetList(($by = "NAME"), ($order = "desc"), $filter);
while ($arUser = $rsUsers->Fetch()) {
  	$arGroups = CUser::GetUserGroup($arUser['ID']);
	$arGroups[] = 12;
	CUser::SetUserGroup($arUser['ID'], $arGroups);
}