<?php
class MainController extends CoreController{
	public static $page = 'main';
	// главная страница	 
	public static function actionIndex() {
		$menu = CoreController::getMainMenu();	 
		$slider = Slider::getSlider(10);		 
		$cards = Cards::getCards();
		$news = News::getNewsForMain();
		// поиск по сайту
		if (isset($_POST['srch'])) {
			$result = Search::getResultSearch($_POST);			 
			if (!empty($result)) {
				header("location: {$result[0]['link']}");
			}			 
	    }
		 
        require_once ROOT . "/views/main_page/index.php";		 
    }

    public static function actionRobots(){
    	require_once ROOT . "/robots.php";
    }

    public static function actionSitemap(){
    	header('Content-type: text/xml');
		header('Content-type: application/xhtml+xml');
		header('Content-type: application/xml');
 
    	require_once ROOT . "/sitemap.php";
    }

     
	 
}
?>