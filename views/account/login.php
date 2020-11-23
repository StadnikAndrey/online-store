<?php require_once ROOT . "/views/header/header.php";  ?>

<main>
	<div class="wrap_login">
		<div class="container_login">
		 
			<h3 class="login_title">Вы успешно зарегистированы</h3>
			<p class="login_subtitle">Войдите в личный кабинет используя свою учетную запись</p>	
			<form action="/login" method="POST" novalidate>
				<div class="row">
					<label class="login_label">E-mail</label> 
					<input type="email" name="login_email" class="login_input" value="<?= getArrVal($_POST, 'login_email');?>">
				</div>
				<div class="row">
					<label class="login_label">Пароль</label> 
					<input type="password" name="login_password" class="login_input" value="<?= getArrVal($_POST, 'login_password');?>">
				</div>
				<div class="row">
					<button type="submit" class="login_btn" name="login_submit">Войти</button>
				</div>				
			</form>
			<?php if (isset($error_messages) && !empty($error_messages)) :
				foreach ($error_messages as $key => $value) :?>
			 <p class="login_error"><?= $value ?></p>
			<?php endforeach;
			      endif; ?>
			<div class="row">
				<a href="/recovery" class="login_link">Забыли пароль?</a>
			</div>
			 
			
		</div> <!-- container_login -->		
	</div> <!-- wrap_login -->	 
</main>

<?php require_once ROOT . "/views/footer/footer.php";  ?>