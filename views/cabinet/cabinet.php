<?php require_once ROOT . "/views/header/header.php";  ?>
 <main>
 	<div class="wrap_cabinet">
	<div class="content">
		<div class="cabinet_container">

			<?php require_once ROOT . "/views/cabinet_menu/index.php";  ?>
			 
			<div class="cabinet_rigt">
				  <h1 class="cabinet_rigt_title">История покупок</h1>
<?php if (isset($allOrders) && !empty($allOrders)): ?>
<?php foreach ($allOrders as $key => $order): ?>
<div class="cabinet_one_order">
  	<div class="cabinet_one_order_top">
  		<div class="cabinet_one_order_title">
  			<p class="cabinet_one_order_title_num">Заказ <?= $order['id'] ?> от <?= explode(" ", $order['date_add'])[0] ?></p>
  			<p class="cabinet_one_order_title_price"><?= $order["total_cost"] ?> грн <span class="cabinet_one_order_title_status"><?= $order['status']['name'] ?></span></p>	 
  		</div>	
  		<p class="cab_one_order_hide_details">Детали</p>
  	</div> <!-- cabinet_one_order_top -->
  	<div class="cabinet_one_order_wrap">

<?php for ($i=0; $i < count($order['PRODUCT']); $i++): ?>
  	<div class="cabinet_one_order_product"> 
	<a href="/product/<?= isset($order['PRODUCT'][$i]['id'])?$order['PRODUCT'][$i]['id']:'#' ?>" class="cabinet_one_order_product_img">
	<img src="public/img_products/<?= stristr($order['PRODUCT'][$i]['img'], ',', true)?stristr($order['PRODUCT'][$i]['img'], ',', true):'';   ?>" alt="">
	</a>
	<div class="cabinet_one_order_product_container">
	<div class="cabinet_one_order_product_info">
	<a href="/product/<?= $order['PRODUCT'][$i]['id'] ?>" class="cabinet_one_order_product_info_name">
		<?= isset($order['PRODUCT'][$i]['name'])?$order['PRODUCT'][$i]['name']:'' ?><br>
		<?= isset($order['PRODUCT'][$i]['model'])?$order['PRODUCT'][$i]['model']:'' ?></a>
	<p class="cabinet_one_order_product_info_articul">Артикул: <span>
	<?= isset($order['PRODUCT'][$i]['code'])?$order['PRODUCT'][$i]['code']:'' ?></span></p>
	</div>
	<div class="cabinet_one_order_product_size_price"> 
	<div class="cabinet_one_order_product_wrap_size_count"> 
	<div class="cabinet_one_order_product_size_title">Размер <span><?= $order['PRODUCT'][$i]['size'] ?></span></div> 
	<div class="cabinet_one_order_product_count_title">Количество <span><?= $order['PRODUCT'][$i]['count'] ?></span> шт.</div> 
	</div> 
	<div class="cabinet_one_order_product_price">
	<?= isset($order['PRODUCT'][$i]['price_one'])?$order['PRODUCT'][$i]['price_one']*$order['PRODUCT'][$i]['count']:'' ?> грн</div>
	</div> 
	</div> <!-- cabinet_one_order_product_container -->
	</div> <!-- cabinet_one_order_product -->
<?php endfor ?>

	<div class="cabinet_one_order_delivery">
		<p class="cabinet_one_order_delivery_title">Доставка:</p>
		<p class="cabinet_one_order_delivery_info"><?= $order['delivery_service'] ?>, 
			<?php if ($order['delivery_method']=='в отделение'): ?>
			Отделение №<?= $order['post_office_number'] ?> <?= $order['city'] ?>
			<?php endif ?>

			<?php if ($order['delivery_method']=='курьером'): ?>
			Доставка курьером по адресу: улица <?= $order['street'] ?> дом <?= $order['house_number'] ?> 
			квартира <?= $order['apartment_number'] ?>  <?= $order['city'] ?>
			<?php endif ?>

		   </p>
	</div>	<!-- cabinet_one_order_delivery -->
  		
  	</div> <!-- cabinet_one_order_wrap -->
</div> <!-- cabinet_one_order -->
<?php endforeach ?>
<?php else :?> 
<p class="cabinet_empty_orders">Вы не сделали ни одной покупки в нашем магазине!</p>
<?php endif ?>

		</div> <!-- cabinet_rigt -->
			
		</div> <!-- cabinet_container -->
		
	</div> <!-- content -->
</div> <!-- wrap_cabinet -->
 </main>
<?php require_once ROOT . "/views/footer/footer.php";  ?>