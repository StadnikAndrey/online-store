<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt">	 
	 <h3 class="admin_news_insert_title">Добавление новости</h3>

	<form action="" method="POST" enctype="multipart/form-data" class="admin_news_insert_form">		 
		<div class="admin_news_insert_form_row">
			<label for="" class="admin_news_insert_form_label">Заголовок:</label> 
			<textarea name="adm_news_in_title" id="a_n_i_title"   rows="2" class="admin_news_insert_form_input"><?=
			isset($_POST['adm_news_in_title'])?htmlentities(trim($_POST['adm_news_in_title']), ENT_QUOTES):''
			 ?></textarea>
		</div>
		<div class="admin_news_insert_error">Введите заголовок статьи!</div>

		<div class="admin_news_insert_form_row">
			<label for="" class="admin_news_insert_form_label">Подзаголовок:</label> 
			<textarea name="adm_news_in_subtitle" id="a_n_i_subtitle"   rows="5" class="admin_news_insert_form_input"><?=
			isset($_POST['adm_news_in_subtitle'])?htmlentities(trim($_POST['adm_news_in_subtitle']), ENT_QUOTES):''
			 ?></textarea>
		</div>
		<div class="admin_news_insert_error">Введите подзаголовок статьи!</div>

		<div class="admin_news_insert_form_row">
			<label for="" class="admin_news_insert_form_label">Главное изображение:</label> 
			<input type="hidden" name="MAX_FILE_SIZE"  value="3000000">
 	        <input type="file" id="a_n_i_img_first" name="img_first" class="admin_news_insert_form_input">			 
		</div>
		<div class="admin_news_insert_error">Выберите изображение!</div>

		<div class="admin_news_insert_form_row">
			<label for="" class="admin_news_insert_form_label">1-й блок текста:</label> 
			<textarea name="adm_news_in_txt_one" id=""   rows="5" class="admin_news_insert_form_input"></textarea>
		</div>

		<div class="admin_news_insert_form_row">
			<label for="" class="admin_news_insert_form_label">Фотографии к текстовому блоку № 1:</label> 
			<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
 	        <input type="file" name="img_one[]" class="admin_news_insert_form_input" multiple>			 
		</div>

		<div class="admin_news_insert_form_row">
			<label for="" class="admin_news_insert_form_label">2-й блок текста:</label> 
			<textarea name="adm_news_in_txt_two" id=""   rows="5" class="admin_news_insert_form_input"></textarea>
		</div>

		<div class="admin_news_insert_form_row">
			<label for="" class="admin_news_insert_form_label">Фотографии к текстовому блоку № 2:</label> 
			<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
 	        <input type="file" name="img_two[]" class="admin_news_insert_form_input" multiple>			 
		</div>

		<div class="admin_news_insert_form_row">
			<label for="" class="admin_news_insert_form_label">3-й блок текста:</label> 
			<textarea name="adm_news_in_txt_three" id=""   rows="5" class="admin_news_insert_form_input"></textarea>
		</div>
 		 
		<input type="hidden" name="adm_news_insert_submit">
 		<button type="submit" class="admin_news_insert_form_btn">Добавить новость</button> 	
 	</form>	
 	<?php if (isset($error) && !empty($error)) :
				foreach ($error as $key => $value) :?>
			 <p class="registration_error"><?= $value ?></p>
			<?php endforeach;
			      endif; ?>	 
	 
	</div> <!-- admin_rigt -->											
	</div> <!-- admin_container -->			
	</div> <!-- content -->
	</div> <!-- wrap_admin -->

</main>


<?php require_once ROOT . "/views/footer/footer.php";  ?> 