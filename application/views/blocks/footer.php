<div class="footor container-fluid font-roboto">
	
	<div class="col-md-8 col-md-offset-3">
		<ul class="bottom_menu">
		<li>
		<a href="/ugolovnie-dela/">Услуги адвоката</a>
		</li>
		<li>
		<a href="/svidetelstvo-rebenka-krim/">Свидетельство о рождении ребенка в Крыму</a>
		</li>
		<li>
		<a href="/semeinie-spori/">Семейные споры</a>
		</li>
		<li>
		<a href="/">Отзывы Клиентов</a>
		</li>
		</ul>
	</div>
	
    <div class='col-xs-6'><a href="/"><span>Адвокат</span> Гончаренко Евгений Сергеевич &#169 2017</a><br>Все права защищены</div>
	
    <div class='col-xs-6 txt-right'>
        <a href="tel:097 644-51-34">+38-097-664-51-34</a><br>
        <a href="mailto:privatadvokat@yandex.ua">privatadvokat@yandex.ua</a>
    </div>
</div>

<div class="scroll-up">
		<ul><li><a href="#header"><i class="fa fa-angle-up"></i></a></li></ul>
	</div>
	
<!-- Callback -->
		<div class="callback"  id="callback">
			<div class="call-in-text">Перезвоните мне</div>
			<div class="call-in-img"><img src="<?=DIR_IMG?>call-img.png" alt=""></div>
		</div>	

		<!-- callback form -->
		<div class="callback-overlay"></div>
		<div class="callback-form">
			<div class="callback-close">×</div>
			<div class="callback-inner">
				<form action="" method="post">
					<p>Ваш номер телефона:</p>
					

					<input class="callphone" name="callphone" type="text" id="phone2" placeholder="+__ (___) ___-__-__" required>
					<input type="submit" value="Перезвоните мне" name="callsend">
				</form>
			</div>
		</div>	
		<!--  -->
				
			<script type="text/javascript">
           //callback
			$('#callback').click(function() {
				$('.callback-overlay').fadeIn(600);
			    $('.callback-form').addClass('callback-show');
			});

			$('.callback-overlay').click(function() {
				$('.callback-overlay').fadeOut(600);
			    $('.callback-form').removeClass('callback-show');
			});
			$('.callback-close').click(function() {
				$('.callback-overlay').fadeOut(600);
			    $('.callback-form').removeClass('callback-show');
			});

        </script>

<script type="text/javascript" src="/js/jquery.magnific-popup.js"></script>

</body>
</html>
