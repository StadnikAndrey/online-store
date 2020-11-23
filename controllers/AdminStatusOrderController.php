<?php 
class AdminStatusOrderController {
	// переход по "Управление статусами заказов"	 	 
	public static function actionIndex() {
		if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
			$name_page = 'statusOrder';
			$menu = CoreController::getMainMenu();
			$statuses = AdminProducts::getAdminFormFilter('order_statuses');

			// поиск по сайту
			if (isset($_POST['srch'])) {
				$result = Search::getResultSearch($_POST);			 
				if (!empty($result)) {
					header("location: /{$result[0]['link']}");
				}			 
		    }
			  
	        require_once ROOT . "/views/admin/admin_status_order.php";
		}
		 		 
    }

    // добавление статуса
    public static function actionInsertStatusOrder() {
    	if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
	    	$name_page = 'statusOrder';
			$menu = CoreController::getMainMenu();
			if (isset($_POST['adm_insert_order_status_submit'])) {
				 $error = [];
				// массив данных для odrer_statuses
				$data_order_statuses = [];		 		 
				// название статуса
				if (!empty(trim($_POST['adm_ins_o_st_name'])) && mb_strlen($_POST['adm_ins_o_st_name'])<50) {
					$data_order_statuses['name'] = htmlentities(trim($_POST['adm_ins_o_st_name']), ENT_QUOTES) ;
				}else{
					$error[] = 'Введите название статуса!';
				}

				if (empty($error)) {
					// проверка на наличие добавляемого статуса
				    $check_order_status = AdminStatusOrder::getStatusForParameter('name',trim($_POST['adm_ins_o_st_name']));			    
				    if (empty($check_order_status)) {
				    	$new_order_status = AdminProducts::insertDataTable($data_order_statuses, 'order_statuses');
						if ($new_order_status != 0) {
							$success = 'Новый статус успешно добавлен!';
						}
				    }else{
					 	$error[] = 'Такой статус уже существует!';
				    }
				}

			}

			// поиск по сайту
			if (isset($_POST['srch'])) {
				$result = Search::getResultSearch($_POST);			 
				if (!empty($result)) {
					header("location: /{$result[0]['link']}");
				}			 
		    }

			require_once ROOT . "/views/admin/admin_status_order_insert.php";
    	}
    	 

    }

    // редактирование статуса
    public static function actionUpdateStatusOrder($id_status_order){
    	if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
	    	$name_page = 'statusOrder';
			$menu = CoreController::getMainMenu();
			$oder_status = AdminStatusOrder::getStatusForParameter('id',$id_status_order);
			if (isset($_POST['adm_update_order_status_submit'])) {
				 $error = [];
				// массив данных для oder_statuses
				$data_oder_statuses_up = [];		 		 
				// название статуса
				if (!empty(trim($_POST['adm_up_order_status_name'])) && mb_strlen($_POST['adm_up_order_status_name'])<50) {
					$data_oder_statuses_up['name'] = htmlentities(trim($_POST['adm_up_order_status_name']), ENT_QUOTES) ;
				}else{
					$error[] = 'Введите правильное название статуса заказа!';
				}

				if (empty($error)) {
					global $pdo; 
					$pdo->beginTransaction();
					// редактирование статуса
					$oder_status_update = AdminProducts::updateDataTable($data_oder_statuses_up, 'order_statuses', $id_status_order);
					// проверка на наличие статуса введенного в форму
				    $check_or_st_up =  AdminStatusOrder::getStatusForParameter('name',trim($_POST['adm_up_order_status_name']));
				    if (count($check_or_st_up)==1) {
				    	$pdo->commit();
				    	$success = 'Изменения внесены успешно!';
				    	$oder_status = AdminStatusOrder::getStatusForParameter('id',$id_status_order);
				    }else{
				    	$pdo->rollBack();
				    	$error[] = 'Такой статус уже существует!';
				    }			   
				}

			}

			// поиск по сайту
			if (isset($_POST['srch'])) {
				$result = Search::getResultSearch($_POST);			 
				if (!empty($result)) {
					header("location: /{$result[0]['link']}");
				}			 
		    }

			require_once ROOT . "/views/admin/admin_status_order_update.php";
    	}
    	 

    }

}
?>