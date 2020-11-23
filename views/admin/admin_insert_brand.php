<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt">	 
	<h3 class="admin_insert_brand_title">Добавление нового бренда</h3>

	<form action="" method="POST" class="admin_insert_brand_form">
		 
		<div class="admin_insert_brand_form_row">
					<label for="" class="admin_insert_brand_form_label">Название бренда:</label> 
					<input id="a_ins_brand" type="text" name="adm_ins_brand_name"
					value="<?php if(isset($_POST['adm_ins_brand_name']) && !empty($_POST['adm_ins_brand_name']))
					echo $_POST['adm_ins_brand_name'];
					 ?>"class="admin_insert_brand_form_input">
		</div>
		<div class="admin_insert_brand_error">Введите название бренда!</div>
		 <input type="hidden" name="admin_insert_brand_submit">
 		<button type="submit" class="admin_insert_brand_form_btn">Добавить бренд</button> 	
 	</form>	
 	<?php if (isset($error) && !empty($error)) :
				foreach ($error as $key => $value) :?>
			 <p class="registration_error"><?= $value ?></p>
			<?php endforeach;
			      endif; ?>

	<?php if (isset($success) && empty($error)) : ?>
		<p class="admin_insert_brand_success"><?= $success ?></p>
	<?php endif ?>	 
	 
	</div> <!-- admin_rigt -->											
	</div> <!-- admin_container -->			
	</div> <!-- content -->
	</div> <!-- wrap_admin -->

</main>


<?php require_once ROOT . "/views/footer/footer.php";  ?> 