<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Контакты, магазин одежды для поваров Chef Banda");
$APPLICATION->SetPageProperty("description", "Магазин одежды для поваров Chef Banda ответит на все Ваши вопросы - просто позвоните нам или напишите письмо.");
$APPLICATION->SetTitle("Контакты");
?><h1>О компании</h1>
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
		"ROOT_MENU_TYPE" => "about_footer",
		"USE_EXT" => "N"
	)
);?>
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
 <a href="tel:+7-903-000-34-94">+7-903-000-34-94<br>
			 (What`s App и Viber)</a><br>
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
 <a href="mailto:shop@chefbanda.ru">shop@chefbanda.ru</a><br>
 <a href="mailto:info@chefbanda.ru">info@chefbanda.ru</a><br>
 <a href="mailto:trade@chefbanda.ru">trade@chefbanda.ru</a><br>
 <a href="mailto:manager@chefbanda.ru">manager@chefbanda.ru</a><br>
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
<p>
 <strong>Адреса магазинов</strong>
</p>
<p>
	<a href="/stores/8/">г. Москва, м. Кропоткинская</a>
</p>
<p>
	<a href="/stores/4/">г. Москва, м. Китай-город</a>
</p>
<p>
	<a href="/stores/9/">г. Москва, м. Щукинская</a>
</p>
<p>
	<a href="/stores/2/">г. Москва, м. Юго-западная</a>
</p>
<p>
	<a href="/stores/14/">г. Санкт-Петербург, м. Площадь Восстания</a>
</p>
<p>
	<a href="/stores/17/">г. Новосибирск, м. Заельцовская</a>
</p>
<p>
	<a href="/stores/16/">г. Сочи, ул. Московская</a>
</p>
<p>
	<a href="/stores/1/">г. Казань, м. Площадь Габдулы Тукая</a>
</p>
<p>
	<a href="/stores/18/">г. Владикавказ, ул. Владикавказская</a>
</p>
<p>
 <b>Данные о компании: </b>
</p>
<p>
 <b>Краткое название:</b> ООО «Юнайтед Юниформс» 
</p>
<p>
 <b>Юридический адрес:</b> г. Москва, ул. Маршала Бирюзова, д.1, корп. 1А, офис 315  
</p>
<p>
 <b>ИНН</b> 7718936350
</p>
<p>
 <b>ОГРН</b> 1137746493180
</p>
 По вопросам, связанным с заказами в интернет-магазине: <a href="mailto:shop@chefbanda.ru">shop@chefbanda.ru</a>
<p>
</p>
<p>
	 По вопросам, связанным с корпоративными и оптовыми закупками: <a href="mailto:trade@chefbanda.ru">trade@chefbanda.ru</a> , <a href="mailto:manager@chefbanda.ru">manager@chefbanda.ru</a>
</p>
<p>
	 По общим вопросам: <a href="mailto:info@chefbanda.ru">info@chefbanda.ru</a>
</p>
 <?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view",
	".default",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"CONTROLS" => array(0=>"TYPECONTROL",1=>"SCALELINE",),
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:55.789181405268835;s:10:\"yandex_lon\";d:37.498508338622955;s:12:\"yandex_scale\";i:16;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:37.498508338623004;s:3:\"LAT\";d:55.78918140527517;s:4:\"TEXT\";s:90:\"г. Москва, ул. Маршала Бирюзова, д.1, корп. 1А, офис 315\";}}}",
		"MAP_HEIGHT" => "500",
		"MAP_ID" => "",
		"MAP_WIDTH" => "100%",
		"OPTIONS" => array(0=>"ENABLE_DBLCLICK_ZOOM",1=>"ENABLE_DRAGGING",)
	)
);?><br>
 <br>
 <br>
 <?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new",
	"twoColumns",
	Array(
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "Y",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"COMPONENT_TEMPLATE" => ".default",
		"EDIT_URL" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"LIST_URL" => "",
		"SEF_MODE" => "N",
		"SUCCESS_URL" => "",
		"USE_EXTENDED_ERRORS" => "Y",
		"VARIABLE_ALIASES" => array("WEB_FORM_ID"=>"WEB_FORM_ID","RESULT_ID"=>"RESULT_ID",),
		"WEB_FORM_ID" => "2"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>