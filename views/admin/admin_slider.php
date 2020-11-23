<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt">	 
	 <a href="/admin/slider/insert" class="admin_rigt_adding">добавить слайд</a>	 
<?php if (isset($slides) && !empty($slides)) : ?>
<?php foreach ($slides as $key => $slide) : ?>
	<div class="admin_one_slide">
	<div class="adm_one_slide_body">
		 
		<form action="" method="POST" id="<?= $slide['id'] . '_f' ?>" class="adm_slider_form">
		<input type="checkbox" name="adm_slider_visibility" value="1" id="<?= $slide['id'] ?>"  class="adm_sl_check" title="Переключение видимости слайда" <?php 
		 if ($slide['visibility']==1) {
				echo 'checked';
		 } ?>>		 
		<input type="hidden" name="adm_slider_id_slide" value="<?= $slide['id'] ?>">		 
		</form>
				 
		<p class="admin_one_slide_id">id: <?= $slide['id'] ?></p>		
				 
		<a href="/product/<?= $slide['product']['id'] ?>" class="admin_one_slide_product" target="_blank" ><?= $slide['product']['code'] ?></a>			  
		<a href="/admin/slider/update/<?= $slide['id'] ?>" class="admin_one_slide_update" title="Редактировать слайд"><img src="/public/img/admin_update.svg" alt="" class="admin_one_slide_img"></a>
		<a href="/admin/slider/delete/<?= $slide['id'] ?>" class="admin_one_slide_delete" title="Удалить слайд"><img src="/public/img/admin_remove.svg" alt="" class="admin_one_slide_img"></a>	
			 
	</div> <!-- adm_one_slide_body -->

		 
	<div class="adm_one_slide_screen" style="background-image: url(/public/img_slider/<?= $slide['img'] ?>);">

		<div class="adm_one_slide_screen_content">
			<div class="adm_one_slide_screen_brand">
			    <img src="/public/img_slider/<?= $slide['logo'] ?>" alt="<?= $slide['alt_logo'] ?>">	
			</div>
			<p class="adm_one_slide_screen_title"><?= $slide['title'] ?></p>	
			<p class="adm_one_slide_screen_subtitle"><?= $slide['subtitle'] ?></p>		 
		</div> <!-- adm_one_slide_screen_content -->  

	</div>   <!-- adm_one_slide_screen -->        

	</div> <!-- admin_one_slide -->
<?php endforeach ?>
<?php else: ?>
	<p>Вы не загрузили пока ни одного слайда!</p>
<?php endif ?>
	 
	 
	 
	</div> <!-- admin_rigt -->											
	</div> <!-- admin_container -->			
	</div> <!-- content -->
	</div> <!-- wrap_admin -->

</main>


<?php require_once ROOT . "/views/footer/footer.php";  ?> 