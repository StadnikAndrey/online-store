<?php
class AboutController  {
	public static $page = 'about';	
	// переход по 'О нас' на главной 
	public static function actionIndex() {
		$title_head = "О магазине Shoptest";
		     $description_head = "Узнайте больше информаци об интернет-магазине Shoptest";
		$menu = CoreController::getMainMenu();
		$info = About::getAbout();	
		// поиск по сайту
		if (isset($_POST['srch'])) {
			$result = Search::getResultSearch($_POST);			 
			if (!empty($result)) {
				header("location: /{$result[0]['link']}");
			}			 
	    }	 
        require_once ROOT . "/views/about/about.php";		 
        }	 
}
?>