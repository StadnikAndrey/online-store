<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt">	 
	<a href="/admin/insert/status/order" class="admin_rigt_adding">добавить статус заказа</a>

 <?php foreach ($statuses as $key => $status) : ?>
	<div class="admin_one_order_status">		 
			<p class="admin_one_order_status_id">id: <?= $status['id'] ?></p>
			<p class="admin_one_order_status_name"><?= $status['name'] ?></p>			 
			<a href="/admin/update/status/order/<?= $status['id'] ?>" class="admin_one_order_status_update" title="Редактировать статус заказа"><img src="/public/img/admin_update.svg" alt="" class="admin_one_order_status_img"></a>		 
	</div> <!-- admin_one_order_status -->
<?php endforeach ?>
	 
	 
	 
	</div> <!-- admin_rigt -->											
	</div> <!-- admin_container -->			
	</div> <!-- content -->
	</div> <!-- wrap_admin -->

</main>


<?php require_once ROOT . "/views/footer/footer.php";  ?> 