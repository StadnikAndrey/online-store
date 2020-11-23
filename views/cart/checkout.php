<?php require_once ROOT . "/views/header/header.php";  ?> 
<main>
<div class="wrap_checkout">
	<div class="content">
		<form action="" method="POST" class="checkout_form" novalidate>
		<div class="checkout_left">

		<div class="checkout_contact">
			   <p class="checkout_section_title">Контактные данные</p>
				<div class="checkout_contact_fio">
					<div class="checkout_row">
					<label for="" class="checkout_label">Фамилия:</label> 
					<input id="check_surname" type="text" name="ch_surname" value="<?= !empty($_POST['ch_surname'])? getArrVal($_POST, 'ch_surname'):$user['surname'] ?>" class="checkout_input">
					 <div class="ch_error_surname">Введите фамилию кириллицей!</div>
				    </div>
				    

					<div class="checkout_row" data-er="ошибка">
					<label for="" class="checkout_label">Имя:</label> 
					<input id="check_name" type="text" name="ch_name" value="<?= !empty($_POST['ch_name'])? getArrVal($_POST, 'ch_name'):$user['name'] ?>" class="checkout_input">
					<div class="ch_error_name">Введите имя кириллицей!</div>
				    </div>
				    <div class="checkout_row">
					<label for="" class="checkout_label">Отчество:</label> 
					<input id="check_patronymic" type="text" name="ch_patronymic" value="<?= !empty($_POST['ch_patronymic'])? getArrVal($_POST, 'ch_patronymic'):$user['patronymic'] ?>" class="checkout_input">
					<div class="ch_error_patronymic">Введите отчество кириллицей!</div>
				    </div>				 
				</div> <!-- checkout_contact_fio -->
			<div class="checkout_contact_email_telefon">
				<div class="checkout_row">
					<label for="" class="checkout_label">Номер мобильного телефона:</label> 
					<input id="check_mob_num" type="text" name="ch_mobile_number" value="<?= !empty($_POST['ch_mobile_number'])? getArrVal($_POST, 'ch_mobile_number'):$user['mobile_number'] ?>" class="checkout_input">
					<div class="ch_error_mobile_number">Введите корректный номер мобильного телефона!</div>
				</div>

				<div class="checkout_row">
					<label for="" class="checkout_label">E-mail:</label> 
					<input id="check_email" type="email" name="ch_email" value="<?=!empty($_POST['ch_email'])? getArrVal($_POST, 'ch_email'): $user['email'] ?>" class="checkout_input">
					<div class="ch_error_email">Введите корректный E-mail!</div>
				</div>
			</div> <!-- checkout_contact_email_telefon -->					
		</div> <!-- checkout_contact -->

		<div class="checkout_delivery">
			<p class="checkout_section_title">Доставка </p>
			<div class="checkout_delivery_region">
	        <div class="checkout_row">
			<label for="" class="checkout_label">Город:</label> 
			<input id="check_city" type="text" name="ch_city" value="<?= getArrVal($_POST, 'ch_city');?>" class="checkout_input">
			<div class="ch_error_city">Введите название города кириллицей!</div>
		    </div>	
			<div class="checkout_row" data-er="ошибка">
			<label for="" class="checkout_label">Область:</label> 
			<input id="check_region" type="text" name="ch_region" value="<?= getArrVal($_POST, 'ch_region');?>" class="checkout_input">
			<div class="ch_error_region">Введите название области кириллицей!</div>
		    </div>
		    <div class="checkout_row">
			<label for="" class="checkout_label">Район:</label> 
			<input id="check_district" type="text" name="ch_district" value="<?= getArrVal($_POST, 'ch_district');?>" class="checkout_input">
			<div class="ch_error_district">Введите название района кириллицей!</div>
		    </div>		
			</div> <!-- checkout_delivery_region -->
			<div class="checkout_row">						 
			<select name="ch_delivery_service" class="checkout_select">
				<option selected >Служба доставки</option>
				<option value="Новая почта" <?php selected($_POST,"ch_delivery_service","Новая почта") ?>>Новая почта</option>
				<option value="Justin" <?php selected($_POST,"ch_delivery_service","Justin") ?>>Justin</option>
			</select>
			<div class="ch_error_deliv_serv">Выберите службу доставки!</div>					
			</div>

			<div class="checkout_delivery_method">
			<div class="checkout_delivery_method_container">
			<div class="checkout_delivery_method_post_office">
				<div class="checkout_row post_office">
				<input id="check_office" type="radio" name="checkout_delivery_method" value="в отделение" class="checkout_delivery_input" checked <?php checkedRadio($_POST,"checkout_delivery_method","в отделение") ?>>
				<label for="check_office" class="checkout_delivery_label post_office_label">В отделение</label> 			 
				</div>
			<div class="checkout_delivery_number">
				<div class="checkout_row row_number">
				<label for="" class="checkout_label">Номер отделения:</label> 
				<input id="" type="text" name="ch_post_office_number" value="<?= getArrVal($_POST, 'ch_post_office_number') ;?>" class="checkout_input input_number">
				 <div class="ch_error_office_number">Введите номер отделения!</div>
				</div>
			</div>
			</div>
			<div class="checkout_delivery_method_post_courier">
				<div class="checkout_row">
				<input id="check_courier" type="radio" name="checkout_delivery_method" value="курьером" class="checkout_delivery_input" <?php checkedRadio($_POST,"checkout_delivery_method","курьером") ?>>
				<label for="check_courier" class="checkout_delivery_label delivery_courier_label">Курьером</label> 			 
				</div>
			<div class="checkout_delivery_adres">
			<div class="adres_wrap">
				<div class="checkout_row post_courier_street">
				<label for="" class="checkout_label">Улица:</label> 
				<input id="" type="text" name="ch_street" value="<?= getArrVal($_POST, 'ch_street');?>" class="checkout_input">
				<div class="ch_error_street">Введите название улицы кириллицей!</div>
				</div>	
				<div class="checkout_row post_courier_house" data-er="ошибка">
				<label for="" class="checkout_label">Дом:</label> 
				<input id="" type="text" name="ch_house_number" value="<?= getArrVal($_POST, 'ch_house_number');?>" class="checkout_input">
				<div class="ch_error_house_number">Введите номер дома!</div>
				</div>
				<div class="checkout_row post_courier_apartment">
				<label for="" class="checkout_label">Квартира:</label> 
				<input id="" type="text" name="ch_apartment_number" value="<?= getArrVal($_POST, 'ch_apartment_number');?>" class="checkout_input">
				<div class="ch_error_apartment_number">Введите номер квартиры!</div>
				</div>
			</div>
			</div> <!-- checkout_delivery_adres -->
			</div> <!-- checkout_delivery_method_post_courier -->
			</div> <!-- checkout_delivery_method_container -->
			<div class="checkout_delivery_result"></div>				
			</div> <!-- checkout_delivery_method -->
		</div> <!-- checkout_delivery -->

		<div class="checkout_payment">
			<p class="checkout_section_title">Оплата</p>
			    <div class="checkout_row">
				<input id="p" type="radio" name="checkout_payment" value="при получении" class="checkout_delivery_input" checked>
				<label for="p" class="checkout_delivery_label">При получении</label> 			 
				</div>
		</div> <!-- checkout_payment -->

		<div class="checkout_review">
			<p class="checkout_review_title">Добавить комментарий к заказу</p>
			<div class="checkout_row review_row">		 
			<textarea name="ch_comment" id="" cols="30" rows="10" class="checkout_textarea" placeholder="Тут вы можете уточнить информацию или оставить свои комментарии по вашему заказу"><?= getArrVal($_POST, 'ch_comment');?></textarea>
		    </div>		
		</div> <!-- checkout_review -->
</div> <!-- checkout_left -->



<div class="checkout_right">
	<?php if (isset($cartProducts) && !empty($cartProducts)) : ?>
	<div class="checkout_order">
    <p class="checkout_section_title">Вы выбрали </p>     
	<?php foreach ($cartProducts as $key => $product) : ?>
	<div class="checkout_one_order"> 
	<a href="/product/<?= $product['id'] ?>" class="checkout_one_order_img">
	<img src="public/img_products/<?=stristr($product['img'], ',', true);   ?>" alt="">
	</a>
	<div class="checkout_one_order_container">
	<div class="checkout_one_order_info">
	<a href="/product/<?= $product['id'] ?>" class="checkout_one_order_info_name"><?= $product['name'] ?><br><?= $product['model'] ?></a>
	<p class="checkout_one_order_info_articul">Артикул: <span><?= $product['code'] ?></span></p>
	</div>
	<div class="checkout_one_order_size_price"> 
	<div class="checkout_one_order_wrap_size_count"> 
	<div class="checkout_one_order_size_title">Размер <span><?= $product['size'] ?></span></div> 
	<div class="checkout_one_order_count_title">Количество <span><?= $product['count'] ?></span> шт.</div> 
	</div> 
	<div class="checkout_one_order_price"><?= $product['count'] * $product['price'] ?> грн</div>
	</div> 
	</div> <!-- checkout_one_order_container -->
	</div> <!-- checkout_one_order -->	
	<?php endforeach ?>		
	</div> <!-- checkout_order -->

	<div class="checkout_total">
		<div class="checkout_total_summa">
			<p class="checkout_total_summa_name"><?= $quantity ?> <?= declensionWord($quantity) ?> на сумму:</p>
			<p class="checkout_total_summa_number"><?= $cost ?> грн.</p>
		</div>
		<div class="checkout_total_delivery">
			<p class="checkout_total_delivery_name">Доставка:</p>
			<p class="checkout_total_delivery_price">Бесплатно</p>
		</div>
		<div class="checkout_total_total">
			<p class="checkout_total_total_name">Итого:</p>
			<p class="checkout_total_total_num"><?= $cost ?> грн.</p>
		</div>		
	</div>

	<div class="checkout_agreement">
		<a href="/safety" target="_blank" class="checkout_agreement_link">Оформляя заказ я согласен (на) с условиями</a>
	</div>
	<input type="hidden" name="checkout_order">
	<button type="submit" class="checkout_btn_submit">Оформить заказ</button>
	           <?php if (isset($error) && !empty($error)) :
				foreach ($error as $key => $value) :?>
			    <p class="checkout_error"><?= $value ?></p>
			    <?php
			      endforeach;
			      endif; ?>

				<?php if (isset($error_form) && !empty($error_form)) :
				foreach ($error_form as $key => $value) :?>
			    <p class="checkout_error"><?= $value ?></p>
			    <?php
			      endforeach;
			      endif; ?>

	<?php else: ?>
		<p class="checkout_warning_delete">Ваша корзина пуста!</p>

	<?php endif ?>
 	
</div> <!-- checkout_rigt -->
			

</form>
		
	</div> <!-- content -->
</div> <!-- wrap_form_order -->

	


</main> 


<?php require_once ROOT . "/views/footer/footer.php";  ?>