<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt">	 
	  <h3 class="admin_slider_insert_title">Добавление слайда</h3>

	<form action="" method="POST" enctype="multipart/form-data" class="admin_slider_insert_form">
		<div class="adm_slider_insert_form_row">
			<label for="" class="adm_slider_insert_form_label">Логотип бренда:</label> 
			<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
 	        <input type="file" id="a_s_i_logo" name="img_brand" class="adm_slider_insert_form_input">			 
		</div>
		<div class="admin_slider_insert_error">Выберите фотографию логотипа бренда!</div>

		<div class="adm_slider_insert_form_row">
			<label for="" class="adm_slider_insert_form_label">Альтернативный текст для изображения:</label> 
			<input id="a_s_i_name_brand" type="text" name="alt_logo" class="adm_slider_insert_form_input">
		</div>
		<div class="admin_slider_insert_error">Введите альтернативный текст для изображения!</div>

		<div class="adm_slider_insert_form_row">
			<label for="" class="adm_slider_insert_form_label">Заголовок:</label> 
			<textarea name="title" id="a_s_i_title"   class="adm_slider_insert_form_input"></textarea>
		</div>
		<div class="admin_slider_insert_error">Введите заголовок!</div>

		<div class="adm_slider_insert_form_row">
			<label for="" class="adm_slider_insert_form_label">Подзаголовок:</label> 
			<textarea name="subtitle" id="a_s_i_subtitle"   class="adm_slider_insert_form_input"></textarea>
		</div>
		<div class="admin_slider_insert_error">Введите подзаголовок!</div>

		<div class="adm_slider_insert_form_row">
			<label for="" class="adm_slider_insert_form_label">Основное изображение:</label> 
			<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
 	        <input type="file" id="a_s_i_main_img" name="img" class="adm_slider_insert_form_input"  >			 
		</div>
		<div class="admin_slider_insert_error">Выберите основное изображение!</div>

		<div class="adm_slider_insert_form_row">
			<label for="" class="adm_slider_insert_form_label">id товара:</label> 
			<input id="a_s_i_product_id" type="number" name="id_product" class="adm_slider_insert_form_input">
		</div>
		<div class="admin_slider_insert_error">Введите id товара!</div>

		<div class="adm_slider_insert_form_row">
			<label for="" class="adm_slider_insert_form_label">Видимость:</label>
			<select name="visibility_slide" class="adm_slider_insert_form_select">
				<option value="1" selected>да</option>
				<option value="0">нет</option>						 
			</select>					
		</div>
		 
		<input type="hidden" name="adm_slider_form_submit">
 		<button type="submit" class="adm_slider_insert_form_btn_submit">Добавить слайд</button> 	
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