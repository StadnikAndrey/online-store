<?php
class OfertaController  {	 	
	// переход по 'оферта' в футере
	public static function actionIndex() {
		$title_head = "Shoptest: договор публичной оферты";
		$description_head = "Правовая информация по заключению коммерческих сделок интернет-магазина кроссовок Shoptest.";
		$page = 'oferta';
		$menu = CoreController::getMainMenu();
		$info = Oferta::getInformOferta();
		// поиск по сайту
		if (isset($_POST['srch'])) {
			$result = Search::getResultSearch($_POST);			 
			if (!empty($result)) {
				header("location: /{$result[0]['link']}");
			}			 
	    }		 
        require_once ROOT . "/views/oferta/index.php";		 
        }	 
}
?>