<?php 
class CoreController {
	public static function getMainMenu() {
		$menu = array(			 
			array(
				'text' => 'Men',
				'href' => '/products/1',
				'page' => 'men'
				),
			array(
				'text' => 'Woman',
				'href' => '/products/2',
				'page' => 'woman'
				),
			array(
				'text' => 'О нас',
				'href' => '/about',
				'page' => 'about'
				),
			array(
				'text' => 'Новости',
				'href' => '/news',
				'page' => 'news'
				),
			array(
				'text' => 'Контакты',
				'href' => '/contacts',
				'page' => 'contacts'
				),

		);
		return $menu;
	}	
}
?>