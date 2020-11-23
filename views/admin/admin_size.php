<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt">	 
	<a href="/admin/insert/size" class="admin_rigt_adding">добавить размер</a>

 <?php foreach ($sizes as $key => $size): ?>
	<div class="admin_one_size">
		 
			<p class="admin_one_size_id">id: <?= $size['id'] ?></p>
			<p class="admin_one_size_name"><?= $size['name'] ?></p>			 
			<a href="/admin/update/size/<?= $size['id'] ?>" class="admin_one_size_update" title="Редактировать размер"><img src="/public/img/admin_update.svg" alt="" class="admin_one_size_img"></a>
			 
		 
	</div> <!-- admin_one_size -->
<?php endforeach ?>	 
	 
	</div> <!-- admin_rigt -->											
	</div> <!-- admin_container -->			
	</div> <!-- content -->
	</div> <!-- wrap_admin -->

</main>

<?php require_once ROOT . "/views/footer/footer.php";  ?> 