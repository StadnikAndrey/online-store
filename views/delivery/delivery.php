<?php require_once ROOT . "/views/header/header.php";  ?> 
<main>
<div class="wrap_about_img">
		<img src="/public/img_info/<?= $info['img'] ?>" alt="Условия доставки интернет-магазина Shoptest" class="about_img">		
	</div> <!-- wrap_about_img -->

	<div class="wrap_about_content">
		<div class="content">
		<h1 class="about_title">Доставка и оплата</h1>
		<div class="delivery_content_body"><?= $info['text'] ?></div>	 
		</div> <!-- content -->
	</div> <!-- wrap_about_content -->	
	 

</main>
<?php require_once ROOT . "/views/footer/footer.php";  ?> 
 