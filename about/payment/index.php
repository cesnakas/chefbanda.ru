<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Оплата, купить поварскую форму недорого в интернет-магазине Chef Banda");
$APPLICATION->SetPageProperty("description", "Вы можете купить поварскую форму недорого, выбрав удобный для вас способ оплаты: банковской картой онлайн на сайте, наличный или безналичный расчет при получении.");
$APPLICATION->SetTitle("Оплата");
?><?$APPLICATION->IncludeComponent(
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
<h1>Способы оплаты</h1>
<p><b>
Внимание! Оплата заказа при получении (курьеру) возможна только при доставке по Москве только собственным курьером интернет-магазина. Все остальные заказы принимаются в работу только после 100% предварительной оплаты.
</b></p>
<p>
</p>
<p>
	 Интернет-магазин <a href="/">chefbanda</a><a href="/">.ru</a> предлагает своим покупателям различные способы оплаты. Все возникшие вопросы по теме оплаты можно отправить на почту интернет-магазина. Мы также будем благодарны, если Вы поделитесь с нами своим мнением, какие способы оплаты были бы Вам наиболее удобны. В свою очередь, мы постараемся максимально оперативно внедрить наиболее популярные из Ваших предложений. Ждём Ваших писем на е-mail: <span class="mailme"><a href="mailto:info@chefbanda.ru">info@chefbanda.ru</a></span>.
</p>
<p>
 <b>Наличный расчет</b><b> </b>
</p>
<p>
	 Оплата товара производится наличными курьеру в момент получения заказа. К оплате принимаются только рубли РФ. Мы будем признательны, если приготовленная Вами сумма будет соответствовать сумме Вашего заказа с учетом доставки. Курьер передает покупателю кассовый чек и товарную накладную. <b>Данный вид оплаты возможен только для заказов, доставляемых по Москве собственным курьером интернет-магазина.</b>
</p>

<p>
 <b>Безналичный расчет</b><br>
</p>
<p>
	 Возможна оплата по безналичному расчету (по предварительному согласованию с менеджером магазина). От нашего курьера Вы получите все необходимые бухгалтерские документы. <b>Данный вид оплаты производится до отправки заказа и в 100% размере.</b>
</p>
<p>
 <b>Оплата банковской картой онлайн</b>
</p>
<p>
	 Наш сайт подключен к интернет-эквайрингу, и Вы можете оплатить Товар банковской картой Visa, Mastercard, Maestro, МИР. После подтверждения выбранного Товара откроется защищенное окно с платежной страницей нашего партнера - банка Tinkoff, где Вам необходимо ввести данные Вашей банковской карты. <b>Данный вид оплаты производится до отправки заказа и в 100% размере.</b>
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>