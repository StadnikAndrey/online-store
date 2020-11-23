<?php
 class AdminUsers{
	public static $table = 'users';
	public static $orders = 'orders';
	public static $order_statuses = 'order_statuses';

	// получение всех пользователей используя поиск	 
	public static function getAllUsers($post,$quantityOrdersPage){
		global $pdo;
		if (isset($post['adm_users_search']) 
			&& preg_match('/^.{1,50}$/iu', trim($post['adm_users_search']) )){
			$search  = htmlspecialchars(trim($post['adm_users_search']));			 	 
		    }else{
		    	$search = '';
		    }
		    // постраничная навигация
		    if (isset($post['page'])&&!empty($post['page'])) {
		   		$start = ((int)($post['page'][0]) - 1)*$quantityOrdersPage;		   	 
		    }else{
		   		$start = 0;
		    } 	 
		 
			$query = "SELECT * FROM " . self::$table . " WHERE id LIKE '$search%' 			 
			OR surname LIKE '$search%' 
			OR date_of_birth LIKE '$search%' 
			OR mobile_number LIKE '$search%' 
			OR email LIKE '$search%' ORDER BY date_add DESC LIMIT {$start},{$quantityOrdersPage} ";
			 
		 
			$q = $pdo->query($query);	
			$users = $q->fetchAll();			 	 
		 
			return $users;
	 
	}

	// количество пользователей для постраничной навигации
	public static function getQuantityUsers($post){
		global $pdo;
		if (isset($post['adm_users_search']) 
			&& preg_match('/^.{1,50}$/iu', trim($post['adm_users_search']) )){
			$search  = htmlspecialchars(trim($post['adm_users_search']));			 	 
		    }else{
		    	$search = '';
		    }		      
		 
			$query = "SELECT COUNT(id) AS quantity FROM " . self::$table . " WHERE id LIKE '$search%' 			 
			OR surname LIKE '$search%' 
			OR date_of_birth LIKE '$search%' 
			OR mobile_number LIKE '$search%' 
			OR email LIKE '$search%' ";			 
		 
			$q = $pdo->query($query);	
			$users = $q->fetch();			 	 
		 
			return $users['quantity'];
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

	  // получение информации из таблицы пользователей
	  public static function getUserId($user_id){
	  	global $pdo;
	  	$query = "SELECT * FROM " . self::$table . " WHERE id  = :user_id ";
	  	$q = $pdo->prepare($query);
	  	$q->bindValue(':user_id', $user_id);
	  	$q->execute();
	  	return $status = $q->fetch();
	  }

	  // получение всех администраторов сайта
	  public static function getAllAdmin($post){
	  	global $pdo;
	  	 
		if (isset($post['adm_users_search'])&& preg_match('/^.{1,50}$/iu', trim($post['adm_users_search']) )){
			$search  = htmlspecialchars(trim($post['adm_users_search']));			 	 
		    }else{
		    	$search  = '';
		    } 
		 
			$query = "SELECT * FROM " . self::$table . " WHERE admin=1 AND surname LIKE '$search%' ORDER BY date_add DESC ";
			 
		 
			$q = $pdo->query($query);	
			$users = $q->fetchAll();			 	 
		 
			return $users;
	  }

	  // ЗАКАЗЫ ПОЛЬЗОВАТЕЛЯ:
	  // получение   заказов  по номеру или дате
	public static function getAllOrders($post,$id_user){
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
		 
			$query = "SELECT * FROM " . self::$orders . " WHERE id_user = :id_user {$num} {$date_add} ORDER BY date_add DESC ";
			$q = $pdo->prepare($query);
			$q->bindValue(':id_user', $id_user);
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

}
?>