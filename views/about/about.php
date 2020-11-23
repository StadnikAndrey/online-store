<?php require_once ROOT . "/views/header/header.php";  ?> 
<main>
	<div class="wrap_about_img">
		<img src="/public/img_info/<?= $info['img'] ?>" alt="Информация об интернет-магазине кроссовок Shoptest" class="about_img">		
	</div> <!-- wrap_about_img -->

	<div class="wrap_about_content">
		<div class="content">
		<h1 class="about_title">О компании</h1>
		<div class="about_content_body"><?= $info['text'] ?></div>	
		</div> <!-- content -->
	</div> <!-- wrap_about_content -->

</main>
<?php require_once ROOT . "/views/footer/footer.php";  ?> 
 