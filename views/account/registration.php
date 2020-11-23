<?php require_once ROOT . "/views/header/header.php";  ?> 

	<main>
	<div class="wrap_registration">
		<div class="content">
			<h3 class="registration_title">Зарегистрироваться</h3>	
			<div class="registration_wrap_form">			 
			<form action="/registration" method="POST" novalidate class="registration_form">
				<div class="registration_row">
					<label class="registration_label">Имя:</label> 
					<input type="text" id="r_name" name="name" class="registration_input" value="<?= getArrVal($_POST, 'name');?>">
				</div>
				<div class="reg_error_name">Введите имя кириллицей!</div>
				<div class="registration_row">
					<label class="registration_label">Отчество:</label> 
					<input type="text" id="r_patronymic" name="patronymic" class="registration_input" value="<?= getArrVal($_POST, 'patronymic');?>">
				</div>
				<div class="reg_error_patronymic">Введите отчество кириллицей!</div>
				<div class="registration_row">
					<label class="registration_label">Фамилия:</label> 
					<input type="text" id="r_surname" name="surname" class="registration_input" value="<?= getArrVal($_POST, 'surname');?>">
				</div>
				<div class="reg_error_surname">Введите фамилию кириллицей!</div>
				<div class="registration_row">
					<label class="registration_label">Пол:</label>
					<select name="gender" class="registration_select">
						<option value selected>Пол</option>
						<option value="мужчина">Мужчина</option>
						<option value="женщина">Женщина</option>
					</select>					
				</div>
				<div class="registration_cols">
					<label class="registration_label">День рождения:</label>
					<div class="registration_wrap_col">
						<div class="registration_col">
							<div class="registration_row">						 
							<select name="day" class="registration_select">
								<option value selected>День</option>								 
								<?php for ($i=1; $i <=31 ; $i++) : ?>
									<option value="<?= $i<10 ?  '0'.$i :   $i ?>"><?= $i<10 ?  '0'.$i :   $i ?></option>
									}
								<?php endfor ?>
							</select>					
							</div>
						</div>
						<div class="registration_col">
							<div class="registration_row">						 
							<select name="month" class="registration_select">
								<option value selected>Месяц</option>
								<option value="01">Январь</option>
								<option value="02">Фефраль</option>
								<option value="03">Март</option>
								<option value="04">Апрель</option>
								<option value="05">Май</option>
								<option value="06">Июнь</option>
								<option value="07">Июль</option>
								<option value="08">Август</option>
								<option value="09">Сентябрь</option>
								<option value="10">Октябрь</option>
								<option value="11">Ноябрь</option>
								<option value="12">Декабрь</option>
							</select>					
							</div>
						</div>
						<div class="registration_col">
							<div class="registration_row">						 
							<select name="year" class="registration_select">
								<option value selected>Год</option>
								<?php for ($i=2004; $i >= 1950 ; $i--) : ?>
									<option value="<?= $i ?>"><?= $i ?></option>									 
								<?php endfor ?>								 
							</select>					
							</div>
						</div>
					</div>
				</div> <!-- registration_cols -->	
				<div class="registration_row">
					<label class="registration_label">Номер мобильного телефона:</label> 
					<input type="text" id="r_mob_num" name="mobile_number" class="registration_input" value="<?= getArrVal($_POST, 'mobile_number');?>">
				</div>	
				<div class="reg_error_mobile_number">Введите правильный номер мобильного телефона!</div>
				<div class="registration_row">
					<label class="registration_label">E-mail:</label> 
					<input type="email" id="r_email" name="email" class="registration_input" value="<?= getArrVal($_POST, 'email');?>">
				</div>
				<div class="reg_error_email">Введите правильный e-mail!</div>
				<div class="registration_row">
					<label class="registration_label">Пароль:</label> 
					<input type="password" id="r_pass" name="password" class="registration_input">
				</div>
				<div class="reg_error_pass">Пароль должен содержать больше 6 символов!</div>
				<div class="registration_row">
					<label class="registration_label">Подтвердите пароль:</label> 
					<input type="password" id="r_pass_confirm" name="password_confirmation" class="registration_input">
				</div>
				<div class="reg_error_pass_confirm">Пароль и подтверждение пароля не совпадают!</div>
				<div class="registration_label">ПАРОЛЬ ДОЛЖЕН СОДЕРЖАТЬ БОЛЕЕ 6 СИМВОЛОВ</div>
				<input type="hidden" name="registration_submit">
				<div class="registration_row">			 
		           <a href="/safety" target="_blank" class="checkout_agreement_link">Регистрируясь на сайте я согласен (на) с условиями</a>	           
				<button type="submit" class="registration_btn_submit">Создать аккаунт</button>
			    </div>
			</form>
			<?php if (isset($error) && !empty($error)) :
				foreach ($error as $key => $value) :?>
			 <p class="registration_error"><?= $value ?></p>
			<?php endforeach;
			      endif; ?>
			</div> <!-- registration_wrap_form -->

			 
			
		</div> <!-- content -->		
	</div> <!-- wrap_registration -->
</main>

<?php require_once ROOT . "/views/footer/footer.php";  ?> 