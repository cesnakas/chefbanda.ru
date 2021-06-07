<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Партнерская программа бренда Bandit, поварская одежда оптом");
$APPLICATION->SetPageProperty("description", "Стань партнером Bandit - бренда поварской одежды. Поварская одежда оптом по выгодным ценам.");
$APPLICATION->SetTitle("Как стать оптовиком");?><h1>О компании</h1>
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
<?$APPLICATION->IncludeComponent(
	"systemtpl:add.iblock", 
	"optovik", 
	array(
		"ADD_ACTIVE" => "Y",
		"AUTO_EMAIL_TO" => "",
		"AUTO_MAIL" => "N",
		"AUTO_SUBJ" => "Запрос с сайта #SERVER_NAME#",
		"DATE_IN_NAME" => "Y",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "",
		),
		"IBLOCK_ID" => "27",
		"IBLOCK_TYPE" => "request",
		"ID_BUTT" => "sendPart",
		"LINK_NAME" => "Заказать звонок",
		"LINK_SHOW" => "Y",
		"POST_CODE" => "PARTNERS_FORM",
		"POST_SEND" => "Y",
		"PROPERTY_CODE" => array(
			0 => "FNAME",
			1 => "DOLWNOST",
			2 => "PHONE",
			3 => "EMAIL",
			4 => "CITY",
			5 => "ORGANIZTION",
			6 => "PURPOSE",
			7 => "KIND",
			8 => "TYPE_CONN",
			9 => "TIME",
			10 => "POWELANY",
			11 => "",
		),
		"REQ_FIELD_CODE" => array(
			0 => "NAME",
			1 => "",
		),
		"REQ_PROPERTY_CODE" => array(
			0 => "FNAME",
			1 => "PHONE",
			2 => "CITY",
			3 => "",
		),
		"SEND_AJAX" => "Y",
		"SUCCES_SHOW" => "Y",
		"SUCCES_TEXT" => "<p>Спасибо за запрос! Наша команда скоро свяжется с вами.</p>",
		"USE_CAPTCHA" => "N",
		"USE_HIDDEN" => "Y",
		"COMPONENT_TEMPLATE" => "optovik"
	),
	false
);?>

<?

?>
<div class="global-block-container" style="display:none;">
	<div class="global-content-block">
 <img src="/bitrix/templates/dresscode/images/optBanner.png" class="pagePicture" alt="">
		<h2 class="mediumText">Мы работаем с оптовыми покупателями (как с физическими, так и с юридическими лицами).</h2>
		<h3>Возможные варианты сотрудничества:</h3>
		<div class="priceTableContainer">
			<table class="priceTableStyle80">
			<thead>
			<tr>
				<th>
					 Тип цены
				</th>
				<th>
					 Как получить статус
				</th>
				<th>
					 Скидка
				</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td>
					 Розничная цена
				</td>
				<td>
					 Базовая цена для всех незарегистрированных пользователей
				</td>
				<td>
					 Базовая цена
				</td>
			</tr>
			<tr>
				<td>
					 Постоянный клиент
				</td>
				<td>
					 Статус присваевается при покупке более чем на 15 000 рублей
				</td>
				<td>
					 Скидка: 5%
				</td>
			</tr>
			<tr>
				<td>
					 Мелкий опт
				</td>
				<td>
					 Статус присваевается при покупке более чем на 45 000 рублей
				</td>
				<td>
					 Скидка: 10%
				</td>
			</tr>
			<tr>
				<td>
					 Крупный опт
				</td>
				<td>
					 Статус присваевается при покупке более чем на100 000 рублей ЕЖЕМЕСЯЧНО
				</td>
				<td>
					 Скидка: 15%
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		<h3 class="mediumText">Пять причин работать с нами!</h3>
		<ul>
			<li>Выгодные цены.</li>
			<li>Гибкая система скидок.</li>
			<li>Удобная система оповещения.</li>
			<li>Оперативная отгрузка товара.</li>
			<li>Быстрая доставка товара до клиента.</li>
		</ul>
		<h3 class="mediumText">Стать оптовиком легко! - просто напишите нам!</h3>
		<p>
			 В письме необходимо указать:
		</p>
		<ul>
			<li>ФИО контактного лица</li>
			<li>Электронная почта </li>
			<li>Полное наименование предприятия</li>
			<li>Наименование бренда</li>
			<li>Контактный телефон</li>
		</ul>
		<h4 class="mediumText">Адрес элекронной почты для связи: <a href="mailto:&lt;?=COption::GetOptionString(">" data-bx-app-ex-href="mailto:<?=COption::GetOptionString("sale", "order_email")?> "&gt;<?=COption::GetOptionString("sale", "order_email")?></a></h4>
		 Мы будем рады взаимовыгодному сотрудничеству!
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
 <br>
 <br>
<script>
$(document).ready(function() {
		$("input[name=PHONE]").focusout(function(){
			var phone=$(this).val();
			if (phone.charAt(4)==8 && phone.charAt(5)==9) {
				$("#phone_error").text("Поле Телефон заполнено некорректно").css("color", "red");
				$(this).css("color", "red").val('').focus();
				$("#phone_label").css("color", "red");

			$(".submit-tab").click(function(e){
				e.preventDefault();
				e.stopPropagation();
				return false;
			});
			} else {
					$("phone_error").hide();
					$(this).css("color", "#555555");
					$("#phone_label").css("color", "#555555");

				$(".submit-tab").click(function(e){
					$("form[name=DW_FEEDBACK_FORM]").submit();
				});
			}
		});
	});
</script><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>