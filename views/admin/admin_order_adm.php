<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
<div class="admin_rigt">	 
	<p class="adm_users_search_title">Менеджер изменивший статус заказа:</p>  

<?php if (isset($user) && !empty($user)) : ?> 

<div class="admin_one_user">
<p class="admin_one_user_title">id: <span class="admin_one_user_title_num"> <?= $user['id'] ?></span> зарегистрирован
 <?= $user['date_add'] ?></p>

<div class="admin_one_user_info">

		<div class="admin_one_user_info_left">

		<p class="adm_one_user_info_body"><?= $user['surname'] ?> <?= $user['name'] ?> <?= $user['patronymic'] ?></p>
		<p class="adm_one_user_info_body"><?= $user['date_of_birth'] ?></p>
		<p class="adm_one_user_info_body"><?= $user['gender'] ?></p>
		<p class="adm_one_user_info_body"><?= $user['mobile_number'] ?></p>
		<p class="adm_one_user_info_body"><?= $user['email'] ?></p>		 
		 
		</div> <!-- admin_one_user_info_left --> 

</div> <!-- admin_one_user_info --> 			 
	 	 
</div> <!-- admin_one_user -->
 
<?php else: ?>
	<p>Не найдено</p>
<?php endif ?>	 
	 
	</div> <!-- admin_rigt -->											
	</div> <!-- admin_container -->			
	</div> <!-- content -->
	</div> <!-- wrap_admin -->

</main>


<?php require_once ROOT . "/views/footer/footer.php";  ?> 