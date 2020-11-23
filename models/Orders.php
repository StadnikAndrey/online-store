<?php 
class Orders{
	public static $table = 'orders';
	public static $product_size = 'product_size';
	public static $products = 'products';
	public static $order_statuses = 'order_statuses';
	// сохранение заказа в таблицу orders
	public static function saveOrder($order){
		global $pdo;		 
 		if (isset($order)&&!empty($order)) {  
			$query = "INSERT INTO " . self::$table . " SET ";

			foreach ($order as $field => $value) {
				$query .= $field . ' = :' . $field . ', ';
			}

			$query = substr($query, 0, -2);
			$query .= ";";
			
			$q = $pdo->prepare($query);

			foreach ($order as $field => $value) {
				$q->bindValue(':' . $field, $value);
			}

			return $q->execute();
			}
	}

	// получение информации о заказе сразу после добавления в orders
	public static function getOrder($id_user) {
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE id_user = :id_user ORDER BY date_add DESC  LIMIT 1";
		$q = $pdo->prepare($query);
		$q->bindValue(':id_user', $id_user);
		$q->execute();
		return $product = $q->fetch();
	}

	// получение информации о товарах 1 заказа
	public static function getProductsOrder($arr){
		// global $pdo;
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
			 $price_one = [];
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

	// уменьшение количества товара определенного размера в products_sizes
	public static function quantityReduction($products_count, $id_product, $id_size){
		global $pdo;
		$str = "UPDATE " . self::$product_size . " SET products_count = :products_count WHERE id_product=:id_product AND id_size=:id_size";
		$query = $pdo->prepare($str);
		$query->bindValue(':products_count', $products_count);
		$query->bindValue(':id_product', $id_product);
		$query->bindValue(':id_size', $id_size);
		$query->execute();
		return $query->rowCount();
	}

	// удаление строки товар-размер в products_sizes
	public static function deleteStr($id_product, $id_size){
		global $pdo;
		$str = "DELETE FROM " . self::$product_size . " WHERE id_product=:id_product AND id_size=:id_size AND products_count=0 ";
		$query = $pdo->prepare($str);
		$query->bindValue(':id_product', $id_product);
	    $query->bindValue(':id_size', $id_size);
		$query->execute(); 
		return $query->rowCount();
	}

	// поиск товара в product_size
	public static function searchProductId($id_product) {
		global $pdo;
		$query = "SELECT * FROM " . self::$product_size . " WHERE id_product = :id_product";
		$q = $pdo->prepare($query);
		$q->bindValue(':id_product', $id_product);
		$q->execute();
		return $product = $q->fetch();
	}

	// изменение visibility в products на 0 
	// (после того как заказаны все размеры товара и товар удален из product_size)
	public static function updateVisibilityProduct($id_product){
		global $pdo;
		$str = "UPDATE " . self::$products . " SET visibility = 0 WHERE id=:id ";
		$query = $pdo->prepare($str);		 
		$query->bindValue(':id', $id_product);		 
		$query->execute();
		return $query->rowCount();
	}

	// МЕТОДЫ ДЛЯ ЛИЧНОГО КАБИНЕТА:
	// получение всех заказов пользователя
	public static function getAllOrdersUser($id_user){
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE id_user = :id_user ORDER BY date_add DESC";
		$q = $pdo->prepare($query);
		$q->bindValue(':id_user', $id_user);
		$q->execute();
		$products = $q->fetchAll();
		// информация о товарах каждого заказа		 
	 	for ($i=0; $i <count($products) ; $i++) { 
	 	  	$products[$i]['PRODUCT'] = self::getProductsOrder(json_decode($products[$i]['products'], true));
	 	  	$products[$i]['status'] = self::getOrderStatus($products[$i]['status_id']);
	 	}			 
	 
		return $products;
	}

	// получение информации из таблицы статусов заказа
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