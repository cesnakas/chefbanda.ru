<div id="appFastBuy" data-load="<?=SITE_TEMPLATE_PATH?>/images/picLoad.gif">
	<div id="appFastBuyContainer">
		<div class="heading"><span class="fastBuyTitle">Купить в один клик</span> <a href="#" class="close closeWindow"></a></div>
		<div class="container" id="fastBuyOpenContainer">
			<div class="column">
				<div id="fastBuyPicture"><a href="#" class="url"><img src="<?=SITE_TEMPLATE_PATH?>/images/picLoad.gif" alt="" class="picture"></a></div>
				<div id="fastBuyName"><a href="" class="name url"><span class="middle"></span></a></div>
				<div id="fastBuyPrice" class="price"></div>
			</div>
			<div class="column">
				<div class="title">Заполните данные для заказа</div>
				<form action="<?=SITE_DIR?>callback/" id="fastBuyForm" method="GET">
					<input name="id" type="hidden" id="fastBuyFormId" value="">
					<input name="act" type="hidden" id="fastBuyFormAct" value="fastBack">
					<input name="isSert" type="hidden" id="fastBuyFormIsSert" value="N">
					<input name="SITE_ID" type="hidden" id="fastBuyFormSiteId" value="<?=SITE_ID?>">
					<div class="formLine"><input name="name" type="text" placeholder="Имя*" value="" id="fastBuyFormName"></div>
					<div class="formLine"><input name="lname" type="text" placeholder="Фамилия*" value="" id="fastBuyFormLName"></div>
					<div class="formLine"><input name="phone" type="text" class="phone" placeholder="Телефон*" value="" id="fastBuyFormTelephone"></div>
					<div class="formLine" id="phoneError"></div>
					<div class="formLine"><input name="email" type="text" placeholder="E-mail*" value="" id="fastBuyFormEmail"></div>
					<div class="formLine" id="emailError"></div>	
					<div class="formLine"><input name="address1" type="text" placeholder="Адрес доставки (область, город, улица, дом)*" value="" id="fastBuyFormAddress"></div>					
					<div class="formLine"><textarea name="message" cols="30" rows="10" placeholder="Сообщение" id="fastBuyFormMessage"></textarea></div>
					<div class="formLine"><input type="checkbox" name="personalInfoFastBuy" id="personalInfoFastBuy"><label for="personalInfoFastBuy">Я согласен на <a href="/personal-info/" class="pilink">обработку персональных данных.</a>*</label></div>
					<div class="formLine">
						<input type="checkbox" name="personalOfertaFastBuy" id="personalOfertaFastBuy">
						<label for="personalInfoFastBuy">Я согласен c условиями 
							<a href="/about/oferta/" class="pilink">договора оферты.</a>*
						</label>
					</div>
					<div class="formLine"><a href="#" id="fastBuyFormSubmit"><img src="<?=SITE_TEMPLATE_PATH?>/images/incart.png" alt="Купить в один клик"> <span class="fastBuyTitle">Купить в один клик</span></a></div>
				</form>
			</div>
		</div>
		<div id="fastBuyResult">
			<div id="fastBuyResultTitle"></div>
			<div id="fastBuyResultMessage"></div>
			<a href="" id="fastBuyResultClose" class="closeWindow">Закрыть окно</a>
        </div>		
	</div>
</div>
<script>
	$(document).ready(function(){
		$("#fastBuyFormTelephone").focusout(function(){
			var phone=$(this).val();
			if (phone.charAt(4)==8 && phone.charAt(5)==9) {
				$("#phoneError").text("Поле Телефон заполнено некорректно").css("color", "red");
				$(this).css("color", "red").val('').focus();
			} else {
				$("#phoneError").text("");
				$(this).css("color", "#000")
			}

		});
		$("#fastBuyFormEmail").focusout(function(){
			var email=$(this).val();
			if (email.indexOf('@') == -1) {
				$("#emailError").text("Поле E-mail заполнено некорректно").css("color", "red");
				$(this).css("color", "red").val('');
			} else {
				$("#emailError").text("");
				$(this).css("color", "#000")
			}
		});
	});
</script>