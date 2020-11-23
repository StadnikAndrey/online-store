<?php 
class AdminOrders{
	public static $table = 'orders';
	public static $product_size = 'product_size';
	public static $products = 'products';
	public static $order_statuses = 'order_statuses';
	public static $users = 'users';

	// получение   заказов  по номеру или дате
	public static function getAllOrders($post,$quantityOrdersPage){
		global $pdo;
		if (isset($post['adm_ord_search_num']) && preg_match('/^[^\s]{1,999}$/iu', trim($_POST['adm_ord_search_num']) 
			 )){
			$num = " AND id = :id ";
			$date_add = '';
		}elseif (isset($post['adm_ord_search_date']) && preg_match('/^[^\s]{1,999}$/iu', trim($_POST['adm_ord_search_date']) 
			 )) {
			$date = trim($post['adm_ord_search_date']);
			$date_add = " AND date_add LIKE '$date%' ";
			$num = '';
		}else{
			$num = "";
			$date_add = "";
		}	 

		// постраничная навигация
	    if (isset($post['page'])&&!empty($post['page'])) {
	   		$start = ((int)($post['page'][0]) - 1)*$quantityOrdersPage;		   	 
	    }else{
	   		$start = 0;
	    } 	 

		if (!empty($num) || !empty($date_add)) {
			$query = "SELECT * FROM " . self::$table . " WHERE date_add {$num} {$date_add} ORDER BY date_add DESC LIMIT {$start},{$quantityOrdersPage}";
			$q = $pdo->prepare($query);

			if (isset($post['adm_ord_search_num']) && preg_match('/^[^\s]{1,999}$/iu', trim($_POST['adm_ord_search_num']) 
			 )) {
				$q->bindValue(':id', trim((int)$post['adm_ord_search_num']));
			} 
		 
			$q->execute();
			$orders = $q->fetchAll();
			// информация о товарах каждого заказа,
			// статусе заказа,
			// о пользователе
		 	for ($i=0; $i <count($orders) ; $i++) { 
		 	  	$orders[$i]['PRODUCT'] = self::getProductsOrder(json_decode($orders[$i]['products'], true));
		 	  	$orders[$i]['status'] = self::getOrderStatus($orders[$i]['status_id']);
		 	  	$orders[$i]['user'] = self::getUserId($orders[$i]['id_user']);
		 	}			 
		 
			return $orders;
		}
		 
	}

	// получение количества  заказов    для пагинации
	public static function getQuantityOders($post){
		global $pdo;
		if (isset($post['adm_ord_search_num']) && preg_match('/^[^\s]{1,999}$/iu', trim($_POST['adm_ord_search_num']) 
			 )) {
			$num = " AND id = :id ";
			$date_add = '';
		}elseif (isset($post['adm_ord_search_date']) && preg_match('/^[^\s]{1,999}$/iu', trim($_POST['adm_ord_search_date']) 
			 )) {
			$date = trim($post['adm_ord_search_date']);
			$date_add = " AND date_add LIKE '$date%' ";
			$num = '';
		}else{
			$num = "";
			$date_add = "";
		}		 

		if (!empty($num) || !empty($date_add)) {
			$query = "SELECT COUNT(id) AS quantity  FROM " . self::$table . " WHERE date_add {$num} {$date_add} ORDER BY date_add DESC ";
			$q = $pdo->prepare($query);
			if (isset($post['adm_ord_search_num']) && preg_match('/^[^\s]{1,999}$/iu', trim($_POST['adm_ord_search_num']) 
			 )) {
				$q->bindValue(':id', trim((int)$post['adm_ord_search_num']));
			} 
		 
			 		 
			$q->execute();
			$orders = $q->fetch();

			return $orders['quantity'];
			 
		}
		 
	}

	// // получение информации о товарах 1 заказа
	  public static function getProductsOrder($arr){
	  	  global $pdo;
	 	if (isset($arr) && !empty($arr)) {
	 		// получение инф. о товарах в виде 2-х уровневого массива 
	 		$products = [];
	 		foreach ($arr as $key => $value) {
	 			$products[] = Products::getById($value['id']);
	 	    }
	 		// получение названия размера и добавление к $products
	  		$size = [];
	  		foreach ($arr as $key => $value) {
	 		 	$size[] = Products::getBySizeId($value['size']);
	 		} 
	  		for ($i=0; $i < count($products) ; $i++) {				 
	 			$products[$i]['size'] = $size[$i]['name'];			 	  			 	 
	  		 }		 
	 	    // добавление количества товаров в $products
	  		 $count = [];
	 		 foreach ($arr as $key => $value) {
	  		 	$count[] = $value['count'];
	 		 }
	  		 for ($i=0; $i < count($products) ; $i++) {					 
	 			$products[$i]['count'] = $count[$i]; 			 	 	  			 	 
	  		 }
	  		 // добавление цены 1 товара в $products
	  		 foreach ($arr as $key => $value) {
		  		 	if (isset($value['price_one'])) {
		  		 		$price_one[] = $value['price_one'];
		  		 	}	  		 		 
	  		 	}			 	 
	  		 
	 		 for ($i=0; $i < count($products) ; $i++) {	
	  			 if (isset($price_one[$i])) {
	  			 	$products[$i]['price_one'] = $price_one[$i];
	  		 	 }				  			 	 	  			 	 
	  		 }	

	  		return $products;	 
	  	}	 
	}	 

	// // получение информации по 1 статусу заказа
	  public static function getOrderStatus($status_id){
	  	global $pdo;
	  	$query = "SELECT * FROM " . self::$order_statuses . " WHERE id  = :status_id ";
	  	$q = $pdo->prepare($query);
	  	$q->bindValue(':status_id', $status_id);
	  	$q->execute();
	  	return $status = $q->fetch();
	  }

	   // получение информации по 1   заказу
	  public static function getOrderId($id_order){
	  	global $pdo;
	  	$query = "SELECT * FROM " . self::$table . " WHERE id  = :id_order ";
	  	$q = $pdo->prepare($query);
	  	$q->bindValue(':id_order', $id_order);
	  	$q->execute();
	  	return $status = $q->fetch();
	  }

	  // // получение всей информации из таблицы статусов заказа
	  public static function getOrderStatusAll(){
	  	global $pdo;
	  	$query = "SELECT * FROM " . self::$order_statuses ;
	  	$q = $pdo->query($query);
		return $statuses = $q->fetchAll();	  	 
	  }

	  // // получение информации из таблицы пользователей
	  public static function getUserId($user_id){
	  	global $pdo;
	  	$query = "SELECT * FROM " . self::$users . " WHERE id  = :user_id ";
	  	$q = $pdo->prepare($query);
	  	$q->bindValue(':user_id', $user_id);
	  	$q->execute();
	  	return $status = $q->fetch();
	  }

	// изменение данных в любой таблице 
	public static function updateDataTable($data, $table, $id) {
		global $pdo;		 
 		if (isset($data)&&!empty($data)) {  
			$query = "UPDATE $table SET ";

			foreach ($data as $field => $value) {
				$query .= $field . ' = :' . $field . ', ';
			}
			 
			$query = substr($query, 0, -2);			 
			$query .= " WHERE id=$id ";
			
			$q = $pdo->prepare($query);

			foreach ($data as $field => $value) {
				$q->bindValue(':' . $field, $value);
			}

			return $q->execute();
	    }
	}

}
?>