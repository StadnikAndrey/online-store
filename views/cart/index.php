 <?php require_once ROOT . "/views/header/header.php";  ?> 
<main>
<div class="wrap_cart">
	<div class="content">
	  <?php if(isset($cartProducts) && !empty($cartProducts)): ?>  
		<p class="cart_title">В корзине</p>
 
 <?php foreach ($cartProducts as $key => $product) : ?>
<div class="cart_one_order" data-k="<?= $product['key'] ?>">			 
<a href="/product/<?= $product['id'] ?>" class="cart_one_order_info_name_adaptive"></a>
<div class="cart_one_order_container">
<a href="/product/<?= $product['id'] ?>" class="cart_one_order_img">
<img src="public/img_products/<?=stristr($product['img'], ',', true);   ?>" alt="">
</a>

<div class="cart_one_order_info">
<a href="/product/<?= $product['id'] ?>" class="cart_one_order_info_name"><?= $product['name'] ?> <?= $product['model'] ?></a>
<p class="cart_one_order_info_articul">Артикул: <span><?= $product['code'] ?></span></p>
</div>
<form class="cart_one_order_form">
<p class="cart_one_order_info_articul_adaptive"></p>
<div class="cart_one_order_wrap_size_count">
<div class="cart_one_order_size">
<div class="cart_one_order_size_title">Размер</div>
<input type="text" value="<?= $product['size'] ?>" disabled='disabled'>
</div>
<div class="cart_one_order_count">
<div class="cart_one_order_count_title">Количество</div>
<input type="text" value="<?= $product['count'] ?>" data-key_up="<?= $product['key'] ?>" maxlength="2" class="cart_one_order_change_input">
<p class="cart_one_order_change_count">изменить</p>  
<p></p> 
</div>
</div>
<div class="cart_one_order_price_adaptiv"></div>
</form>
<div class="cart_one_order_price"><span class="cart_one_order_cost"><?= $product['count'] * $product['price'] ?></span>  грн</div> 
 <div class="cart_one_order_delete" data-key="<?= $product['key'] ?>"><img src="public/img/close.png" alt=""></div>  
</div> <!-- cart_one_order_container -->
</div> <!-- cart_one_order -->
<?php endforeach ?>
 

<div class="cart_summa_order"><p>Сумма заказа <span><?= $cost ?></span> грн</p>
	<a href="/checkout" class="cart_checkout">Оформить заказ</a>
</div>
  <?php   else: ?> 	
<p class="cart_one_order_info_name">Ваша корзина пуста !</p>
<?php endif ?>  
	</div> <!-- content -->
</div> <!-- wrap_cart --> 



 
</main>
 
<?php require_once ROOT . "/views/footer/footer.php";  ?>