<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/public/css/reset.css"> 
    <link rel="stylesheet" href="/public/css/entrance.css">
    <link rel="stylesheet" href="/public/css/entrance_media.css">	 
	<link rel="stylesheet" href="/public/css/font.css">
	<title>Shoptest - интернет-магазин кроссовок и кед от мировых производителей по доступным ценам в Украине</title>
</head>
<body>
	<div class="wrap_entrance">
		<div class="container_entrance">

			<div class="entrance_left">
			<h3 class="entrance_title">У меня уже есть аккаунт</h3>	
			<form action="/entrance" method="POST" novalidate>
				<div class="row">
					<label class="entrance_label">E-mail</label> 
					<input type="email" name="entrance_email" class="entrance_input" value="<?= getArrVal($_POST, 'entrance_email');?>">
				</div>
				<div class="row">
					<label class="entrance_label">Пароль</label> 
					<input type="password" name="entrance_password" class="entrance_input" value="<?= getArrVal($_POST, 'entrance_password');?>">
				</div>
				<div class="row">
					<button type="submit" class="entrance_btn" name="entrance_submit">Войти</button>
				</div>				
			</form>
			<?php if (isset($error_messages) && !empty($error_messages)) :
				foreach ($error_messages as $key => $value) :?>
			 <p class="entrance_error"><?= $value ?></p>
			<?php endforeach;
			      endif; ?>
			<div class="row">
				<a href="/recovery" class="entrance_link">Забыли пароль?</a>
			</div>
			</div> <!-- entranse_left -->

			<div class="entrance_rigt">
			<h3 class="entrance_title">Регистрация</h3>	
			<div class="entrance_rigt_info">
				<p>Создайте аккаунт чтобы быстрее оформлять заказы и отслеживать их в личном кабинете</p>
			</div>
			<div class="row">
				<a href="/registration" class="entrance_rigt_link">Создать аккаунт</a>
			</div>
			</div> <!-- entranse_rigt -->
			
		</div> <!-- container_entrance -->		
	</div> <!-- wrap_entrance -->

<script src="/public/js/jq.js"></script>  
<script src="/public/js/ajax.js"></script> 
 
</body>
</html>