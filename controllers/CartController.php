<?php 
class CartController{
	// добавление товаров в корзину и вывод количества товаров
	public static function actionAddProduct(){
		if(isset($_POST['one_product_id']) && !empty($_POST['one_product_id'])&&
			isset($_POST['one_product_size']) && !empty($_POST['one_product_size'])) {
			$quantity = Products::getCountProductSize($_POST['one_product_id'], $_POST['one_product_size']);
		    $key =  $_POST['one_product_id'] .'-'. $_POST['one_product_size'];
		    if ($quantity['products_count'] > 0) {
		    	if(!isset($_SESSION['cart'][$key] ) || (int)$_SESSION['cart'][$key]['count'] < $quantity['products_count']){
		    	Products::addToCart($_POST) ;
		    	$total_products = Products::getCartCount();
	            echo $total_products;
	            exit;
		    }else{
		    	echo 'warning';
		    }
		    }
		     
		} 	  
		   
	}

	// страница корзины
	public static function actionIndex(){
		$menu = CoreController::getMainMenu();
		$cartProducts = Products::getCartProducts();
		// общая стоимость 
		$cost = 0;
		if (isset($cartProducts) && !empty($cartProducts)) {
			foreach ($cartProducts as $key => $value) {
			$cost += $value['count'] * $value['price'];
		}
		}
		 
		// поиск по сайту
		if (isset($_POST['srch'])) {
			$result = Search::getResultSearch($_POST);			 
			if (!empty($result)) {
				header("location: /{$result[0]['link']}");
			}			 
	    }

		require_once ROOT . "/views/cart/index.php";
	}

	// удаление товаров из корзины
	public static function actionDelete(){
		if(isset($_POST['key']) && !empty($_POST['key']))	{
		   unset($_SESSION['cart'][$_POST['key']]);
		}		  
		echo 1;
		exit; 
	}

	// изменение количества товаров корзины
	public static function actionUpdate(){	  
		if (isset($_POST['key_up']) && !empty($_POST['key_up']) &&
			isset($_POST['count_up']) && !empty($_POST['count_up']) && is_numeric($_POST['count_up'])) {			 
		 $count = Products::getCountProductSize($_SESSION['cart'][$_POST['key_up']]['id'], $_SESSION['cart'][$_POST['key_up']]['size']);
		if (  $_POST['count_up']  <=  $count['products_count']) {
			$_SESSION['cart'][$_POST['key_up']]['count'] = $_POST['count_up'];			 
			 echo 1;
			 exit;			 
		}else{			 
			echo $count['products_count'];
		    exit;
		}		 
		}
	}

	 
}

?>