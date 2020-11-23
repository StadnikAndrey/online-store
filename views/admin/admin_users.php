<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
<div class="admin_rigt">	 
	<p class="adm_users_search_title">Найти пользователя:</p> 

    <form action="" id="adm_users_form_search" method="POST" class="admin_users_form">
		<div class="admin_users_form_row adm_users_f_r">
			<label for="" class="admin_users_form_label">Введите поисковый запрос:</label> 
			<input id="" type="search" name="adm_users_search" value="<?= 
			 isset($_POST['adm_users_search'])?$_POST['adm_users_search']:''
			?>" class="admin_users_form_input" placeholder="поиск">
		</div>
		<input type="hidden" name="admin_users_form_submit">
		<button type="submit" class="admin_users_form_btn">Найти</button> 
    </form>
<!-- если пользователь главный админ -->
<?php if (isset($_SESSION['user']) && $_SESSION['user']['super_admin'] == 1 && $_SESSION['user']['is_ban'] == 0): ?>
<p><a href="/admin/users/all/admins" class="all_admins">Администраторы сайта</a></p>
<?php endif ?>

<?php if (isset($users) && !empty($users)) : ?>
<?php foreach ($users as $key => $user) : ?>

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
		 
		<p><a href="/admin/user/oders/<?= $user['id'] ?>" class="adm_user_orders" target="_blank">Заказы</a></p>
		 
		 
		</div> <!-- admin_one_user_info_left -->

<!-- если пользователь главный админ -->
<?php if (isset($_SESSION['user']) && $_SESSION['user']['super_admin'] == 1 && $_SESSION['user']['is_ban'] == 0): ?>
<div class="admin_one_user_info_rigt">

<form action="" id="<?= $user['id'] . '_f'?>" method="POST" class="admin_user_form_up">

<div class="admin_user_form_up_row">
<label for="" class="admin_user_form_up_label">Заблокирован:</label>
<select name="adm_us_up_ban" id="" class="admin_user_form_up_select">
	<option value="0" <?= $user['is_ban']==0?'selected':'' ?>>Нет</option>
	<option value="1" <?= $user['is_ban']==1?'selected':'' ?>>Да</option>	 
</select>					
</div>

<div class="admin_user_form_up_row">
<label for="" class="admin_user_form_up_label">Администратор:</label>
<select name="adm_us_up_adm" id="" class="admin_user_form_up_select">
	<option value="0" <?= $user['admin']==0?'selected':'' ?>>Нет</option>
	<option value="1" <?= $user['admin']==1?'selected':'' ?>>Да</option>	 
</select>					
</div>

<div class="admin_user_form_up_row">
<label for="" class="admin_user_form_up_label">Главный администратор:</label>
<select name="adm_us_up_super" id="" class="admin_user_form_up_select">
	<option value="0" <?= $user['super_admin']==0?'selected':'' ?>>Нет</option>
	<option value="1" <?= $user['super_admin']==1?'selected':'' ?>>Да</option>	 
</select>					
</div>

<div class="admin_user_form_up_row">
<label for="" class="admin_user_form_up_label">Комментарий:</label>	 
<textarea name="adm_user_com_admin" id="" class="admin_user_form_up_input"><?= $user['comment_admin'] ?></textarea>
</div>

  <input type="hidden" name="admin_user_form_up_submit" value="<?= $user['id'] ?>"> 
<button type="button" class="admin_user_form_up_btn" id="<?= $user['id'] ?>">Сохранить</button> 
</form>

<p class="<?= $user['id'] .'_p' ?> adm_us_up_p <?php 
	if(isset($user['data_update']) && !empty(trim($user['data_update'])) && !empty(trim($user['id_admin_update']))){
		echo 'active';
	}
 ?>"><a href="/admin/one/<?= $user['id_admin_update'] ?>" target="_blank" class="<?= $user['id'] .'_a' ?> adm_user_up_a">изменен <span class="<?= $user['id'] .'_sp' ?>"><?= $user['data_update'] ?></span></a></p>

			
</div> <!-- admin_one_user_info_rigt -->	
<?php endif ?>	

</div> <!-- admin_one_user_info -->
				 
	 	 
</div> <!-- admin_one_user -->
<?php endforeach ?>	
<!-- постраничная навигация -->
<ul class="products_pagination"> 
<!-- prev start -->
<li><label for="prev" class="products_pagination_label products_pagination_prev
	<?php if($_POST['page'][0]==1||empty($_POST['page'][0])): ?>
		products_pagination_none
	<?php endif ?>
	">
<input form="adm_users_form_search" class="products_pagination_input" id="prev" value=" <?= $prev ?>  " name="page[]" type="radio"></label>
</li> 
<!-- prev end -->
 
<!-- кнопки для постраничной навигации основные  START-->
<!-- left -->
<?php for ($i=2; $i < 0 ; $i--) :?>
<?php if (($page-$i)>0): ?>
<li class=" 
 <?php if($countPage==0): ?>
  products_pagination_none
<?php endif ?> 
"><label for="<?= $page-$i ?>" class="products_pagination_label
<?php if(isset($_POST['page'])&&in_array( $page-$i, $_POST['page'])||$page-$i==1&&empty($_POST['page'])){
		   					echo 'products_pagination_label_activ';} ?>">
<input form="adm_users_form_search" class="products_pagination_input" id="<?= $page-$i ?>" value="<?= $page-$i ?>" name="page[]" type="radio"><?= $page-$i ?></label></li>	
<?php endif ?>	 
<?php endfor ?>  
 <!-- активная ссылка старт -->
<li class=" 
 <?php if($countPage==0): ?>
  products_pagination_none
<?php endif ?> 
"><label for="<?= $page ?>" class="products_pagination_label products_pagination_label_activ">
<input form="adm_users_form_search" class="products_pagination_input" id="<?= $page ?>" value="<?= $page ?>" name="page[]" type="radio"><?= $page ?></label></li>
<!-- активная ссылка стоп -->
 
<!-- right --> 
<?php for ($i=1; $i < 3 ; $i++) :?>
<?php if (($page+$i)<=$countPage): ?>
<li class=" 
 <?php if($countPage==0): ?>
  products_pagination_none
<?php endif ?> 
"><label for="<?= $page+$i ?>" class="products_pagination_label
<?php if(isset($_POST['page'])&&in_array( $page+$i, $_POST['page'])||$page+$i==1&&empty($_POST['page'])){
		   					echo 'products_pagination_label_activ';} ?>">
<input form="adm_users_form_search" class="products_pagination_input" id="<?= $page+$i ?>" value="<?= $page+$i ?>" name="page[]" type="radio"><?= $page+$i ?></label></li>	
 <?php endif ?>	 
 <?php endfor ?>  
<!-- кнопки для постраничной навигации основные END--> 

<!--многоточие и последняя страница   (цифра-это количество li с одной стороны)-->
<?php if (($page+2) < $countPage): ?> 
<li class="products_pagination_label 
<?php if($page==$countPage-3): ?>
  products_pagination_none
<?php endif ?> " 
>...</li>					 
<li><label for="<?= $countPage ?>" class="products_pagination_label
<?php if(isset($_POST['page'])&&in_array( $countPage, $_POST['page'])||$i==1&&empty($_POST['page'])){
				  echo 'products_pagination_label_activ';} ?>">
<input form="adm_users_form_search" class="products_pagination_input" id="<?= $countPage ?>" value="<?= $countPage ?>" name="page[]" type="radio"><?= $countPage ?></label>
</li> 
<?php endif ?>					  
     
<!-- next start -->
<li><label for="next" class="products_pagination_label products_pagination_next
	<?php if($page==$countPage || $countPage==0 ): ?>
		products_pagination_none
	<?php endif ?>  
	">
<input form="adm_users_form_search" class="products_pagination_input" id="next" value="<?= $next ?>" name="page[]" type="radio"></label>
</li> 
<!-- next end -->
</ul> <!-- products_pagination -->
<?php else: ?>
	<p>Не найдено</p>
<?php endif ?>
	 
	 
	 
	</div> <!-- admin_rigt -->											
	</div> <!-- admin_container -->			
	</div> <!-- content -->
	</div> <!-- wrap_admin -->

</main>


<?php require_once ROOT . "/views/footer/footer.php";  ?> 