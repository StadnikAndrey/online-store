<?php 
class OrdersController {
	// переход на страницу оформления заказа из корзины
	public static function actionCheckout(){	 
		$menu = CoreController::getMainMenu();
		if (isset($_SESSION['user']) && $_SESSION['user']['is_ban']==0) {
			$redirect = false;
			$user = Account::getUser($_SESSION['user']['id']);
			$cartProducts = Products::getCartProducts();
			// общее количество товаров в корзине
			$quantity = 0;
			if (isset($cartProducts) && !empty($cartProducts)) {
				foreach ($cartProducts as $key => $value) {
				$quantity += $value['count'];
			    }
			}
			// общая стоимость товаров в корзине
			$cost = 0;
			if (isset($cartProducts) && !empty($cartProducts)) {
				foreach ($cartProducts as $key => $value) {
				$cost += $value['count'] * $value['price'];
			    }
			}
		    // оформление заказа после нажатия кнопки "Оформить заказ" страницы оформления заказа(checkout)
			if (isset($_POST['checkout_order']) && isset($_SESSION['cart'])) {				 
				 $error= [];
				// проверка наличия товаров корзины определенного размера в магазине
				foreach ($_SESSION['cart'] as $key => $value) {
					$count = Products::getCountProductSize($value['id'], $value['size']);					
					 if ($count['products_count'] < $value['count']) {
						$product = Products::getById($value['id']);
						$size = Products::getBySizeId($value['size']);					 
						$error[] = "{$product['model']} р. {$size['name']} осталось в наличии {$count['products_count']} шт. Измените количество в корзине.";						 
					 }
				}
				// если товары в наличии:
				if (empty($error)) {
					// массив с сообщениями при неправильном
					// заполнении пользователем полей формы
					$error_form = [];
				    // создание массива с данными из формы заказа и валидация формы заказа					 
					 $order = [];
					// фамилия
					if(mb_strlen($_POST['ch_surname']) < 100 && preg_match('/^[а-яА-Я\s-]{1,100}$/iu', $_POST['ch_surname'])) {
						$order['surname'] = trim($_POST['ch_surname']);
					} else {
						 $error_form[] = 'Введите корректную фамилию кириллицей!';
					}
					// имя
					if(mb_strlen($_POST['ch_name']) < 100 && preg_match('/^[а-яА-Я\s-]{1,100}$/iu', $_POST['ch_name'])) {
						 $order['name'] = trim($_POST['ch_name']);
					} else {
						 $error_form[] = 'Введите корректное имя кириллицей!';
					}
					// отчество
					if(mb_strlen($_POST['ch_patronymic']) < 100 && preg_match('/^[а-яА-Я\s-]{1,100}$/iu', $_POST['ch_patronymic'])) {
						$order['patronymic'] = trim($_POST['ch_patronymic']);
					} else {
						 $error_form[] = 'Введите корректное отчество кириллицей!';
					}
					// id пользователя
					$order['id_user'] =  $_SESSION['user']['id'];
					// номер мобильного телефона					 	 
					if (preg_match('/^(((\+38){0,1}|(38){0,1}|(8){0,1})([0-9]){10})$/iu', trim($_POST['ch_mobile_number']))){
						$order['mobile_number'] = trim($_POST['ch_mobile_number']);
					}else{
						$error_form[] = 'Не корректный номер телефона!';
						}		  
					// e-mail
					if(mb_strlen($_POST['ch_email']) < 100 && filter_var(trim($_POST['ch_email']), FILTER_VALIDATE_EMAIL)) {	 
						$order['email'] = trim($_POST['ch_email']);
					}else{
						$error_form[] = 'Не правильный E-mail!';
						}
					// город
			 		if(preg_match('/^[а-яА-Я\s-]{1,100}$/iu', trim($_POST['ch_city']))) {
						$order['city'] = trim($_POST['ch_city']);
					} else {
						 $error_form[] = 'Введите название города кириллицей!';
					}
					// область
					if(preg_match('/^[а-яА-Я\s-]{1,100}$/iu', trim($_POST['ch_region']))) {
						$order['region'] = trim($_POST['ch_region']);
					} else {
						 $error_form[] = 'Введите название области кириллицей!';
					}
					// район
					if(preg_match('/^[а-яА-Я\s-]{0,100}$/iu', trim($_POST['ch_district']))) {
						$order['district'] = trim($_POST['ch_district']);
					} else {
						 $error_form[] = 'Введите название района кириллицей!';
					}
					// служба доставки
					if (!empty($_POST['ch_delivery_service'])) {
						$order['delivery_service'] = $_POST['ch_delivery_service'];	
					}else{
						$error_form[] = 'Выберите службу доставки!';
					}
					$order['delivery_service'] = $_POST['ch_delivery_service'];	
					// метод доставки 		  
			 		$order['delivery_method'] = $_POST['checkout_delivery_method'];
			 		// доставка в отделение
			 		if ($_POST["checkout_delivery_method"]=="в отделение") {
			 			    $_POST['ch_street'] = '';
			 				$_POST['ch_house_number'] = '';
			 				$_POST['ch_apartment_number'] = '';
			 			if (preg_match('/^[0-9]{1,3}$|^[0-9]{1,3}[-\/]{1}[0-9]{1,3}$/iu', trim($_POST['ch_post_office_number']))) {
			 				$order['post_office_number'] = trim($_POST['ch_post_office_number']);
			 			}else{
			 				$error_form[] = 'Введите корректный номер отделения!';
			 			}			 			 
			 		}
			 		// доставка курьером
		 	 		if ($_POST["checkout_delivery_method"]=="курьером") {
			 			    $_POST['ch_post_office_number'] = '';
			 			// улица			 				 
			 			if (preg_match('/^[а-яА-Я0-9\s-]{1,100}$/iu', trim($_POST['ch_street']))) {
			 				$order['street'] = $_POST['ch_street'];
			 			}else{
			 				$error_form[] = 'Введите название улицы кириллицей!';
			 			}
			 			// дом
			 			if (preg_match('/^[0-9\/-]{1,100}$/iu', trim($_POST['ch_house_number']))) {
			 				$order['house_number'] = $_POST['ch_house_number'];
			 			}else{
			 				$error_form[] = 'Введите номер дома!';
			 			}
			 			// квартира
			 			if (preg_match('/^[0-9\/-]{1,100}$/iu', trim($_POST['ch_apartment_number']))) {
			 				$order['apartment_number'] = $_POST['ch_apartment_number'];
			 			}else{
			 				$error_form[] = 'Введите номер квартиры!';
			 			}			 			 
			 		}
			 		// срособ оплаты
			 		$order['checkout_payment'] = $_POST['checkout_payment'];
			 		// комментарий к заказу
			 		$order['comment'] = htmlentities(trim($_POST['ch_comment']), ENT_QUOTES);
			 		// массив с товарами в заказе в виде строки
			 		$order['products'] = json_encode($_SESSION['cart']);
			 		// общее количество товаров и стоимость
			 		$order['quantity_products'] = $quantity;
			 		$order['total_cost'] = $cost;		 		   

			 		  if (empty($error_form)) {
			 		  // транзакция для сохранения и получения сохраненного заказа для 
			 		  // последующей обработки именно сохраненного заказа 
			 		  // (отпр. менеджеру, вывод сообщения пользователю, изменение количества товаров в БД)
					  global $pdo;
			 		  $pdo->beginTransaction();
			 		  // сохранение заказа в таблицу orders
			 		  $saveOrder = Orders::saveOrder($order);
			 		  // получение заказа из таблицы orders
			 		  if ($saveOrder) {
			 		  	$getOrder = Orders::getOrder($_SESSION['user']['id']);			 		  	 
			 		  }
			 		  if ($saveOrder && $getOrder) {
			 		  	$pdo->commit();
			 		  	// информация о товарах в заказе
			 		  	$productsOrder = Orders::getProductsOrder(json_decode($getOrder['products'], true));		 		  	 
			 		  	// общее количество товаров в заказе
						$quantityOrder = 0;
						if (isset($productsOrder) && !empty($productsOrder)) {
							foreach ($productsOrder as $key => $value) {
							$quantityOrder += $value['count'];
						    }
						}
						// общая стоимость товаров заказа
						$costOrder = 0;
						if (isset($productsOrder) && !empty($productsOrder)) {
							foreach ($productsOrder as $key => $value) {
							$costOrder += $value['count'] * $value['price'];
						    }
						}
			 		  	// отправка письма с информацией о заказе менеджеру :
			 		  	$to = "manager@ukr.net";
				        $subject = "Заказ №{$getOrder['id']} {$getOrder['date_add']} ";				        
				        $message = Email::managerLetterOrder($getOrder,$productsOrder,$quantityOrder,$costOrder);
                        $headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset = utf-8' . "\r\n";
						$headers .= 'From: shoptest@shoptest.kl.com.ua' . "\r\n" ;					        
				        $letterManager = mail ($to,$subject,$message,$headers);
				        // если письмо менеджеру не отправилось:
				        if(!$letterManager) {
				           $file_url = ROOT . '/logs_orders/manager_orders_unsent.txt';
				           $text = "Заказ №{$getOrder['id']}  Дата: {$getOrder['date_add']} \r\n";
				           file_put_contents($file_url, $text,FILE_APPEND);
				        }

				        // отправка письма клиенту о принятии заказа в обработку :
			 		  	$to = $getOrder['email'];
				        $subject = "Ваш заказ принят в обработку!";				        
				        $message = Email::userLetterOrder($getOrder,$productsOrder,$quantityOrder,$costOrder);
				        $headers = "MIME-Version: 1.0\r\n";				         
				        $headers .= "Content-type: text/html; charset=utf-8 \r\n"; 
                        $headers .= 'From: shoptest@shoptest.kl.com.ua' . "\r\n" ;					        
				        $letterUser = mail ($to,$subject,$message,$headers);

				        // уменьшение количества товара определенного размера в products_sizes,
				        // удаление строрки из product_size где количество товара равно 0,
				        // если товара нет в product_size - в products видимость(visibility) изменить на 0 :
				        foreach (json_decode($getOrder['products'], true) as $key => $value) {
				        	// количество товара опред. размера в магазине
							$count = Products::getCountProductSize($value['id'], $value['size']);
							// новое количество товара 
							$products_count = $count['products_count'] - $value['count'];
							// редактируем количество товара
							Orders::quantityReduction($products_count, $value['id'], $value['size']);
							// получаем количество товара после редактирования
							$newCount = Products::getCountProductSize($value['id'], $value['size']);
							if ((int)$newCount['products_count'] == 0) {
								// удаление строки из product_size где количество товара равно 0
							 	Orders::deleteStr($value['id'], $value['size']);
							 	// поиск товара в product_size
							 	$availability = Orders::searchProductId($value['id']);
							 	if (empty($availability)) {
							 		// если товара в product_size нет - товар на странице не отображается
							 		Orders::updateVisibilityProduct($value['id']);
							 	}
							} 					  
						}
				        // удаление товаров из корзины
				        unset($_SESSION['cart']);

				        // изменение флага для отображения пользователю конечного результата его заказа
				        $redirect = true;	  
			 		   
			 		  }else{
			 		  	$pdo->rollBack();
			 		  	$error[] = 'У нас возникли неполадки. Ваш заказ временно не может быть обработан!';
			 		  }
			 		}
				}	 		 
	  	    }

			if (!$redirect) {
	  	    	require_once ROOT . "/views/cart/checkout.php";
	  	    }else{
	  	    	require_once ROOT . "/views/cart/massege_order.php";
	  	    }
	  	    
		}else{	 
			require_once ROOT . "/views/account/entrance.php";
	    }
	}
}
?>