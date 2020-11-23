<?php require_once ROOT . "/views/header/header.php";  ?> 
<main>
<div class="wrap_news">
	<div class="content_news">
	<?php if (isset($news) && !empty($news)): ?>
<?php foreach ($news as $key => $unit) : ?>
		<article class="news_unit">
			<h1 class="news_unit_title">
				<a href="/news/one/<?= $unit['id'] ?>" target="_blank" class="news_unit_title_link"><?= $unit['title'] ?></a>
			</h1>
			<p class="news_unit_data"><?= $unit['date'] ?></p>
			<p class="news_unit_subtitle"><?= $unit['subtitle'] ?></p>
			<div class="news_unit_img_first">
				<img src="/public/img_news/<?= $unit['img_first'] ?>" alt="<?= $unit['title'] ?>" >
			</div>
			<div><a href="/news/one/<?= $unit['id'] ?>" target="_blank" class="news_unit_link_details">Детальнее >></a></div>
			
		</article> <!-- news_unit -->
<?php endforeach ?>
<?php else: ?>
	<p>Новостей нет!</p>
<?php endif ?>
		 
		 
	</div> <!-- content_news --> 
</div> <!-- wrap_product -->



 
</main>
 
<?php require_once ROOT . "/views/footer/footer.php";  ?>