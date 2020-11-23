<?php 
class Email{
	// письмо с информацией о заказе менеджеру
	public static function managerLetterOrder($getOrder,$productsOrder,$quantityOrder,$costOrder){
		if (isset($getOrder)) {
			$message = " 
				<html>
				 <head>
				  <title>письмо с заказом менеджеру</title>
				     
				 </head>
				 <body> 
				  <table style='width: 100%; max-width:600px; margin:0; padding:0;' border='0' cellpadding='0' cellspacing='0'>
				  	<tbody>
				  	<tr>
				  		<td> 
  		         <center> 			 
  			 <table border='0' cellpadding='0' cellspacing='0'>
  			 	<tbody>
  			 		<tr>  			 			 
  			 			<td style='padding: 10px; font-family: Arial, Helvetica, sans-serif; font-size: 25px;font-weight: bolder; '>Заказ №{$getOrder['id']}</td>
  			 		</tr>
  			 	</tbody>
  			 </table>
  			 </center>
  			 <table border='0' cellpadding='0' cellspacing='0'>
  			 	<tbody>
  			 		<tr>
  			 			<td style='padding: 10px 10px 10px 5px;font-family: Arial, Helvetica, sans-serif; font-size: 22px;font-weight: bold;'>Контактные данные клиента:</td>
  			 		</tr>
  			 	</tbody>
  			 </table>
  			 <table border='0' cellpadding='0' cellspacing='0'>
  			 	<tbody>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Фамилия:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$getOrder['surname']}</td>
  			 		</tr>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Имя:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$getOrder['name']}</td>
  			 		</tr>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Отчество:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$getOrder['patronymic']} </td>
  			 		</tr>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Телефон:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$getOrder['mobile_number']}</td>
  			 		</tr>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>E-mail:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$getOrder['email']}</td>
  			 		</tr>
  			 	</tbody>
  			 </table>

  			 <table border='0' cellpadding='0' cellspacing='0'>
  			 	<tbody>
  			 		<tr>
  			 			<td style='padding: 10px 10px 10px 5px;font-family: Arial, Helvetica, sans-serif; font-size: 22px;font-weight: bold;'>Доставка:</td>
  			 		</tr>
  			 	</tbody>
  			 </table>
  			 <table border='0' cellpadding='0' cellspacing='0'>
  			 	<tbody>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Город:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$getOrder['city']}</td>
  			 		</tr>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Область:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$getOrder['region']}</td>
  			 		</tr>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Район:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$getOrder['district']}</td>
  			 		</tr>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Служба доставки:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$getOrder['delivery_service']}</td>
  			 		</tr>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Способ доставки:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$getOrder['delivery_method']}</td>
  			 		</tr>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>№ отделения (адрес):</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$getOrder['post_office_number']} {$getOrder['street']} {$getOrder['house_number']}  {$getOrder['apartment_number']}</td>
  			 		</tr>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Оплата:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$getOrder['checkout_payment']}</td>
  			 		</tr>
  			 	</tbody>
  			 </table>";
  			 if (!empty($getOrder['comment'])) {
  			 	$message .= "<table border='0' cellpadding='0' cellspacing='0'>
  			 	<tbody>
  			 		<tr>
  			 			<td style='padding: 10px 10px 10px 5px;font-family: Arial, Helvetica, sans-serif; font-size: 22px;font-weight: bold;'>Комментарий:</td>
  			 		</tr>
  			 	</tbody>
  			 </table>
  			 <table border='0' cellpadding='0' cellspacing='0'>
  			 	<tbody>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$getOrder['comment']}</td>	 
  			 		</tr>  			 		 
  			 	</tbody>
  			 </table>";
  			 }
			$message .= "<table border='0' cellpadding='0' cellspacing='0'>
  			 	<tbody>
  			 		<tr>
  			 			<td style='padding: 10px 10px 10px 5px;font-family: Arial, Helvetica, sans-serif; font-size: 22px;font-weight: bold;'>Товары:</td>
  			 		</tr>
  			 	</tbody>
  			 </table>";
  			foreach ($productsOrder as $key => $product) {
  			 	$message .= " <table border='0' cellpadding='0' cellspacing='0'>
  			 	<tbody>
            <tr>
              <td style='padding: 5px;'><img src='http://shoptest.kl.com.ua/public/img_products/";


              $message .= stristr($product['img'], ',', true) ;
                $message .= "' alt='' style='width: 150px;'></td>               
            </tr>  			 		 
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Название:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$product['name']}</td>
  			 		</tr>  			 		 
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Модель:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$product['model']}</td>
  			 		</tr>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Артикул:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$product['code']} </td>
  			 		</tr>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Размер:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$product['size']}</td>
  			 		</tr>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Количество:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$product['count']} шт.</td>
  			 		</tr>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Стоимость:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>";

  			 			 $message .= $product['count'] * $product['price'];
  			 			    
  			 			  $message .= "грн.</td>
  			 		</tr>
  			 	</tbody>
  			 </table>
  			 <table border='0' cellpadding='0' cellspacing='0'>
  			 	<tbody>
  			 	<tr>
  			 		<td style='padding: 5px;'></td>  			 			 
  			 	</tr>   
  			 	</tbody>
  			 </table>";
  			 } 
  			$message .= " <table border='0' cellpadding='0' cellspacing='0'>
  			 	<tbody>
  			 		<tr>
  			 			<td style='padding: 10px 10px 10px 5px;font-family: Arial, Helvetica, sans-serif; font-size: 22px;font-weight: bold;'>Итого:</td>
  			 		</tr>
  			 	</tbody>
  			 </table>
  			 <table border='0' cellpadding='0' cellspacing='0'>
  			 	<tbody>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Количество товаров:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$quantityOrder}</td>
  			 		</tr>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Доставка:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>бесплатно</td>
  			 		</tr>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>К оплате:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$costOrder} грн.</td>
  			 		</tr>
  			 		 
  			 	</tbody>
  			 </table>
  			  
		  		</td>
		  	</tr>	
		  	</tbody>
		  </table>
		 </body> 
		  </html>";
		}		   
		return $message;
	}

	// письмо о подтверждении заказа клиенту
	public static function userLetterOrder($getOrder,$productsOrder,$quantityOrder,$costOrder){
		if (isset($getOrder)) {
			$message = " 
					<html>
					<head>
					<title>письмо пользователю о принятии заказа</title>
					  
					</head>
					<body> 
					<table style='width: 100%; max-width:600px; margin:0; padding:0;' border='0' cellpadding='0' cellspacing='0'>
					<tbody>
					<tr>
  					<td> 
  	 		 
  			 		<table border='0' cellpadding='0' cellspacing='0'>
  			 		<tbody>
  			 		 
            <tr>               
              <td style='padding: 10px;'></td>
            </tr>
            <tr style='text-align: center;'>
              <td style='padding: 10px 10px 10px 5px;font-family: Arial, Helvetica, sans-serif; font-size: 22px;font-weight: bold;'>Спасибо за то, что выбрали наш магазин!</td>
            </tr>            
  			 	</tbody>
  			 </table>
  			 
  			 <table border='0' cellpadding='0' cellspacing='0'>
  			 	<tbody>
  			 		<tr>
              <td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Номер вашего заказа:</td>
              <td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$getOrder['id']}</td>
            </tr>
  			 	</tbody>
  			 </table>
  			 <table border='0' cellpadding='0' cellspacing='0'>
  			 	<tbody>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 22px;font-weight: bold;'>Вы выбрали:</td>  			 			 
  			 		</tr>  			 		 
  			 	</tbody>
  			 </table>";

  			  
  			 foreach ($productsOrder as $key => $product) {
  			  $message .= "<table border='0' cellpadding='0' cellspacing='0'>
  			 	<tbody> 
             <tr>
              <td style='padding: 5px;'><img src='http://shoptest.kl.com.ua/public/img_products/";

              $message .= stristr($product['img'], ',', true);

              $message .="' alt='' style='width: 150px;'></td>               
            </tr>  			 		 
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Название:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$product['name']}</td>
  			 		</tr>  			 		 
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Модель:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$product['model']}</td>
  			 		</tr>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Артикул:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$product['code']}</td>
  			 		</tr>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Размер:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$product['size']}</td>
  			 		</tr>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Количество:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$product['count']} шт.</td>
  			 		</tr>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Стоимость:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>";

  			 			$message .= $product['count'] * $product['price'];
  			 			$message .= "грн.</td>
  			 		</tr>
  			 	</tbody>
  			 </table>
  			 <table border='0' cellpadding='0' cellspacing='0'>
  			 	<tbody>
  			 	<tr>
  			 		<td style='padding: 5px;'></td>  			 			 
  			 	</tr>   
  			 	</tbody>
  			 </table>";
				} 
  			 $message .= "<table border='0' cellpadding='0' cellspacing='0'>
  			 	<tbody>
  			 		<tr>
  			 			<td style='padding: 10px 10px 10px 5px;font-family: Arial, Helvetica, sans-serif; font-size: 22px;font-weight: bold;'>Итого:</td>
  			 		</tr>
  			 	</tbody>
  			 </table>
  			 <table border='0' cellpadding='0' cellspacing='0'>
  			 	<tbody>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Количество товаров:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$quantityOrder}</td>
  			 		</tr>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>Доставка:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>бесплатно</td>
  			 		</tr>
  			 		<tr>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>К оплате:</td>
  			 			<td style='padding: 5px;font-family: Arial, Helvetica, sans-serif; font-size: 20px;'>{$costOrder} грн.</td>
  			 		</tr>
  			 		 
  			 	</tbody>
  			 </table>

  			  
  		</td>
  	</tr>	
  	</tbody>
  </table>
 </body> 
</html>
";
		}
		return $message;
	}
}
?>
