<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Обратная связь, интернет-магазин Chef Banda");
$APPLICATION->SetPageProperty("description", "Заполните форму обратной связи и специалисты Chef Banda свяжутся с Вами в ближайшее время. Бесплатная консультация.");
$APPLICATION->SetTitle("Обратная связь");
?><h1>Помощь и сервисы</h1>
<ul class="contactList">
	<li>
	<table>
	<tbody>
	<tr>
		<td>
 <img alt="cont1.png" src="/bitrix/templates/dresscode/images/cont1.png" title="cont1.png">
		</td>
		<td>
 <a href="tel:+7-495-212-06-16">+7-495-212-06-16</a><br>
 <a href="tel:+7-903-000-34-94">+7-903-000-34-94</a><br>
		</td>
	</tr>
	</tbody>
	</table>
 </li>
	<li>
	<table>
	<tbody>
	<tr>
		<td>
 <img alt="cont2.png" src="/bitrix/templates/dresscode/images/cont2.png" title="cont2.png">
		</td>
		<td>
 <a href="mailto:info@chefbanda.ru">info@chefbanda.ru</a><br>
		</td>
	</tr>
	</tbody>
	</table>
 </li>
	<li>
	<table>
	<tbody>
	<tr>
		<td>
 <img alt="cont3.png" src="/bitrix/templates/dresscode/images/cont3.png" title="cont3.png">
		</td>
		<td>
			 г. Москва<br>
			 ул. Маршала Бирюзова, д.1, корп. 1А, офис 315         
		</td>
	</tr>
	</tbody>
	</table>
 </li>
	<li>
	<table>
	<tbody>
	<tr>
		<td>
 <img alt="cont4.png" src="/bitrix/templates/dresscode/images/cont4.png" title="cont4.png">
		</td>
		<td>
			 Пн-Пт : с 09:00 до 18:00<br>
			 Сб, Вс : выходной<br>
		</td>
	</tr>
	</tbody>
	</table>
 </li>
</ul>
 <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"personal",
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "",
		"COMPONENT_TEMPLATE" => "personal",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(),
		"MENU_CACHE_TIME" => "3600000",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "help_and_serv",
		"USE_EXT" => "N"
	)
);?>
<div class="global-block-container">
	<div class="global-content-block">
		 <?$APPLICATION->IncludeComponent(
	"rd:form.result.new", 
	"twoColumns", 
	array(
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "Y",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"COMPONENT_TEMPLATE" => "twoColumns",
		"EDIT_URL" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"LIST_URL" => "",
		"SEF_MODE" => "N",
		"SUCCESS_URL" => "",
		"USE_EXTENDED_ERRORS" => "Y",
		"WEB_FORM_ID" => "6",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);?>
	</div>
	<div class="global-information-block">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	".default",
	Array(
		"AREA_FILE_RECURSIVE" => "Y",
		"AREA_FILE_SHOW" => "sect",
		"AREA_FILE_SUFFIX" => "information_block",
		"COMPONENT_TEMPLATE" => ".default",
		"EDIT_TEMPLATE" => ""
	)
);?>
	</div>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>