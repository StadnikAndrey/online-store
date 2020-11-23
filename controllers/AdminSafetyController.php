<?php
class AdminSafetyController  {
	 
	// переход по 'Безопасность' в админпанели
	public static function actionUpdateSafety() {
		if (isset($_SESSION['user']) && $_SESSION['user']['super_admin']==1 && $_SESSION['user']['is_ban']==0) {
			$name_page = 'safety';
			$menu = CoreController::getMainMenu();
		    $info = Safety::getInform();	
		    if (isset($_POST['adm_safety_up_submit'])) {
		    	 	 $error = [];
                     // массив данных для редактирования политики безопасности
                     $data_safety_up = [];                     

	                 				 
					$data_safety_up['text'] = nl2br(trim($_POST['adm_safety_txt']),false) ;
					                     
                    if (Safety::updateDataTable($data_safety_up, 'safety', $info['id'])) {
                        $info = Safety::getInform();
                        $success = 'Изменения внесены!';
                    }else{
                        $error[] = 'Изменение политики безопасности компании временно не доступно!';
                    }
                    	
		    }	 

		    // поиск по сайту
			if (isset($_POST['srch'])) {
				$result = Search::getResultSearch($_POST);			 
				if (!empty($result)) {
					header("location: /{$result[0]['link']}");
				}			 
		    }
	    
            require_once ROOT . "/views/admin/admin_safety_update.php";
		}
		 		 
    }	 
}
?>