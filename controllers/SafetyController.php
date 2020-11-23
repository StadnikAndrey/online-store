<?php
class SafetyController  {	 	
	// переход по 'Безопасность' в футере
	public static function actionIndex() {
		$title_head = "Shoptest: политика конфиденциальности";
		$description_head = "Изучите политику конфиденциальности Shoptest.";
		$page = 'safety';
		$menu = CoreController::getMainMenu();
		$info = Safety::getInform();
		// поиск по сайту
		if (isset($_POST['srch'])) {
			$result = Search::getResultSearch($_POST);			 
			if (!empty($result)) {
				header("location: /{$result[0]['link']}");
			}			 
	    }		 
        require_once ROOT . "/views/safety/index.php";		 
        }	 
}
?>