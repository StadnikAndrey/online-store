<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt">	 
	  <h3 class="admin_slider_update_title">Редактирование слайда id: <?= $slide['id'] ?></h3>
<?php if (isset($success) && empty($error)) : ?>
		<p class="admin_insert_brand_success  adm_sl_sc"><?= $success ?></p>
	<?php endif ?>
	<form action="" method="POST" enctype="multipart/form-data" class="admin_slider_up_form">
		<div class="adm_slider_up_form_row">
			<label for="" class="adm_slider_up_form_label">Логотип бренда:</label> 
			<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
 	        <input type="file" name="img_brand" class="adm_slider_up_form_input">			 
		</div>		 
		<div class="admin_slider_up_wrap_img">
			<img src="/public/img_slider/<?= $slide['logo'] ?> " alt="" class="admin_slider_up_img">			 
		</div>

		<div class="adm_slider_up_form_row">
			<label for="" class="adm_slider_up_form_label">Название бренда:</label> 
			<input id="adm_sl_up_alt_logo" type="text" name="alt_logo" 
			value="<?=  isset($_POST['alt_logo'])?$_POST['alt_logo']:$slide['alt_logo'];?>"
			class="adm_slider_up_form_input">
		</div>
		<div class="admin_slider_up_error">Введите название бренда!</div>

		<div class="adm_slider_up_form_row">
			<label for="" class="adm_slider_up_form_label">Заголовок:</label> 
			<textarea name="title" id="adm_al_up_title"   class="adm_slider_up_form_input"><?=  
			isset($_POST['title'])?$_POST['title']:$slide['title'];?>
			</textarea>
		</div>
		<div class="admin_slider_up_error">Введите заголовок!</div>

		<div class="adm_slider_up_form_row">
			<label for="" class="adm_slider_up_form_label">Подзаголовок:</label> 
			<textarea name="subtitle" id="adm_sl_up_st"   class="adm_slider_up_form_input"><?=  
			isset($_POST['subtitle'])?$_POST['subtitle']:$slide['subtitle'];?></textarea>
		</div>
		<div class="admin_slider_up_error">Введите подзаголовок!</div>

		<div class="adm_slider_up_form_row">
			<label for="" class="adm_slider_up_form_label">Основное изображение:</label> 
			<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
 	        <input type="file" name="img" class="adm_slider_up_form_input"  >			 
		</div>
		<div class="admin_slider_up_wrap_img">
			<img src="/public/img_slider/<?= $slide['img'] ?>" alt="" class="admin_slider_up_img">			 
		</div>

		<div class="adm_slider_up_form_row">
			<label for="" class="adm_slider_up_form_label">id товара:</label> 
			<input id="adm_sl_up_id_product" type="text" name="id_product"
			value="<?=  isset($_POST['id_product'])?$_POST['id_product']:$slide['link'];?>"
			class="adm_slider_up_form_input">
		</div>
		<div class="admin_slider_up_error">Введите id товара!</div>

		<div class="adm_slider_up_form_row">
			<label for="" class="adm_slider_up_form_label">Видимость:</label>
			<select name="visibility_slide" id="" class="adm_slider_up_form_select">
				<option value="1"
				<?php 
				if (isset($_POST['visibility_slide']) && $_POST['visibility_slide'] == 1) {
					echo 'selected';
				}elseif (!isset($_POST['visibility_slide']) && $slide['visibility']==1) {
					echo 'selected';
				}
				?>>да</option>
				<option value="0"
				<?php 
				if (isset($_POST['visibility_slide']) && $_POST['visibility_slide'] == 0) {
					echo 'selected';
				}elseif (!isset($_POST['visibility_slide']) &&$slide['visibility']==0) {
					echo 'selected';
				}
				?>>нет</option>						 
			</select>					
		</div>
		 
		<input type="hidden" name="adm_slider_up_form_submit">
 		<button type="submit" class="adm_slider_up_form_btn_submit">Сохранить изменения</button> 	
 	</form>	

	 
 	<?php if (isset($error) && !empty($error)) :
			foreach ($error as $key => $value) :?>
			 <p class="registration_error adm_sl_er"><?= $value ?></p>
			<?php endforeach;
	              endif; ?>
	  
	 
	 
	 
	</div> <!-- admin_rigt -->											
	</div> <!-- admin_container -->			
	</div> <!-- content -->
	</div> <!-- wrap_admin -->

</main>


<?php require_once ROOT . "/views/footer/footer.php";  ?> 