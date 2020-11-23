<?php require_once ROOT . "/views/header/header.php";  ?>
 <main>
 	<div class="wrap_cabinet">
	<div class="content">
		<div class="cabinet_container">
		<?php if (isset($_SESSION['user'])): ?>	
			<?php require_once ROOT . "/views/cabinet_menu/index.php";  ?>
			 
			<div class="cabinet_rigt">
	<h1 class="cabinet_rigt_title">Ваши персональные данные</h1>
<div class="cabinet_profile">
	<p class="cabinet_profile_editing"><span class="cabinet_profile_editing_in">Редактировать данные</span></p>
	<div class="cabinet_profile_editing_wrap <?= !empty($error)?'cabinet_profile_form_active':'' ?>">

			<form action="" method="POST" novalidate class="cabinet_profile_editing_form">
				  <div class="cabinet_profile_form_row">
					<label for="" class="cabinet_profile_form_label">Фамилия:</label> 
					<input id="p_edit_surname" type="text" name="pr_ed_surname" 
					value="<?= empty($error)?$user['surname']:getArrVal($_POST, 'pr_ed_surname')
					 ?>" 
					 class="cabinet_profile_form_input">
				</div>
				<div class="prof_edit_error">Введите фамилию кирилицей!</div>
				<div class="cabinet_profile_form_row" data-er="ошибка">
					<label for="" class="cabinet_profile_form_label">Имя:</label> 
					<input id="p_edit_name" type="text" name="pr_ed_name"
					 value="<?= empty($error)?$user['name']:getArrVal($_POST, 'pr_ed_name') ?>" class="cabinet_profile_form_input">
				</div>
				<div class="prof_edit_error">Введите имя кирилицей!</div>
				<div class="cabinet_profile_form_row">
					<label for="" class="cabinet_profile_form_label">Отчество:</label> 
					<input id="p_edit_patronymic" type="text" name="pr_ed_patronymic" 
					value="<?= empty($error)?$user['patronymic']:getArrVal($_POST, 'pr_ed_patronymic') ?>" class="cabinet_profile_form_input">
				</div>
				<div class="prof_edit_error">Введите отчество кирилицей!</div>	 
				 <div class="cabinet_profile_form_row">
					<label for="" class="cabinet_profile_form_label">Пол:</label>
					<select name="pr_ed_gender"   class="cabinet_profile_form_select">						 
						<option value="мужчина"
						<?php if (empty($error)) {
							if ($user['gender']=='мужчина') {
								echo 'selected';
							}
						}elseif ($_POST['pr_ed_gender']=='мужчина') {
								echo 'selected';
							}
						?>						 				 
						 >Мужчина</option>
						<option value="женщина" 
						<?php if (empty($error)) {
							if ($user['gender']=='женщина') {
								echo 'selected';
							}
						}elseif ($_POST['pr_ed_gender']=='женщина') {
								echo 'selected';
							}
						 ?> 
						>Женщина</option>
					</select>					
				</div>
				<div class="cabinet_profile_form_cols">
					<label for="" class="cabinet_profile_form_label">Дата рождения:</label>
					<div class="cabinet_profile_form_wrap_col">
						<div class="cabinet_profile_form_col">
							<div class="cabinet_profile_form_row">						 
							<select name="pr_ed_day"   class="cabinet_profile_form_select">								 
								<?php for ($i=1; $i <=31 ; $i++) : ?>
									<option value="<?= $i<10 ?  '0'.$i :   $i ?>"									 
								<?php if (empty($error)) {
									if (substr($user['date_of_birth'], 8 ,9)==$i) {
										echo 'selected';
									}
									}elseif ($_POST['pr_ed_day']==$i) {
										echo 'selected';
									}
								?> 	 
										><?= $i<10 ?  '0'.$i :   $i ?></option>
									}
								<?php endfor ?>
							</select>					
							</div>
						</div>
						<div class="cabinet_profile_form_col">
							<div class="cabinet_profile_form_row">						 
							<select name="pr_ed_month"   class="cabinet_profile_form_select">								 
						<option value="01"
						<?php if (empty($error)) {
									if (substr($user['date_of_birth'], 5 ,6)==1) {
										echo 'selected';
									}
									}elseif ($_POST['pr_ed_month']==1) {
										echo 'selected';
									}
								?> 	
						>Январь</option>
						<option value="02"
						<?php if (empty($error)) {
									if (substr($user['date_of_birth'], 5 ,6)==2) {
										echo 'selected';
									}
									}elseif ($_POST['pr_ed_month']==2) {
										echo 'selected';
									}
								?> 	
						 >Фефраль</option>
						<option value="03"
						<?php if (empty($error)) {
									if (substr($user['date_of_birth'], 5 ,6)==3) {
										echo 'selected';
									}
									}elseif ($_POST['pr_ed_month']==3) {
										echo 'selected';
									}
								?> 	
						 >Март</option>
						<option value="04"
						<?php if (empty($error)) {
									if (substr($user['date_of_birth'], 5 ,6)==4) {
										echo 'selected';
									}
									}elseif ($_POST['pr_ed_month']==4) {
										echo 'selected';
									}
								?> 	
						  >Апрель</option>
						<option value="05"
						<?php if (empty($error)) {
									if (substr($user['date_of_birth'], 5 ,6)==5) {
										echo 'selected';
									}
									}elseif ($_POST['pr_ed_month']==5) {
										echo 'selected';
									}
								?> 	
						  >Май</option>
						<option value="06"
						<?php if (empty($error)) {
									if (substr($user['date_of_birth'], 5 ,6)==6) {
										echo 'selected';
									}
									}elseif ($_POST['pr_ed_month']==6) {
										echo 'selected';
									}
								?> 	
						  >Июнь</option>
						<option value="07"
						<?php if (empty($error)) {
									if (substr($user['date_of_birth'], 5 ,6)==7) {
										echo 'selected';
									}
									}elseif ($_POST['pr_ed_month']==7) {
										echo 'selected';
									}
								?> 	
						  >Июль</option>
						<option value="08"
						<?php if (empty($error)) {
									if (substr($user['date_of_birth'], 5 ,6)==8) {
										echo 'selected';
									}
									}elseif ($_POST['pr_ed_month']==8) {
										echo 'selected';
									}
								?> 	
						 >Август</option>
						<option value="09"
						<?php if (empty($error)) {
									if (substr($user['date_of_birth'], 5 ,6)==9) {
										echo 'selected';
									}
									}elseif ($_POST['pr_ed_month']==9) {
										echo 'selected';
									}
								?> 	
						 >Сентябрь</option>
						<option value="10"
						<?php if (empty($error)) {
									if (substr($user['date_of_birth'], 5 ,6)==10) {
										echo 'selected';
									}
									}elseif ($_POST['pr_ed_month']==10) {
										echo 'selected';
									}
								?> 	
						  >Октябрь</option>
						<option value="11"
						<?php if (empty($error)) {
									if (substr($user['date_of_birth'], 5 ,6)==11) {
										echo 'selected';
									}
									}elseif ($_POST['pr_ed_month']==11) {
										echo 'selected';
									}
								?> 	
						 >Ноябрь</option>
						<option value="12"
						<?php if (empty($error)) {
									if (substr($user['date_of_birth'], 5 ,6)==12) {
										echo 'selected';
									}
									}elseif ($_POST['pr_ed_month']==12) {
										echo 'selected';
									}
								?> 	
						  >Декабрь</option>

							</select>					
							</div>
						</div>
						<div class="cabinet_profile_form_col">
							<div class="cabinet_profile_form_row">						 
							<select name="pr_ed_year"  class="cabinet_profile_form_select">						 
								<?php for ($i=2004; $i >= 1950 ; $i--) : ?>
								<option value="<?= $i ?>" 
								<?php if (empty($error)) {
									if (substr($user['date_of_birth'], 0 ,4)==$i) {
										echo 'selected';
									}
									}elseif ($_POST['pr_ed_year']==$i) {
										echo 'selected';
									}
								?> 	 
									 ><?= $i ?></option> 
								<?php endfor ?>	
							</select>					
							</div>
						</div>
					</div>
				</div>  	 
				<div class="cabinet_profile_form_row">
					<label for="" class="cabinet_profile_form_label">Номер мобильного телефона:</label> 
					<input id="p_edit_mob_num" type="text" name="pr_ed_mobile_number"					 
					 value="<?= empty($error)?$user['mobile_number']:getArrVal($_POST, 'pr_ed_mobile_number') ?>" class="cabinet_profile_form_input">
				</div>
				<div class="prof_edit_error">Введите правильный номер мобильного телефона!</div>	
				<div class="cabinet_profile_form_row">
					<label for="" class="cabinet_profile_form_label">E-mail:</label> 
					<input id="p_edit_email" type="email" name="pr_ed_email"					 
					value="<?= empty($error)?$user['email']:getArrVal($_POST, 'pr_ed_email') ?>" class="cabinet_profile_form_input">
				</div>	
				<div class="prof_edit_error">Введите правильный e-mail!</div>			 
				<div class="cabinet_profile_form_row">
				<input type="hidden" name="btn_cabinet_profile_editing">			 
				<button type="submit" class="cabinet_profile_form_btn_submit btn_prof_edit" disabled>Сохранить изменения</button>
			    </div> 
			</form>

			<?php if (isset($error) && !empty($error)) :
				foreach ($error as $key => $value) :?>
			 <p class="cabinet_profile_editing_error"><?= $value ?></p>
			<?php endforeach;
			      endif; ?>
			 
			</div> <!-- cabinet_profile_editing_wrap -->



  	 <div class="cabinet_profile_inform <?= !empty($error)?'cabinet_profile_form_none':'' ?>">
  	 	<div class="cabinet_profile_inform_row">
  	 		<div class="cabinet_profile_row_title">Фамилия</div>
  	 		<div class="cabinet_profile_row_data"><?= $user['surname'] ?></div>
  	 	</div>
  	 	<div class="cabinet_profile_inform_row">
  	 		<div class="cabinet_profile_row_title">имя</div>
  	 		<div class="cabinet_profile_row_data"><?= $user['name'] ?></div>
  	 	</div>
  	 	<div class="cabinet_profile_inform_row">
  	 		<div class="cabinet_profile_row_title">Отчество</div>
  	 		<div class="cabinet_profile_row_data"><?= $user['patronymic'] ?></div>
  	 	</div>
  	 	<div class="cabinet_profile_inform_row">
  	 		<div class="cabinet_profile_row_title">День рождения</div>
  	 		<div class="cabinet_profile_row_data"><?= $user['date_of_birth'] ?></div>
  	 	</div>
  	 	<div class="cabinet_profile_inform_row">
  	 		<div class="cabinet_profile_row_title">Телефон</div>
  	 		<div class="cabinet_profile_row_data"><?= $user['mobile_number'] ?></div>
  	 	</div>
  	 	<div class="cabinet_profile_inform_row">
  	 		<div class="cabinet_profile_row_title">E-mail</div>
  	 		<div class="cabinet_profile_row_data"><?= $user['email'] ?></div>
  	 	</div>

  	 	<p class="cabinet_profile_change_pass_title">Изменить пароль</p>
  	 	<form action="" method="POST" class="cabinet_profile_change_pass_form <?= !empty($error_ch_pass)?'cabinet_profile_form_active':'' ?>" novalidate>
				<div class="cabinet_profile_form_row" data-er="ошибка">
					<label for="" class="cabinet_profile_form_label">Старый пароль:</label> 
					<input id="p_ch_old_pass" type="password" name="pr_ch_old_pass" class="cabinet_profile_form_input">
				</div>
				<div class="prof_edit_error">Введите свой старый пароль!</div>
				<div class="cabinet_profile_form_row">
					<label for="" class="cabinet_profile_form_label">Новый пароль:</label> 
					<input id="p_ch_new_pass" type="password" name="pr_ch_new_pass" class="cabinet_profile_form_input">
				</div>
				<div class="prof_edit_error">Введите пароль от 5 до 20 символов!</div>
				<div class="cabinet_profile_form_row">
					<label for="" class="cabinet_profile_form_label">Повторите новый пароль:</label> 
					<input id="p_ch_new_pass_confirm" type="password" name="pr_ch_new_pass_confirm" class="cabinet_profile_form_input">
				</div>
				<div class="prof_edit_error">Новый пароль и повторный ввод нового пароля не совпадают!</div>
				<div class="cabinet_profile_form_label">ПАРОЛЬ ДОЛЖЕН СОДЕРЖАТЬ БОЛЕЕ 5 СИМВОЛОВ</div>
				<input type="hidden" name="hidden_cabinet_profile_change_pass">	
				<button type="submit" class="cabinet_profile_form_btn_submit btn_prof_ch_pass" disabled>Изменить пароль</button>
			</form>
			<?php if (isset($error_ch_pass) && !empty($error_ch_pass)) :
				foreach ($error_ch_pass as $key => $value) :?>
			 <p class="cabinet_profile_change_pass_error"><?= $value ?></p>
			<?php endforeach;
			      endif; ?>
  	 	
  	 </div> <!-- cabinet_profile_inform -->
</div> <!-- cabinet_profile -->		 

		</div> <!-- cabinet_rigt -->
		<?php else: ?>	
			<p>Вы не авторизированы</p>
		<?php endif ?>
		</div> <!-- cabinet_container -->
		
	</div> <!-- content -->
</div> <!-- wrap_cabinet -->
 </main>
<?php require_once ROOT . "/views/footer/footer.php";  ?>