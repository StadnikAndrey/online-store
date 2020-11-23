<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt">	 
	 <h3 class="admin_insert_order_status_title">Добавление статуса заказа</h3>

	<form action="" method="POST" class="admin_insert_order_status_form">
		 
		<div class="admin_insert_order_status_form_row">
					<label for="" class="admin_insert_order_status_form_label">Название статуса заказа:</label> 
					<input id="a_i_o_s_name" type="text" name="adm_ins_o_st_name" value="<?php				 			 
					if (isset($_POST['adm_ins_o_st_name']) && !empty($_POST['adm_ins_o_st_name'])) {
					echo $_POST['adm_ins_o_st_name'];
				    } 						 
					?>" class="admin_insert_order_status_form_input">
		</div>
		<div class="admin_insert_order_status_error">Введите название статуса!</div>

		 <input type="hidden" name="adm_insert_order_status_submit">
 		<button type="submit" class="admin_insert_order_status_form_btn">Добавить статус заказа</button> 	
 	</form>	
 	<?php if (isset($error) && !empty($error)) :
				foreach ($error as $key => $value) :?>
			 <p class="registration_error  adm_ins_order_status_error"><?= $value ?></p>
			<?php endforeach;
			      endif; ?>

	<?php if (isset($success) && empty($error)) : ?>
		<p class="admin_insert_brand_success  adm_ins_order_status_success"><?= $success ?></p>
	<?php endif ?>
	 
	 
	 
	</div> <!-- admin_rigt -->											
	</div> <!-- admin_container -->			
	</div> <!-- content -->
	</div> <!-- wrap_admin -->

</main>


<?php require_once ROOT . "/views/footer/footer.php";  ?> 