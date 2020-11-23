<?php require_once ROOT . "/views/header/header.php";  ?> 
<main>
<div class="wrap_message">
	<h1 class="message_title">Спасибо, ваш заказ <?= $getOrder['id'] ?> принят в обработку! </h1>
	<div class="container_message">
		 
		<div class="message_order_products">
			<?php foreach ($productsOrder as $key => $product) : ?>
			<div class="message_one_order"> 
			<p class="message_one_order_img">
			<img src="public/img_products/<?= stristr($product['img'], ',', true) ?>" alt="">
			</p>
			<div class="message_one_order_container">
			<div class="message_one_order_info">
			<p class="message_one_order_info_name"><?= $product['name'] ?> <?= $product['model'] ?></p>
			<p class="message_one_order_info_articul">Артикул: <span><?= $product['code'] ?></span></p>
			</div>
			<div class="message_one_order_size_price"> 
			<div class="message_one_order_wrap_size_count"> 
			<div class="message_one_order_size_title">Размер <span><?= $product['size'] ?></span></div> 
			<div class="message_one_order_count_title">Количество <span><?= $product['count'] ?></span> шт.</div> 
			</div> 
			<div class="message_one_order_price"><?= $product['count'] * $product['price'] ?> грн</div>
			</div> 
			</div> <!-- message_one_order_container -->
			</div> <!-- message_one_order -->	
			<?php endforeach ?>
		</div> <!-- message_order_products -->

		<div class="message_inform">
			<p class="message_inform_title">Контактные данные:</p>
			<div class="message_inform_wrap_contact">
				<p class="message_inform_name"><?= $getOrder['surname'] ?>  <?= $getOrder['name'] ?></p>
				<p class="message_inform_email"><?= $getOrder['email'] ?></p>
				<p class="message_inform_telefon"><?= $getOrder['mobile_number'] ?></p>				
			</div> <!-- message_inform_wrap_contact -->
			<p class="message_inform_title">Доставка:</p>
			<div class="message_delivery">
				<?php if ($getOrder['delivery_method'] == 'в отделение') : ?>
				<span class="mes_dev_capital_letter"><?= $getOrder['city'] ?></span>, <?= $getOrder['delivery_service'] ?>, в отделение №<?= $getOrder['post_office_number'] ?> 
			    <?php endif ?>
			    <?php if ($getOrder['delivery_method'] == 'курьером') : ?>
				<span class="mes_dev_capital_letter"><?= $getOrder['city'] ?></span>, <?= $getOrder['delivery_service'] ?>, курьером по адресу: <?= $getOrder['street'] ?>
				дом: <?= $getOrder['house_number'] ?> квартира: <?= $getOrder['apartment_number'] ?> 
			    <?php endif ?>				 
			</div>
			<p class="message_inform_payment">Оплата: <?= $getOrder['checkout_payment'] ?></p>
			<p class="message_inform_cost_delivery">Стоимость доставки: бесплатно</p>
			<p class="message_inform_sum">К оплате: <?= $costOrder ?> грн</p>
			 
			
		</div> <!-- message_inform -->
		
</div> <!-- container_message -->	
</div>	 <!-- wrap_message -->
</main>

<?php require_once ROOT . "/views/footer/footer.php";  ?>