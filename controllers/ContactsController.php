<?php
class ContactsController  {
	public static $page = 'contacts';	
	// переход по 'Контакты' на главной 
	public static function actionIndex() {
		$title_head = "Shoptest: контакты магазина";
		$description_head = "Свяжитесь с Shoptest по вопросам сотрудничества или оставьте отзыв";
		$menu = CoreController::getMainMenu();
		$info = Contacts::getContacts();
		// поиск по сайту
		if (isset($_POST['srch'])) {
			$result = Search::getResultSearch($_POST);			 
			if (!empty($result)) {
				header("location: /{$result[0]['link']}");
			}			 
	    }
		 		 
        require_once ROOT . "/views/contacts/index.php";		 
        }	 
}
?>