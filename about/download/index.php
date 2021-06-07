<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Документы для загрузки интернет-магазина Chef Banda");
$APPLICATION->SetTitle("Документы для загрузки");
?><h1>Помощь и сервисы</h1>
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
<p>
	 В случае необходимости обмена товара на другой, а так же в случае возврата денежных средств, необходимо распечатать заявление, представленное ниже, приложить ксерокопию паспорта покупателя (заявителя) и отправить данный комплект документов для решения вопроса по адресу компании ООО "Юнайтед Юниформс", владельца интернет-магазина <a href="/" class="link-def">https://chefbanda.ru/</a>
	по адресу: <br>
 <i>123298, г. Москва, ул. Маршала Бирюзова, д.1, корп. 1А, офис 315</i> <br>
</p>
<p>
	 Мы реагируем максимально оперативно на ваши вопросы, что бы процесс как покупки, так и возможных сервисных операций был для вас комфортным!
</p>
<p>
 <a href="/upload/zayavlenie_obmen.doc" title="UU_zayvlenie_na_obmen.doc" class="link-def">Заявление на обмен</a>
</p>
<p>
 <a href="/upload/zayavlenie_vozvrat.doc" class="link-def">Заявление на возврат денежных средств</a>
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>