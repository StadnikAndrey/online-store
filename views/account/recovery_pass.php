<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/public/css/reset.css"> 
    <link rel="stylesheet" href="/public/css/recovery_pass.css">     
	<link rel="stylesheet" href="/public/css/font.css">
	<title>Shoptest - интернет-магазин кроссовок и кед от мировых производителей по доступным ценам в Украине</title>
</head>
<body>
	<div class="wrap_recovery_pass">
		<div class="container_recovery_pass">			 
			<h3 class="recovery_pass_title">Восстановление пароля</h3>
			<?php if (isset($error_messages)&&!in_array('Вам отправлено письмо. Перейдите по ссылке в письме для смены пароля!', $error_messages)) : ?>	
				<form action="/recovery" method="POST" novalidate>
				<div class="row">
					<label  class="recovery_pass_label">E-mail</label> 
					<input type="email" name="recovery_pass_email" class="recovery_pass_input" value="<?= getArrVal($_POST, 'recovery_pass_email');?>">
				</div>				 
				<div class="row">
					<button type="submit" class="recovery_pass_btn" name="recovery_pass_submit">Восстановить</button>
				</div>				
			</form>	
			<?php endif ?>
			 
			<?php if (isset($error_messages) && !empty($error_messages)) :
				foreach ($error_messages as $key => $value) :?>
			 <p class="recovery_pass_error"><?= $value ?></p>
			<?php endforeach;
			      endif; ?>		
		</div> <!-- container_recovery_pass -->		
	</div> <!-- wrap_recovery_pass --> 

	<script src="/public/js/jq.js"></script>  
<script src="/public/js/ajax.js"></script>
 </body>
</html>