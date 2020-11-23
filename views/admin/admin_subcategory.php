<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt">	 
	<a href="/admin/insert/subcategory" class="admin_rigt_adding">добавить субкатегорию</a>

 <?php foreach ($subcategorys as $key => $subcategory) : ?>
	<div class="admin_one_subcategory">		 
			<p class="admin_one_subcategory_id">id: <?= $subcategory['id'] ?></p>
			<p class="admin_one_subcategory_name"><?= $subcategory['name'] ?></p>			 
			<a href="/admin/update/subcategory/<?= $subcategory['id'] ?>" class="admin_one_subcategory_update" title="Редактировать субкатегорию"><img src="/public/img/admin_update.svg" alt="" class="admin_one_subcategory_img"></a>	 
	</div> <!-- admin_one_subcategory -->
<?php endforeach ?>

	</div> <!-- admin_rigt -->											
	</div> <!-- admin_container -->			
	</div> <!-- content -->
	</div> <!-- wrap_admin -->

</main>


<?php require_once ROOT . "/views/footer/footer.php";  ?> 