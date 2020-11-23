<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt">	 
	 <h3 class="admin_insert_subcat_title">Добавление субкатегории</h3>
	<form action="" method="POST" class="admin_insert_subcat_form">
		 
		<div class="admin_insert_subcat_form_row">
					<label for="" class="admin_insert_subcat_form_label">Название субкатегории:</label> 
					<input id="a_i_subcat_name" type="text" name="adm_ins_subcat_name"
					value="<?php if(isset($_POST['adm_ins_subcat_name']) && !empty($_POST['adm_ins_subcat_name']))
					echo $_POST['adm_ins_subcat_name'];
					 ?>" class="admin_insert_subcat_form_input">
		</div>
		<div class="admin_insert_subcat_error">Введите название субкатегории!</div>

		<input type="hidden" name="admin_insert_subcat_submit">
 		<button type="submit" class="admin_insert_subcat_form_btn">Добавить субкатегорию</button> 	
 	</form>	
 	<?php if (isset($error) && !empty($error)) :
				foreach ($error as $key => $value) :?>
			 <p class="registration_error adm_ins_subcat_error"><?= $value ?></p>
			<?php endforeach;
			      endif; ?>

	<?php if (isset($success) && empty($error)) : ?>
		<p class="admin_insert_brand_success adm_ins_subcat_success"><?= $success ?></p>
	<?php endif ?> 

	</div> <!-- admin_rigt -->											
	</div> <!-- admin_container -->			
	</div> <!-- content -->
	</div> <!-- wrap_admin -->

</main>


<?php require_once ROOT . "/views/footer/footer.php";  ?> 