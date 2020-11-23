<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt">	 
	<h3 class="admin_update_brand_title">Редактирование бренда 
		<span class="admin_update_brand_title_name"><?= $brand[0]['name'] ?></span>
	 ( id: <?= $brand[0]['id'] ?> )</h3>

	<form action="" method="POST" class="admin_update_brand_form">
		 
		<div class="admin_update_brand_form_row">
			<label for="" class="admin_update_brand_form_label">Название бренда:</label> 
			<input id="a_up_br_name" type="text" name="admin_update_brand_name" value="<?php				 			 
					if (isset($_POST['admin_update_brand_name']) && !empty($_POST['admin_update_brand_name'])) {
					echo $_POST['admin_update_brand_name'];
				    }elseif (!isset($_POST['admin_update_brand_name']) || empty($_POST['admin_update_brand_name'])) { 
					         echo $brand[0]['name'];
				            }							 
					?>" class="admin_update_brand_form_input">
		</div>
		<div class="admin_update_brand_error">Введите правильное название бренда!</div>

		<input type="hidden" name="admin_update_brand_submit">
 		<button type="submit" class="admin_update_brand_form_btn">Сохранить изменения</button> 	
 	</form>	

	 
 	<?php if (isset($error) && !empty($error)) :
				foreach ($error as $key => $value) :?>
			 <p class="registration_error error_admin_update_brand"><?= $value ?></p>
			<?php endforeach;
			      endif; ?>

	<?php if (isset($success) && empty($error)) : ?>
		<p class="admin_insert_brand_success success_admin_update_brand"><?= $success ?></p>
	<?php endif ?>
	 

	 
	 
	 
	</div> <!-- admin_rigt -->											
	</div> <!-- admin_container -->			
	</div> <!-- content -->
	</div> <!-- wrap_admin -->

</main>


<?php require_once ROOT . "/views/footer/footer.php";  ?> 