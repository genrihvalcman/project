  <div class='container'>
        <div class=' mainText col-md-12'>
		<h1><?=$titlePage?></h1>
           <?=$textPage?>
		   <?php
		if (empty($searchResult)) { ?>
			<a name="new_comment"></a><h1>Отзывы</h1>
			<?php
			if (!empty($commentQuery)) {
				
				foreach ($commentQuery as $comment) {
					echo "<li><b>Автор</b>: $comment[com_name]<br/>
						 <b>Дата</b>: $comment[com_date]<br/>
						 <p>$comment[com_text]</p></li><hr/>";
				}
				
			}
			else {
				echo "<h3>Здесь пока нет ни одного отзыва</h3>";
			}
			?>
			<br/>
			<a name="comment"></a><h3>Оставить отзыв</h3>
			<div class="form_comment">
			<form action="" method="POST" >
				<p><input type="text" name="name_com" placeholder="Имя (обязательное поле)" size="43" /></p>
				<p><input type="text" name="email_com" placeholder="Email (необязательное поле)" size="43" /></p>
				<p><textarea name="text_com" placeholder="Текст отзыва (обязательное поле)" rows="10" cols="45"></textarea></p>
				<div class="g-recaptcha" data-sitekey="6LcclwwTAAAAAFKBeYDuDSSDFGUvv8eL3t-EF_AD"></div>
				<p><input type="submit" name="send_com" value="Отправить" /></p>
			</form>
			<div style="color: red;">
				<?
				if ($_GET['err'] == 1) {
					echo 'Не заполнены обязательные поля!<br/>';
					unset($_GET['err']);
				}
				?>
			</div>
			<? } else {$this->printPageBlock('searchresult');} ?>
			</div>
        </div>
		
    </div>
