<?php 
class AdminSizeController{
	// переход по "Управление размерами"	 	 
	public static function actionIndex() {
		if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
			$name_page = 'size';
			$menu = CoreController::getMainMenu();
			$sizes = AdminProducts::getAdminFormFilter('sizes');
			// поиск по сайту
			if (isset($_POST['srch'])) {
				$result = Search::getResultSearch($_POST);			 
				if (!empty($result)) {
					header("location: /{$result[0]['link']}");
				}			 
		    }
			  
	        require_once ROOT . "/views/admin/admin_size.php";
		}
		 		 
    }

    // добавление размера
    public static function actionInsertSize() {
    	if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
	    	$name_page = 'size';
			$menu = CoreController::getMainMenu();
			if (isset($_POST['admin_insert_size_submit'])) {
				 $error = [];
				// массив данных для sizes
				$data_sizes = [];		 		 
				// название размера
				if (!empty(trim($_POST['adm_in_size_name'])) && mb_strlen($_POST['adm_in_size_name'])<50) {
					$data_sizes['name'] = htmlentities(trim($_POST['adm_in_size_name']), ENT_QUOTES) ;
				}else{
					$error[] = 'Введите название размера!';
				}

				if (empty($error)) {
					// проверка на наличие добавляемого размера
				    $check_size = AdminSizes::getSizeForParameter('name',trim($_POST['adm_in_size_name']));			    
				    if (empty($check_size)) {
				    	$new_size = AdminProducts::insertDataTable($data_sizes, 'sizes');
						if ($new_size != 0) {
							$success = 'Новый размер успешно добавлен!';
						}
				    }else{
					 	$error[] = 'Такой размер уже существует!';
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

			require_once ROOT . "/views/admin/admin_size_insert.php";
    	}
    	 

    }

    // редактирование размера
    public static function actionUpdateSize($id_size){
    	if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
	    	$name_page = 'size';
			$menu = CoreController::getMainMenu();
			$size = AdminSizes::getSizeForParameter('id',$id_size);
			if (isset($_POST['admin_update_size_submit'])) {
				 $error = [];
				// массив данных для sizes
				$data_sizes_up = [];		 		 
				// название размера
				if (!empty(trim($_POST['adm_up_size_name'])) && mb_strlen($_POST['adm_up_size_name'])<50) {
					$data_sizes_up['name'] = htmlentities(trim($_POST['adm_up_size_name']), ENT_QUOTES) ;
				}else{
					$error[] = 'Введите правильное название размера!';
				}

				if (empty($error)) {
					global $pdo; 
					$pdo->beginTransaction();
					// редактирование размера
					$brand_update = AdminProducts::updateDataTable($data_sizes_up, 'sizes', $id_size);
					// проверка на наличие размера введенного в форму
				    $check_size_up = AdminSizes::getSizeForParameter('name',trim($_POST['adm_up_size_name']));
				    if (count($check_size_up)==1) {
				    	$pdo->commit();
				    	$success = 'Изменения внесены успешно!';
				    	$size = AdminSizes::getSizeForParameter('id',$id_size);
				    }else{
				    	$pdo->rollBack();
				    	$error[] = 'Такой размер уже существует!';
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

			require_once ROOT . "/views/admin/admin_size_update.php";
    	}
    	 

    }



}

?>