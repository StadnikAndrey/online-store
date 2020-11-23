<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt">	 
	  <h3 class="admin_card_up_title">Редактирование карточки id: <?= $card['id'] ?></h3>
	  <?php if (isset($success) && empty($error)) : ?>
		<p class="admin_insert_brand_success  adm_card_sc"><?= $success ?></p>
	<?php endif ?>

	<form action="" method="POST" enctype="multipart/form-data" class="admin_card_up_form">
		<div class="adm_card_up_form_row">
			<label for="" class="adm_card_up_form_label">Изображение:</label> 
			<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
 	        <input type="file" name="img" class="adm_card_up_form_input"  >			 
		</div>
		<div class="admin_card_up_wrap_img">
			<img src="/public/img_cards/<?= $card['img'] ?>" alt="" class="admin_card_up_img">			 
		</div>

		<div class="adm_card_up_form_row">
			<label for="" class="adm_card_up_form_label">id товара:</label> 
			<input id="a_u_c_id_product" type="number" name="id_product"
			value="<?=  isset($_POST['id_product'])?$_POST['id_product']:$card['link'];?>"
			class="adm_card_up_form_input">
		</div>
		<div class="admin_card_up_error">Введите id товара!</div>		 

		<div class="adm_card_up_form_row">
			<label for="" class="adm_card_up_form_label">Альтернативный текст для изображения:</label> 
			<input id="a_u_c_brand" type="text" name="name_brand"
			value="<?=  isset($_POST['name_brand'])?$_POST['name_brand']:$card['alt_img'];?>"
			class="adm_card_up_form_input">
		</div>
		<div class="admin_card_up_error">Введите альтернативный текст для изображения!</div>		 

		<div class="adm_card_up_form_row">
			<label for="" class="adm_card_up_form_label">Видимость:</label>
			<select name="visibility" id="" class="adm_card_up_form_select">
				<option value="1"<?php 
				if (isset($_POST['visibility']) && $_POST['visibility'] == 1) {
					echo 'selected';
				}elseif (!isset($_POST['visibility']) && $card['visibility']==1) {
					echo 'selected';
				}
				?>>да</option>
				<option value="0"<?php 
				if (isset($_POST['visibility']) && $_POST['visibility'] == 0) {
					echo 'selected';
				}elseif (!isset($_POST['visibility']) && $card['visibility']==0) {
					echo 'selected';
				}
				?>>нет</option>						 
			</select>					
		</div>
		 
		 <input type="hidden" name="adm_card_up_form_submit">
 		<button type="submit" class="adm_card_up_form_btn_submit">Сохранить изменения</button> 	
 	</form>
 	<?php if (isset($error) && !empty($error)) :
			foreach ($error as $key => $value) :?>
			 <p class="registration_error adm_card_er"><?= $value ?></p>
			<?php endforeach;
	              endif; ?>	
	  
	 
	 
	</div> <!-- admin_rigt -->											
	</div> <!-- admin_container -->			
	</div> <!-- content -->
	</div> <!-- wrap_admin -->

</main>


<?php require_once ROOT . "/views/footer/footer.php";  ?> 