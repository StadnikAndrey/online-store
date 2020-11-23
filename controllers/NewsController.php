<?php 
class NewsController{
	public static $page = 'news';	 
	public static function actionIndex() {
		$title_head = "Shoptest: раздел новости";
		$description_head = "Читайте о новых моделях кроссовок, тенденциях кроссовочной моды, активности брендов в блоге магазина Shoptest";
		$menu = CoreController::getMainMenu();
		// получение первой страницы новостей
		// (остальные новости подгрузятся при скролле)		 
		$news = News::getNews($_POST);
		// поиск по сайту
		if (isset($_POST['srch'])) {
			$result = Search::getResultSearch($_POST);			 
			if (!empty($result)) {
				header("location: /{$result[0]['link']}");
			}			 
	    }
        require_once ROOT . "/views/news/index.php";
        	 
    }

    // получение новостей для отображения на главной при прокрутке страницы
    // (постраничная навигация(бесконечный скролл, lazy load))
    public static function actionLazyLoad() {	 
    	if (isset($_POST['page_news'])&&!empty($_POST['page_news'])) {
    		$news = News::getNews($_POST);
    		 foreach ($news as $key => $unit) {
			echo  "<article class=\"news_unit\">
			<h1 class=\"news_unit_title\">
				<a href=\"/news/one/{$unit['id']}\" target=\"_blank\"   class=\"news_unit_title_link\">{$unit['title']}</a>
			</h1>
			<p class=\"news_unit_data\">{$unit['date']}</p>
			<p class=\"news_unit_subtitle\">{$unit['subtitle']}</p>
			<div class=\"news_unit_img_first\">
				<img src=\"/public/img_news/{$unit['img_first']}\" alt=\"{$unit['title']}\" >
			</div>
			<div><a href=\"/news/one/{$unit['id']}\" target=\"_blank\" class=\"news_unit_link_details\">Детальнее >></a></div>
			
		    </article>";
				} 
    	}		 
				           	  
    }

    // одна новость
    public static function actionOneUnit($id_news) {
		$menu = CoreController::getMainMenu();
		$one_news = News::getOneNews($id_news);	
		$title_head = $one_news['title'];
		$description_head = $one_news['subtitle'];

		// поиск по сайту
		if (isset($_POST['srch'])) {
			$result = Search::getResultSearch($_POST);			 
			if (!empty($result)) {
				header("location: /{$result[0]['link']}");
			}			 
	    }
		 	 
        require_once ROOT . "/views/news/news_one.php";		 
    }
}
?>