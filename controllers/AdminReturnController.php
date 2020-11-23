<?php
class AdminReturnController  {	 
	// переход по 'возврат' в админпанели
	public static function actionUpdateReturn() {
		if (isset($_SESSION['user']) && $_SESSION['user']['super_admin']==1 && $_SESSION['user']['is_ban']==0) {
			$name_page = 'return';
			$menu = CoreController::getMainMenu();
		    $info = Retur_n::getReturnInfo();	
		    if (isset($_POST['adm_return_up_submit'])) {
		    	 	 $error = [];
                     // массив данных для return_info
                     $data_return_up = [];                     

	                 				 
					$data_return_up['text'] = nl2br(trim($_POST['adm_return_txt']),false) ;
					                     
                    if (Retur_n::updateDataTable($data_return_up, 'return_info', $info['id'])) {
                        $info = Retur_n::getReturnInfo();
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
            require_once ROOT . "/views/admin/admin_return_update.php";
		}
		 		 
    }	 
}
?>