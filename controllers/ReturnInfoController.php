<?php
class ReturnInfoController  {
	 	
	// переход по 'возврат' в футере 
	public static function actionIndex() {
		$title_head = "Shoptest: условия возврата";
		$description_head = "Вернуть кроссовки купленные в Shoptest вы можете ознакомившись с условиями возврата нашего магазина.";
		$page = 'return_info';
		$menu = CoreController::getMainMenu();
		$info = Retur_n::getReturnInfo();
		// поиск по сайту
		if (isset($_POST['srch'])) {
			$result = Search::getResultSearch($_POST);			 
			if (!empty($result)) {
				header("location: /{$result[0]['link']}");
			}			 
	    }		 
        require_once ROOT . "/views/return_info/index.php";		 
        }	 
}
?>