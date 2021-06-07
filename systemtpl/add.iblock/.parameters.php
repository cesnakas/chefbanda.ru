<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arCurrentValues */

if(!CModule::IncludeModule("iblock"))
	return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(Array("-"=>" "));

$arIBlocks=Array();
$db_iblock = CIBlock::GetList(Array("SORT"=>"ASC"), Array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch())
	$arIBlocks[$arRes["ID"]] = $arRes["NAME"];

$arSorts = Array("ASC"=>GetMessage("T_IBLOCK_DESC_ASC"), "DESC"=>GetMessage("T_IBLOCK_DESC_DESC"));
$arSortFields = Array(
		"ID"=>GetMessage("T_IBLOCK_DESC_FID"),
		"NAME"=>GetMessage("T_IBLOCK_DESC_FNAME"),
		"ACTIVE_FROM"=>GetMessage("T_IBLOCK_DESC_FACT"),
		"SORT"=>GetMessage("T_IBLOCK_DESC_FSORT"),
		"TIMESTAMP_X"=>GetMessage("T_IBLOCK_DESC_FTSAMP")
	);

$arProperty_LNS = array();
$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>(isset($arCurrentValues["IBLOCK_ID"])?$arCurrentValues["IBLOCK_ID"]:$arCurrentValues["ID"])));
while ($arr=$rsProp->Fetch())
{
	$arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	if (in_array($arr["PROPERTY_TYPE"], array("L", "N", "S")))
	{
		$arProperty_LNS[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	}
}
/*		"ID_WINDOW" => Array(
			"PARENT" => "BASE",
			"NAME" => "Идентификатор окна",
			"TYPE" => "STRING",
			"DEFAULT" => "win-call",
		),*/
$arComponentParameters = array(
	"GROUPS" => array(
			"REQ_DATA"=> array(
		"IBLOCK_TYPE" => Array(
			"NAME" => "777",		
		)),
	"RESULT" => Array(
					"NAME" => "Результат",
					'SORT'=> 300
			),
	"AUTO_MAIL" => Array(
					"NAME" => "Отправка данных на почту",
					'SORT'=> 400
			),
	"DATA_SOURCEN" => Array(
					"NAME" => "Вывод полей",
					'SORT'=> 700
			),
	"REQ_DATA" => Array(
					"NAME" => "Обязательные поля",
					'SORT'=> 800
			)
			
	
	),
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"DEFAULT" => "news",
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"DEFAULT" => '={$_REQUEST["ID"]}',
			"ADDITIONAL_VALUES" => "Y",
			"REFRESH" => "Y",
		),

		"ID_BUTT" => Array(
			"PARENT" => "BASE",
			"NAME" => "Имя кнопки отправки",
			"TYPE" => "STRING",
			"DEFAULT" => "send",
		),
		"SEND_AJAX" => array(
					"PARENT" => "BASE",
					"NAME" => "Использовать AJAX",
					"TYPE" => "CHECKBOX",
					"DEFAULT" => "N",
			),
		"SUCCES_SHOW" => array(
			"PARENT" => "RESULT",
			"NAME" => "Отображать шаблон при успешном добавлении",
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"SUCCES_TEXT" => Array(
			"PARENT" => "RESULT",
			"NAME" => "Сообщение об успешном добавлении",
			"TYPE" => "STRING",
			"DEFAULT" => "<p>Спасибо за запрос! Наша команда скоро свяжется с вами.</p>",
		),
		"POST_SEND" => array(
			"PARENT" => "RESULT",
			"NAME" => "Создавать почтовое событие при добавлении",
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
		"POST_CODE" => Array(
			"PARENT" => "RESULT",
			"NAME" => "Код почтового события",
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),
		// SEND_MAIL	
		"AUTO_MAIL" => array(
					"PARENT" => "AUTO_MAIL",
					"NAME" => "Отправлять автоматическое письмо с данными",
					"TYPE" => "CHECKBOX",
					"DEFAULT" => "Y",
				
			),
		"AUTO_EMAIL_TO" => array(
					"PARENT" => "AUTO_MAIL",
					"NAME" => "Адрес почты куда придут письма",
					"TYPE" => "STRING",
					"DEFAULT" => "",
			),
		"AUTO_SUBJ" => array(
					"PARENT" => "AUTO_MAIL",
					"NAME" => "Тема отправляемого письма",
					"TYPE" => "STRING",
					"DEFAULT" => "Запрос с сайта #SERVER_NAME#",
			),
			
		"LINK_SHOW" => array(
			"PARENT" => "BASE",
			"NAME" => "Отображать ссылку открытия окна",
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"LINK_NAME" => Array(
			"PARENT" => "BASE",
			"NAME" => "Ссылка",
			"TYPE" => "STRING",
			"DEFAULT" => "Заказать звонок",
		),
		"ADD_ACTIVE" => array(
					"PARENT" => "BASE",
					"NAME" => "Активные при добавлении",
					"TYPE" => "CHECKBOX",
					"DEFAULT" => "Y",
			),
		"USE_CAPTCHA" => array(
					"PARENT" => "BASE",
					"NAME" => "Использовать каптчу",
					"TYPE" => "CHECKBOX",
					"DEFAULT" => "N",
			),
		"USE_HIDDEN" => array(
					"PARENT" => "BASE",
					"NAME" => "Использовать скрытое поле для защиты от спама",
					"TYPE" => "CHECKBOX",
					"DEFAULT" => "Y",
			),
		"DATE_IN_NAME" => array(
					"PARENT" => "BASE",
					"NAME" => "Использовать дату для имени элемента",
					"TYPE" => "CHECKBOX",
					"DEFAULT" => "Y",
			),
		"FIELD_CODE" => CIBlockParameters::GetFieldCode("Сохраняемые поля", "DATA_SOURCEN"),
		"PROPERTY_CODE" => array(
			"PARENT" => "DATA_SOURCEN",
			"NAME" => "Сохраняемые свойства",
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arProperty_LNS,
			"ADDITIONAL_VALUES" => "Y",
		),
		"REQ_FIELD_CODE" => CIBlockParameters::GetFieldCode("Обязательные поля", "REQ_DATA"),
		"REQ_PROPERTY_CODE" => array(
			"PARENT" => "REQ_DATA",
			"NAME" => "Обязательные свойства",
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arProperty_LNS,
			"ADDITIONAL_VALUES" => "Y",
		),
	),
);


if($arCurrentValues["AUTO_MAIL"]=="Y")
{
	
	
$rsET = CEventType::GetByID("AUTO_MAIL_FIELD", "ru");
if(!$arET = $rsET->Fetch()){
	$arSiteId=array();
	$rsSites = CSite::GetList($by="sort", $order="desc", Array());
	while ($arSite = $rsSites->Fetch())
		$arSiteId[]=$arSite['LID'];
	$arNewType=array(
			"LID"=>"ru",
			"EVENT_NAME"=>"AUTO_MAIL_FIELD",
			"NAME"=>"Отправка полей формы",
			"DESCRIPTION"=>"#AUTO_FIELD_LIST# - Список полей формы
#EMAIL# - EMail поле с формы
#NAME# - Имя с формы
#SUBJECT# - тема письма
#CODE# - Доступны все поля формы в отдельности где CODE - код этого поля
#DEFAULT_EMAIL_FROM# - E-Mail адрес по умолчанию (устанавливается в настройках)
#SITE_NAME# - Название сайта (устанавливается в настройках)
#SERVER_NAME# - URL сервера (устанавливается в настройках)",
			"SORT"=>"100"
	);
	$arNewMSG=array(
			"EVENT_NAME"=>$arNewType['EVENT_NAME'],
			"ACTIVE"=>"Y",
			"LID"=>$arSiteId,
			"SITE_ID"=>$arSiteId,
			"EMAIL_FROM"=>"#DEFAULT_EMAIL_FROM#",
			"EMAIL_TO"=>"#EMAIL_TO#",
			"SUBJECT"=>"#SUBJECT#",
			"MESSAGE"=>"
Поступило сообщение с сайта #SERVER_NAME#
Список полей:
#AUTO_FIELD_LIST#",
			"BODY_TYPE"=>"text",
			"BCC"=>"",
			"REPLY_TO"=>"",
			"CC"=>"",
			"IN_REPLY_TO"=>"",
			"PRIORITY"=>"",
			"FIELD1_NAME"=>"",
			"FIELD1_VALUE"=>"",
			"FIELD2_NAME"=>"",
			"FIELD2_VALUE"=>"",
	);
		$et = new CEventType;
		$et->Add($arNewType);
		$emess = new CEventMessage;
		$emess->Add($arNewMSG);
	
	
}
	
}
//CIBlockParameters::AddPagerSettings($arComponentParameters, GetMessage("T_IBLOCK_DESC_PAGER_NEWS"), true, true);
?>
