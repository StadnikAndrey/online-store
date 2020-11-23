<?php
class AdminOfertaController  {
	 
	// переход по 'оферта' в админпанели
	public static function actionUpdateOferta() {
		if (isset($_SESSION['user']) && $_SESSION['user']['super_admin']==1 && $_SESSION['user']['is_ban']==0) {
			$name_page = 'oferta';
			$menu = CoreController::getMainMenu();
		    $info = Oferta::getInformOferta();	
		    if (isset($_POST['adm_oferta_up_submit'])) {
		    	 	$error = [];
                    // массив данных для oferta
                    $data_oferta_up = [];

					$data_oferta_up['text'] = nl2br(trim($_POST['adm_oferta_txt']),false) ;
					                     
                    if (Oferta::updateDataTable($data_oferta_up, 'oferta', $info['id'])) {
                        $info = Oferta::getInformOferta();
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
		    
            require_once ROOT . "/views/admin/admin_oferta_update.php";
		}
		 		 
    }	 
}
?>