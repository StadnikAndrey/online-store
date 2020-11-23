  <?php require_once ROOT . "/views/header/header.php";  ?> 
<main>
<div class="wrap_one_news">
	<div class="content_one_news">

		<article class="one_news">
			<h1 class="one_news_title">
				<?= $one_news['title'] ?>
			</h1>
			<p class="one_news_data"><?= $one_news['date'] ?></p>
			<p class="one_news_subtitle"><?= $one_news['subtitle'] ?></p>
			<div class="one_news_img_first">
				<img src="/public/img_news/<?= $one_news['img_first'] ?>" alt="<?= $one_news['title'] ?>" >
			</div>
			<p class="one_news_txt_1"><?= $one_news['txt_one'] ?></p>
			 <?php if (isset($one_news['img_one']) && !empty($one_news['img_one'])) : ?>
			 <?php for ($i=0; $i < count(json_decode($one_news['img_one'])) ; $i++) : ?>
			<div class="one_news_img_1">
				<img src="/public/img_news/<?= json_decode($one_news['img_one'])[$i] ?>" alt="<?= $one_news['title'] ?>" >
			</div>
		<?php endfor  ?>
		    <?php endif ?>

			<p class="one_news_txt_2"><?= $one_news['txt_two'] ?></p>
			<?php if (isset($one_news['img_two']) && !empty($one_news['img_two'])) : ?>
			 <?php for ($i=0; $i < count(json_decode($one_news['img_two'])) ; $i++) : ?>
			<div class="one_news_img_1">
				<img src="/public/img_news/<?= json_decode($one_news['img_two'])[$i] ?>" alt="<?= $one_news['title'] ?>" >
			</div>
		<?php endfor  ?>
		    <?php endif ?>

		 
			 
			<p class="one_news_txt_3"><?= $one_news['txt_three'] ?></p>
			 
			
		</article> <!-- news_unit -->

		 
		 
	</div> <!-- content_one_news --> 
</div> <!-- wrap_one_news -->


 
</main>
 
<?php require_once ROOT . "/views/footer/footer.php";  ?>


 