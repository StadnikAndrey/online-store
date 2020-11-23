<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt">
	<h3 class="admin_update_order_status_title">Редактирование статуса заказа 
	<span class="adm_upd_ord_st_tit_name"><?= $oder_status['0']['name'] ?></span> ( id: <?= $oder_status['0']['id'] ?> )</h3>

	<form action="" method="POST" class="admin_update_order_status_form">
		 
		<div class="admin_update_order_status_form_row">
					<label for="" class="admin_update_order_status_form_label">Название статуса заказа:</label> 
					<input id="a_up_o_s_name" type="text" name="adm_up_order_status_name" value="<?php		 			 
					if (isset($_POST['adm_up_order_status_name'])) {
					echo $_POST['adm_up_order_status_name'];
				    }elseif (!isset($_POST['adm_up_order_status_name']) || empty($_POST['adm_up_order_status_name'])) { 
					         echo $oder_status[0]['name'];
				            }							 
					?>" class="admin_update_order_status_form_input">
		</div>
		<div class="admin_update_order_status_error">Введите название статуса!</div>

		 <input type="hidden" name="adm_update_order_status_submit">
 		<button type="submit" class="admin_update_order_status_form_btn">Сохранить изменения</button> 	
 	</form>		 
	  
 	<?php if (isset($error) && !empty($error)) :
				foreach ($error as $key => $value) :?>
			 <p class="registration_error  adm_up_or_st_error"><?= $value ?></p>
			<?php endforeach;
			      endif; ?>

	<?php if (isset($success) && empty($error)) : ?>
		<p class="admin_insert_brand_success  adm_up_or_st_success"><?= $success ?></p>
	<?php endif ?>
	 
	 
	 
	</div> <!-- admin_rigt -->											
	</div> <!-- admin_container -->			
	</div> <!-- content -->
	</div> <!-- wrap_admin -->

</main>


<?php require_once ROOT . "/views/footer/footer.php";  ?> 