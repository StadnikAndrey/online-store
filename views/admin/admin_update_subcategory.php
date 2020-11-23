<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt">	 
	<h3 class="admin_update_subcat_title">Редактирование субкатегории
	<span class="admin_update_subcat_title_name"><?= $subcat[0]['name'] ?></span> ( id: <?= $subcat[0]['id'] ?> )</h3>
	<form action="" method="POST" class="admin_update_subcat_form">
		 
		<div class="admin_update_subcat_form_row">
					<label for="" class="admin_update_subcat_form_label">Название субкатегории:</label> 
					<input id="a_u_subcat_name" type="text" name="adm_up_subcat_name"
					value="<?php				 			 
					if (isset($_POST['adm_up_subcat_name']) && !empty($_POST['adm_up_subcat_name'])) {
					echo $_POST['adm_up_subcat_name'];
				    }elseif (!isset($_POST['adm_up_subcat_name']) || empty($_POST['adm_up_subcat_name'])) { 
					         echo $subcat[0]['name'];
				            }							 
					?>" class="admin_update_subcat_form_input">
		</div>
		<div class="admin_update_subcat_error">Введите название субкатегории!</div>
		
		<input type="hidden" name="admin_update_subcat_submit">
 		<button type="submit" class="admin_update_subcat_form_btn">Сохранить изменения</button> 	
 	</form>	
 	<?php if (isset($error) && !empty($error)) :
				foreach ($error as $key => $value) :?>
			 <p class="registration_error adm_up_subcat_error"><?= $value ?></p>
			<?php endforeach;
			      endif; ?>

	<?php if (isset($success) && empty($error)) : ?>
		<p class="admin_insert_brand_success adm_up_subcat_success"><?= $success ?></p>
	<?php endif ?>

  

	</div> <!-- admin_rigt -->											
	</div> <!-- admin_container -->			
	</div> <!-- content -->
	</div> <!-- wrap_admin -->

</main>


<?php require_once ROOT . "/views/footer/footer.php";  ?> 