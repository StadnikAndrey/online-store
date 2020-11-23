<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt admin_insert_right">	 
	<h3 class="admin_insert_title">Добавление товара</h3>
	<form action="" method="POST" enctype="multipart/form-data" class="admin_insert_form">
	  <div class="admin_insert_form_row">
					<label for="" class="admin_insert_form_label">Категория:</label>
					<select name="adm_insert_category" id="a_i_cat" class="admin_insert_form_select">					 
						<option value selected>Категория</option>
					<?php foreach ($categorys as $key => $category) : ?>
						<option value="<?= $category['id'] ?>"
						<?= isset($_POST['adm_insert_category'])&&$_POST['adm_insert_category']== $category['id']?'selected':'' ?>
							><?= $category['description'] ?></option>
					<?php endforeach ?>						 
					</select>	
		</div>
		<div class="admin_insert_error">Выберите категорию товара!</div>
		 
		<div class="admin_insert_form_row" data-er="ошибка">
					<label for="" class="admin_insert_form_label">Название товара:</label> 
					<input id="a_i_name" type="text" name="adm_insert_name"
					value="<?= isset($_POST['adm_insert_name'])&&!empty($_POST['adm_insert_name'])?$_POST['adm_insert_name']:'' ?>" class="admin_insert_form_input">
		</div>
		<div class="admin_insert_error">Введите название товара!</div>

		<div class="admin_insert_form_row">
					<label for="" class="admin_insert_form_label">Вид товара:</label>
					<select name="adm_insert_subcategory" id="a_i_subcat" class="admin_insert_form_select">
						<option value selected>Вид товара</option>
					<?php foreach ($subcategorys as $key => $subcategory) : ?>
						<option value="<?= $subcategory['id'] ?>"
							<?= isset($_POST['adm_insert_subcategory'])&&$_POST['adm_insert_subcategory']== $subcategory['id']?'selected':'' ?>
						><?= $subcategory['name'] ?></option>
					<?php endforeach ?>
					</select>					
		</div>
		<div class="admin_insert_error">Выберите вид товара!</div>

		<div class="admin_insert_form_row">
			<label for="" class="admin_insert_form_label">Модель:</label> 
			<input id="a_i_model" type="text" name="adm_insert_model"
			value="<?= isset($_POST['adm_insert_model'])&&!empty($_POST['adm_insert_model'])?$_POST['adm_insert_model']:'' ?>" 
			 class="admin_insert_form_input">
		</div>
		<div class="admin_insert_error">Введите модель товара!</div>

		<div class="admin_insert_form_row">
					<label for="" class="admin_insert_form_label">Бренд:</label>
					<select name="adm_insert_brand" id="a_i_brand" class="admin_insert_form_select">
						<option value selected>Бренд</option>
					<?php foreach ($brands as $key => $brand) : ?>
						<option value="<?= $brand['id'] ?>"
						<?= isset($_POST['adm_insert_brand'])&&$_POST['adm_insert_brand']== $brand['id']?'selected':'' ?>
						><?= $brand['name'] ?></option>
					<?php endforeach ?>
					</select>					
		</div>
		<div class="admin_insert_error">Выберите бренд товара!</div>

		<div class="admin_insert_form_row">
			<label for="" class="admin_insert_form_label">Артикул:</label> 
			<input id="a_i_code" type="text" name="adm_insert_code"
			value="<?= isset($_POST['adm_insert_code'])&&!empty($_POST['adm_insert_code'])?$_POST['adm_insert_code']:'' ?>"
			 class="admin_insert_form_input">
		</div>
		<div class="admin_insert_error">Введите артикул товара!</div>

		<div class="admin_insert_form_row">
			<label for="" class="admin_insert_form_label">Цена:</label> 
			<input id="a_i_price" type="text" name="adm_insert_price"
			value="<?= isset($_POST['adm_insert_price'])&&!empty($_POST['adm_insert_price'])?$_POST['adm_insert_price']:'' ?>"
			 class="admin_insert_form_input">
		</div>
		<div class="admin_insert_error">Введите цену товара!</div>

		<div class="admin_insert_form_row">
			<label for="" class="admin_insert_form_label">Описание:</label> 
<textarea name="adm_insert_description" id="a_i_desc" cols="30" rows="10" class="admin_insert_form_input">
<?= isset($_POST['adm_insert_description'])&&!empty($_POST['adm_insert_description'])?$_POST['adm_insert_description']:'' ?></textarea>
		</div>
		<div class="admin_insert_error">Введите описание товара!</div>

		<div class="admin_insert_form_row">
			<label for="" class="admin_insert_form_label">Фотографии товара:</label> 
			<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
 	        <input type="file" id="a_i_img" name="adm_insert_imgs[]" class="admin_insert_form_input" multiple>			 
		</div>
		<div class="admin_insert_error">Выберите фотографии товара!</div>

		<div class="admin_insert_form_row">
			<label for="" class="admin_insert_form_label">Детали:</label> 
			<textarea name="adm_insert_details" id="a_i_details" cols="30" rows="10" class="admin_insert_form_input"><?= isset($_POST['adm_insert_details'])&&!empty($_POST['adm_insert_details'])?$_POST['adm_insert_details']:'' ?></textarea>
		</div>
		<div class="admin_insert_error">Введите детальное описание товара!</div>  

<div id="wr_ins_qa_prod">
		<?php foreach ($sizesProduct as $key => $size) : ?>
		<div class="admin_insert_form_row">			 
					<label for="" class="admin_insert_form_label">Количество товара <span><?=  $size['name'] ?></span> размера:</label>
					<input type="hidden" name="adm_ins_quantity_id_product[]"
					 value="<?= isset($new_product)&&$new_product!=0?$new_product:'' ?>">
					<input type="hidden" name="adm_ins_quantity_id_size[]" value="<?=  $size['id'] ?>">
					<input type="hidden" name="adm_ins_quantity_id_category[]" 
					value="<?= isset($new_product)&&$new_product!=0?$product['id_category']:'' ?>">
					<select name="adm_insert_quantity_product[]" id="" class="admin_insert_form_select">
						<option value selected>Количество</option>
						<?php for ($i=1; $i <= 20; $i++) : ?>
                    <option value="<?= $i ?>"
						<?php 
						if (isset($_POST['adm_insert_quantity_product']) && $_POST['adm_insert_quantity_product'][$key]==$i) {							 
							echo 'selected';						 
						}						 
						?>
                    	><?= $i ?></option>
						<?php endfor ?>
					</select>			 				
		</div>
	<?php endforeach ?>	 
</div>
<div class="admin_insert_error">Выберите количество товара соответственно размеру!</div> 

		<input type="hidden" name="adm_insert_hidden">
 		<button type="submit" class="admin_insert_form_btn_submit">Добавить товар</button> 	
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