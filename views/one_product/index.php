<?php require_once ROOT . "/views/header/header.php";  ?> 

<main>
<div class="wrap_one_product">
<div class="content">
<div class="one_product_container_slider_characteristics">
	 <!-- для отображения содержимого one_product_characteristic_container_name < 825px -->
	<div class="one_product_characteristic_media_js"></div>
<div class="one_product_slider">	  

      <div class="slider-nav ">       
	      	<?php for ($i=0; $i < count($arrImg) ; $i++) : ?>
	        <div>        
	        <img src="/public/img_products/<?= $arrImg[$i] ?>" 
	        alt="<?= $product['name'] ?> <?= $product['model'] ?> <?= $product['code'] ?>">   
	        </div>
	        <?php endfor ?>         
      </div>     
    
      <div class="slider-for  ">
	      	<?php for ($i=0; $i < count($arrImg) ; $i++) : ?>
	        <div>        
	        <img src="/public/img_products/<?= $arrImg[$i] ?>"
	        alt="<?= $product['name'] ?> <?= $product['model'] ?> <?= $product['code'] ?>">       
	        </div>
	        <?php endfor ?>         
      </div>       
 
</div> <!-- one_product_slider -->

<div class="one_product_characteristics"> 
<div class="one_product_characteristic_container_name">
	<h1 class="one_product_characteristics_name"><?= $product['name'] ?><br><span><?= $product['model'] ?></span></h1>
	<p class="one_product_characteristics_articul">Артикул: <?= $product['code'] ?></p>
	<p class="one_product_characteristics_price"><?= $product['price'] ?> грн</p>
</div>
<div class="one_product_size">
	<p class="one_product_size_name">
		<?php if (!empty($sizes)) : ?>
			Размер
		<?php endif ?>
	 </p>
	<form action="" method="" class="one_product_size_form">
		<?php if (empty($sizes)) : ?>
			<p class="one_product_size_empty">Нет в наличии</p>
		<?php endif ?>

        <div class="one_product_size_container_input">
		 <?php foreach ($sizes as $key => $size) : ?>			 
			<label for="<?= 'sz-'. $size['id'] ?>" class="one_product_size_label">
				<input type="radio" id="<?= 'sz-'. $size['id'] ?>" name="one_product_size" value="<?= $size['id'] ?>" class="one_product_size_radio">
				<span><?= $size['name'] ?></span>
			</label>	      
		     <?php endforeach ?> 
		     <input type="hidden" name="one_product_id" value="<?= $product['id'] ?>">		      
		 </div>
		 <div class="one_product_size_warning">Выберите размер !</div>	 
        <?php if (!empty($sizes)) : ?>			 
			<button type="button" class="one_product_add_cart">В корзину</button>
		<?php endif ?>
		<!-- предупреждение при превышении количества товаров при добавлении в корзину -->
		<p id="cart_warning"></p>
	</form>
</div> <!-- one_product_size -->	 
 
</div> <!-- one_product_characteristics -->
</div> <!-- one_product_container_slider_characteristics -->

<div class="one_product_details">
	<div class="one_product_details_discribe">
		<h4 class="one_product_details_title one_product_details_title_active">Описание товара</h4>
		<div class="one_product_details_info one_product_details_first">
<div class="details_one_product">	 
	<?= $product['details'] ?>
</div>
		 
<div class="wrap_discribe_one_product">
	<div class="discribe_one_product">		  
		 <?= $product['description'] ?> 
	</div>
	<div class="img_one_product">
		 <img src="/public/img_products/<?= stristr($product['img'], ',', true)  ?>"
		 alt="<?= $product['name'] ?> <?= $product['model'] ?> <?= $product['code'] ?>">
	</div>
</div>
		</div>		
	</div> <!-- one_product_details_discribe -->

	<div class="one_product_details_discribe">
		<h4 class="one_product_details_title">Доставка</h4>
		<div class="one_product_details_info">
			 <div class="delivery_one_product">
			 	Способы доставки:<br>   - Самовывоз из отделения "Новая Почта". <br> Срок доставки: 3-4 дня (доставка заказов, оформленных в период распродажи, может быть увеличена до 5-8 рабочих дней). <br> Стоимость: бесплатно – при сумме заказа от 1500 грн, 50 грн – от 1 до 1499 грн.  Бесплатно, если заказанный товар не подошел. <br>Оплата товара: на сайте банковской картой или в отделении банковской картой либо наличными. <br><br>- Доставка курьером  "Новая Почта". <br>Срок доставки: 3-4 дня (доставка заказов, оформленных в период распродажи, может быть увеличена до 5-8 рабочих дней). <br>Стоимость: бесплатно – при сумме заказа от 1500 грн, 70 грн – от 1 до 1499 грн. Бесплатно, если заказанный товар не подошел. <br>Оплата товара: на сайте банковской картой или у курьера банковской картой либо наличными. <br><br>- Самовывоз из отделений УкрПошта. <br>Срок доставки: 3-6 дней (в период распродажи срок доставки может быть увеличен) <br>Стоимость: бесплатно. <br>Оплата товара: на сайте банковской картой или в отделении банковской картой либо наличными.<br><br> ВАЖНО: <br>- Оплата стоимости доставки осуществляется вместе (одной суммой) с оплатой товара на сайте, в отделении или курьером при получении. <br>- Товар хранится в отделении компаний Новая Почта», «УкрПошта» 4 календарных дня. На 5-й день товар возвращается отправителю.<br> - При получении товара обязательно проверяйте наличие всего товара в заказе и его внешний вид. В случае повреждения или наличия только части комплекта – необходимо отказаться от получения такого заказа. <br>- Оформляйте каждый товар отдельным заказом. Тогда, если какой-то товар вам не подойдет, вы сможете отказаться от него и приобрести только те товары, которые подходят.
 
			 </div>
		</div>		
	</div> <!-- one_product_details_discribe -->

	<div class="one_product_details_discribe">
		<h4 class="one_product_details_title">Возврат</h4>
		<div class="one_product_details_info">
			 <div class="one_product_return">
			 	Чтобы вернуть товар, нужно сделать 3 простых шага: <br> Вышлите на электронную почту return@shoptest.ua документы, без которых сроки возврата могут увеличиться. В теме письма укажите номер заказа, который Вы возвращаете. <br>Необходимые документы:<br> - полностью заполненное на украинском языке «Заявление на возврат товара»;<br> - подписанную «накладную на возврат товара» (этот документ содержится в заказе); копию Паспорта (стр. 1) или копию Идентификационного кода (держателя карты) – только для заказов наложенным платежом.<br> Инструкция для оформления возврата в отделении Новая Почта» или «УкрПошта» будет отправлена ответом на ваше письмо с заявлением на возврат. <br>Что делать после получения инструкции по возврату?<br> Аккуратно упакуйте товар В ОРИГИНАЛЬНУЮ УПАКОВКУ в полной комплектации (товары, поставляемые в комплекте, необходимо возвращать также в комплекте). <br>Обратитесь в ближайшее отделение Новая Почта» или «УкрПошта» и отправьте товар вместе с заполненными документами на возврат нам, согласно инструкции, которая Вам была выслана на электронную почту. <br>   К сожалению, мы не сможем принять возврат в некоторых случаях: <br> После 14-ти дней с момента его получения; <br>При отсутствии «Заявления на возврат товара» и «Накладной на возврат», с указанием причины возврата. <br>При неполной комплектации возврата: отсутствии упаковки, в которой вам товар был доставлен, ярлыков, этикеток и пр. <br>Если товары были в употреблении. 
			 </div>


		</div>		
	</div> <!-- one_product_details_discribe -->

	<div class="one_product_details_discribe">
		<h4 class="one_product_details_title">Условия продажи</h4>
		<div class="one_product_details_info">
			<div class="one_product_sale">
			 	После прибытия вашего заказа в отделение почты, вам придёт смс-уведомление, в котором будет написана дата, до которой товар будет зарезервирован в магазине под вас с зафиксированной ценой равной цене в заказе. <br> По истечению указанного в сообщении срока резерв аннулируется, и товар может быть продан, на него может измениться цена и т.д. <br>Товар, заказанный на сайте shoptest.kl.com.ua оплачивается только в национальной валюте Украины. <br>Способы оплаты: наличными или банковской картой в отделении почты, курьеру почты, на сайте shoptest.kl.com.ua. 
			 </div>
		</div>		
	</div> <!-- one_product_details_discribe -->

	<div class="one_product_details_discribe">
		<h4 class="one_product_details_title">Правила магазина</h4>
		<div class="one_product_details_info">
			<div class="one_product_regulations">
				 § 1 ВСТУПЛЕНИЕ <br>
				 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam fugit quae officia, recusandae, dolorum ex commodi. Eos eveniet sequi dolorem, magnam laudantium esse atque excepturi quidem, nisi magni soluta adipisci. <br><br>
				 § 2 ПРАВИЛА ПОЛЬЗОВАНИЯ МАГАЗИНОМ И ЗАКЛЮЧЕНИЯ ДОГОВОРОВ НА ПРОДАЖУ ТОВАРОВ <br>
				 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam fugit quae officia, recusandae, dolorum ex commodi. Eos eveniet sequi dolorem, magnam laudantium esse atque excepturi quidem, nisi magni soluta adipisci. <br><br>
				 § 3 ЗАКЛЮЧЕНИЕ ДОГОВОРА ПРОДАЖИ <br>
				 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam fugit quae officia, recusandae, dolorum ex commodi. Eos eveniet sequi dolorem, magnam laudantium esse atque excepturi quidem, nisi magni soluta adipisci. <br><br>
				 § 4 ДОСТАВКА И ПОЛУЧЕНИЕ ТОВАРОВ <br>
				 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam fugit quae officia, recusandae, dolorum ex commodi. Eos eveniet sequi dolorem, magnam laudantium esse atque excepturi quidem, nisi magni soluta adipisci. <br><br>
				 § 5 СТОИМОСТЬ И ФОРМА ОПЛАТЫ <br>
				 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam fugit quae officia, recusandae, dolorum ex commodi. Eos eveniet sequi dolorem, magnam laudantium esse atque excepturi quidem, nisi magni soluta adipisci. <br><br>
				 § 6 РЕКЛАМАЦИИ НА ТОВАРЫ <br>
				 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam fugit quae officia, recusandae, dolorum ex commodi. Eos eveniet sequi dolorem, magnam laudantium esse atque excepturi quidem, nisi magni soluta adipisci. <br><br>
				 § 7 ВОЗВРАТ ТОВАРОВ – РАСТОРЖЕНИЕ ДОГОВОРА ПРОДАЖИ<br>
				 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam fugit quae officia, recusandae, dolorum ex commodi. Eos eveniet sequi dolorem, magnam laudantium esse atque excepturi quidem, nisi magni soluta adipisci. <br><br>
				 § 8 СВЕДЕНИЯ ОБ УСЛУГАХ, ОКАЗЫВАЕМЫХ ЭЛЕКТРОННЫМ ПУТЕМ<br>
				 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam fugit quae officia, recusandae, dolorum ex commodi. Eos eveniet sequi dolorem, magnam laudantium esse atque excepturi quidem, nisi magni soluta adipisci. <br><br>
				 §9 ИНФОРМАЦИЯ,
КАСАЮЩАЯСЯ ОБРАБОТКИ КОМПАНИЕЙ WEARCO S.A. ПЕРСОНАЛЬНЫХ ДАННЫХ ПОЛЬЗОВАТЕЛЕЙ МАГАЗИНА<br>
				 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam fugit quae officia, recusandae, dolorum ex commodi. Eos eveniet sequi dolorem, magnam laudantium esse atque excepturi quidem, nisi magni soluta adipisci. <br><br>
				 § 10 ЗАКЛЮЧИТЕЛЬНЫЕ ПОЛОЖЕНИЯ<br>
				 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam fugit quae officia, recusandae, dolorum ex commodi. Eos eveniet sequi dolorem, magnam laudantium esse atque excepturi quidem, nisi magni soluta adipisci. <br><br>
			</div>
			  
		</div>		
	</div> <!-- one_product_details_discribe -->
	
</div> <!-- one_product_details -->
<div class="one_product_screen_details"></div>
	 	
</div> <!-- content -->
</div> <!-- wrap_one_product -->
</main>
 
<?php require_once ROOT . "/views/footer/footer.php";  ?>