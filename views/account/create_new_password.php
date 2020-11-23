<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/public/css/reset.css"> 
    <link rel="stylesheet" href="/public/css/create_new_password.css">     
	<link rel="stylesheet" href="/public/css/font.css">
	<title>Shoptest - интернет-магазин кроссовок и кед от мировых производителей по доступным ценам в Украине</title>
</head>
<body>
	<div class="wrap_new_pass">
		<div class="container_new_pass">	
		<?php if (!isset($error_messages)||!in_array('Пароль успешно изменен!', $error_messages)) : ?>		 
			<h3 class="new_pass_title">Создайте новый пароль</h3>	
			<form action="" method="POST" novalidate>
				<div class="row">
					<label class="new_pass_label">Пароль:</label> 
					<input type="password" name="new_pass" class="new_pass_input">
				</div>
				<div class="row">
					<label class="new_pass_label">Подтвердите пароль:</label> 
					<input type="password" name="new_pass_confirmation" class="new_pass_input">
				</div>					 
				<div class="row">
					<button type="submit" class="new_pass_btn" name="new_pass_submit" value="<?= $userHash['id'] ?>">Отправить</button>
				</div>				
			</form>	
			<?php else: ?>
				<p><a href="/login" class="new_pass_link">Войти</a></p>
				<p><a href="/exam" class="new_pass_link">В магазин</a></p>
		<?php endif ?>
			<?php if (isset($error_messages) && !empty($error_messages)) :
				foreach ($error_messages as $key => $value) :?>
			 <p class="new_pass_error"><?= $value ?></p>
			<?php endforeach;
			      endif; ?>		
		</div>  
	</div>  
<script src="/public/js/jq.js"></script>  
<script src="/public/js/ajax.js"></script>
 
</body>
</html>