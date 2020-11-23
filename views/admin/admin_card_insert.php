<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt">	 
	  <h3 class="admin_card_insert_title">Добавление рекламной карточки товара</h3>

	<form action="" method="POST" enctype="multipart/form-data" class="admin_card_insert_form">
		<div class="adm_card_insert_form_row">
			<label class="adm_card_insert_form_label">Изображение:</label> 
			<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
 	        <input type="file" id="a_c_i_foto" name="img" class="adm_card_insert_form_input"  >			 
		</div>
		<div class="admin_card_insert_error">Выберите изображение!</div>

		<div class="adm_card_insert_form_row">
			<label class="adm_card_insert_form_label">id товара:</label> 
			<input id="a_c_i_id_product" type="number" name="id_product" 
			value="<?= isset($_POST['id_product'])?$_POST['id_product']:'' ?>" 
			class="adm_card_insert_form_input">
		</div>
		<div class="admin_card_insert_error">Введите id товара!</div>		 

		<div class="adm_card_insert_form_row">
			<label class="adm_card_insert_form_label">Альтернативный текст для изображения:</label> 
			<input id="a_c_i_brand" type="text" name="alt_img"
			value="<?= isset($_POST['alt_img'])?$_POST['alt_img']:'' ?>"
			class="adm_card_insert_form_input">
		</div>
		<div class="admin_card_insert_error">Введите альтернативный текст для изображения!</div>			 

		<div class="adm_card_insert_form_row">
			<label class="adm_card_insert_form_label">Видимость:</label>
			<select name="visibility_card" id="" class="adm_card_insert_form_select">
				<option value="1" selected>да</option>
				<option value="0">нет</option>						 
			</select>					
		</div>
		 
		 <input type="hidden" name="adm_card_form_submit">
 		<button type="submit" class="adm_card_insert_form_btn_submit">Добавить карточку</button> 	
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