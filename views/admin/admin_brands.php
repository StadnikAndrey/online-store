<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt">	 
	<a href="/admin/add/brand" class="admin_rigt_adding">добавить бренд</a>
	<?php foreach ($brands as $key => $brand) : ?> 
	<div class="admin_one_brand">		 
			<p class="admin_one_brand_id">id: <?= $brand['id'] ?></p>
			<p class="admin_one_brand_name"><?= $brand['name'] ?></p>			 
			<a href="/admin/update/brand/<?= $brand['id'] ?>" class="admin_one_brand_update" title="Редактировать бренд"><img src="/public/img/admin_update.svg" alt="" class="admin_one_brand_img"></a>		 
	</div> <!-- admin_one_brand -->
	 <?php endforeach ?>	 
	 
	</div> <!-- admin_rigt -->											
	</div> <!-- admin_container -->			
	</div> <!-- content -->
	</div> <!-- wrap_admin -->

</main>


<?php require_once ROOT . "/views/footer/footer.php";  ?> 