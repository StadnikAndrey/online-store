<?php
class DeliveryController  {
	 
	// переход по 'Условия доставки' на главной 
	public static function actionIndex() {
		$title_head = "Shoptest: условия доставки";
		$description_head = "Узнайте об условиях доставки интернет-магазина кроссовок Shoptest.";
		$page = 'delivery';
		$menu = CoreController::getMainMenu();
		$info = Delivery::getInfoDelivery();
		// поиск по сайту
		if (isset($_POST['srch'])) {
			$result = Search::getResultSearch($_POST);			 
			if (!empty($result)) {
				header("location: /{$result[0]['link']}");
			}			 
	    }		 
        require_once ROOT . "/views/delivery/delivery.php";		 
        }	 
}
?>