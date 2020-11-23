<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt admin_update_right">	 
	<h3 class="admin_update_title">Редактирование товара ( id:<?= $product['id'] ?> артикул: <?= $product['code'] ?> )</h3>
	<?php if (isset($txt)): ?>
		<p class="adm_up_sucsess"><?= $txt ?></p>
	<?php endif ?>
	<form action="" method="POST" enctype="multipart/form-data" class="admin_update_form">
		<div class="admin_update_form_row">
					<label for="" class="admin_update_form_label">Категория:</label>
					<select name="adm_upd_category" id="a_up_category" class="admin_update_form_select">
						<option value selected>Категория</option>
						<?php foreach ($categorys as $key => $category) : ?>
						<option value="<?= $category['id'] ?>"
					<?php							 			 
					if (isset($_POST['adm_upd_category']) && $_POST['adm_upd_category'] == $category['id']
						&& !empty($_POST['adm_upd_category'])) {
					echo 'selected';
				    }elseif ($product['id_category']==$category['id'] && !isset($_POST['adm_upd_category'])) { 
					         echo 'selected';
				            }							 
					?>><?= $category['description'] ?></option>
						<?php endforeach ?>
					</select>					
		</div>
		<div class="admin_update_error">Выберите категорию товара!</div>

		<div class="admin_update_form_row" data-er="ошибка">
					<label for="" class="admin_update_form_label">Название товара:</label> 
					<input id="a_up_name" type="text" name="adm_upd_name" value="<?php	 							 			 
					if (isset($_POST['adm_upd_name']) && !empty($_POST['adm_upd_name'])) {
					echo $_POST['adm_upd_name'];
				    }elseif (!isset($_POST['adm_upd_name']) || empty($_POST['adm_upd_name'])) { 
					         echo $product['name'];
				            }							 
					?>" class="admin_update_form_input">
		</div>
		<div class="admin_update_error">Введите название товара!</div>

		<div class="admin_update_form_row">
					<label for="" class="admin_update_form_label">Вид товара:</label>
					<select name="adm_upd_subcategory" id="a_up_subcategory" class="admin_update_form_select">
						<option value selected>Вид товара</option>
						<?php foreach ($subcategorys as $key => $subcategory) : ?>
						<option value="<?= $subcategory['id'] ?>"
							<?php							 			 
					if (isset($_POST['adm_upd_subcategory']) && $_POST['adm_upd_subcategory'] == $subcategory['id']
						&& !empty($_POST['adm_upd_subcategory'])) {
					echo 'selected';
				    }elseif ($product['id_subcategory']==$subcategory['id'] && !isset($_POST['adm_upd_subcategory'])) { 
					         echo 'selected';
				            }							 
					?>><?= $subcategory['name'] ?></option>
						<?php endforeach ?>
					</select>					
		</div>
		<div class="admin_update_error">Выберите вид товара!</div>

		<div class="admin_update_form_row">
			<label for="" class="admin_update_form_label">Модель:</label> 
			<input id="a_up_model" type="text" name="adm_upd_model" value="<?php 							 			 
					if (isset($_POST['adm_upd_model']) && !empty($_POST['adm_upd_model'])) {
					echo $_POST['adm_upd_model'];
				    }elseif (!isset($_POST['adm_upd_model']) || empty($_POST['adm_upd_model'])) { 
					         echo $product['model'];
				            }							 
					?>"
			 class="admin_update_form_input">
		</div>
		<div class="admin_update_error">Введите модель товара!</div>

		<div class="admin_update_form_row">
					<label for="" class="admin_update_form_label">Бренд:</label>
					<select name="adm_upd_brand" id="a_up_barand" class="admin_update_form_select">
						<option value selected>Бренд</option>
						<?php foreach ($brands as $key => $brand) : ?>
						<option value="<?= $brand['id'] ?>"
							<?php							 			 
					if (isset($_POST['adm_upd_brand']) && $_POST['adm_upd_brand'] == $brand['id']
						&& !empty($_POST['adm_upd_brand'])) {
					echo 'selected';
				    }elseif ($product['id_brand']==$brand['id'] && !isset($_POST['adm_upd_brand'])) { 
					         echo 'selected';
				            }							 
					?>><?= $brand['name'] ?></option>
						<?php endforeach ?>
					</select>					
		</div>
		<div class="admin_update_error">Выберите бренд товара!</div>

		<div class="admin_update_form_row">
			<label for="" class="admin_update_form_label">Артикул:</label> 
			<input id="a_up_code" type="text" name="adm_upd_code" value="<?php	 							 			 
					if (isset($_POST['adm_upd_code']) && !empty($_POST['adm_upd_code'])) {
					echo $_POST['adm_upd_code'];
				    }elseif (!isset($_POST['adm_upd_code']) || empty($_POST['adm_upd_code'])) { 
					         echo $product['code'];
				            }							 
					?>"
			 class="admin_update_form_input">
		</div>
		<div class="admin_update_error">Введите артикул товара!</div>

		<div class="admin_update_form_row">
			<label for="" class="admin_update_form_label">Цена:</label> 
			<input id="a_up_price" type="text" name="adm_upd_price" value="<?php 							 			 
					if (isset($_POST['adm_upd_price']) && !empty($_POST['adm_upd_price'])) {
					echo $_POST['adm_upd_price'];
				    }elseif (!isset($_POST['adm_upd_price']) || empty($_POST['adm_upd_price'])) { 
					         echo $product['price'];
				            }							 
					?>"
			 class="admin_update_form_input">
		</div>
		<div class="admin_update_error">Введите цену товара!</div>

		<div class="admin_update_form_row">
			<label for="" class="admin_update_form_label">Описание:</label> 
			<textarea name="adm_upd_description" id="a_up_description" cols="30" rows="10" class="admin_update_form_input"><?php	 
					if (isset($_POST['adm_upd_description']) && !empty($_POST['adm_upd_description'])) {
					echo $_POST['adm_upd_description'];
				    }elseif (!isset($_POST['adm_upd_description']) || empty($_POST['adm_upd_description'])) { 
					         echo $product['description'];
				            }							 
					?></textarea>
		</div>
		<div class="admin_update_error">Введите описание товара!</div>

		<div class="admin_update_form_row">
			<label for="" class="admin_update_form_label">Фотографии товара:</label> 
			<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
 	        <input type="file" name="adm_upd_img[]" class="admin_update_form_input" multiple>			 
		</div>		
		<div class="admin_update_wrap_imgs">
			<?php foreach ($arr_img as $key => $img) : ?>
			<div class="adm_up_container_img">
				<img src="/public/img_products/<?= $img ?>" alt="" class="admin_update_img">
			</div>
			 <?php endforeach ?>
		</div>

		<div class="admin_update_form_row">
			<label for="" class="admin_update_form_label">Детали:</label> 
			<textarea name="adm_upd_details" id="a_up_details" cols="30" rows="10" class="admin_update_form_input"><?php 
					if (isset($_POST['adm_upd_details']) && !empty($_POST['adm_upd_details'])) {
					echo preg_replace('/(<br>){0,100}/iu','', trim($_POST['adm_upd_details']));
				    }elseif (!isset($_POST['adm_upd_details']) || empty($_POST['adm_upd_details'])) { 
					         echo preg_replace('/(<br>){0,100}/iu','', $product['details']);
				            }							 
					?></textarea>
		</div>
		<div class="admin_update_error">Введите детальное описание товара!</div> 

		<?php foreach ($sizesProduct as $key => $size) : ?>
		<div class="admin_update_form_row">
					<label for="" class="admin_update_form_label">Количество товара <span><?=  $size['name'] ?></span> размера:</label>
					<input type="hidden" name="admin_update_quantity_id_product[]"
					value="<?= isset($product_up)?$product_up['id']:'' ?>">
					<input type="hidden" name="admin_update_quantity_id_size[]" value="<?=  $size['id'] ?>">
					<input type="hidden" name="admin_update_quantity_id_category[]" 
					value="<?= isset($product_up)?$product_up['id_category']:'' ?>">
					<select name="admin_update_quantity_product[]" id="" class="admin_update_form_select">
						<option value selected>Количество</option>
						<?php for ($i=1; $i <= 20; $i++) : ?>
                    <option value="<?= $i ?>" 
                    	<?php	
                    	if (isset($_POST['admin_update_quantity_product'][$key]) && $_POST['admin_update_quantity_product'][$key]==$i) {							 
							echo 'selected';						 
						}else{
							foreach ($product_size as $value) {
								if ($value['products_count']==$i && $size['id']==$value['id_size']
									&& !isset($_POST['admin_update_quantity_product'][$key])) {
							echo 'selected';	
						    }
							}							 	
						} 					 						 
					?>><?= $i ?></option>
						<?php endfor ?>
					</select>					
		</div>
		<?php endforeach ?>
		 
		<input type="hidden" name="adm_update_hidden">
 		<button type="submit" class="admin_update_form_btn_submit" disabled>Сохранить изменения</button> 	
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