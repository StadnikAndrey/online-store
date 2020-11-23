<?php 
class AdminSubcategoryController{
	// переход по "Управление субкатегориями"
	public static function actionIndex() {
		if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
			$name_page = 'subcategory';
			$menu = CoreController::getMainMenu();
			$subcategorys = AdminProducts::getAdminFormFilter('subcategory');

			// поиск по сайту
			if (isset($_POST['srch'])) {
				$result = Search::getResultSearch($_POST);			 
				if (!empty($result)) {
					header("location: /{$result[0]['link']}");
				}			 
		    }
			 
	        require_once ROOT . "/views/admin/admin_subcategory.php";
		}
		 		 
    }

    // добавление субкатегории товара
    public static function actionInsertSubcategory() {
    	if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
	    	$name_page = 'subcategory';
			$menu = CoreController::getMainMenu();
			if (isset($_POST['admin_insert_subcat_submit'])) {
				$error = [];
				// массив данных для subcategory
				$data_subcat = [];		 		 
				// название бренда
				if (!empty(trim($_POST['adm_ins_subcat_name'])) && mb_strlen($_POST['adm_ins_subcat_name'])<50) {
					$data_subcat['name'] = htmlentities(trim($_POST['adm_ins_subcat_name']), ENT_QUOTES) ;
				}else{
					$error[] = 'Введите название субкатегории!';
				}

				if (empty($error)) {
					// проверка на наличие добавляемой субкатегории
				    $check_subcat = AdminSubcategory::getSubcategoryForParameter('name',trim($_POST['adm_ins_subcat_name']));			    
				    if (empty($check_subcat)) {
				    	$new_subcat = AdminProducts::insertDataTable($data_subcat, 'subcategory');
						if ($new_subcat != 0) {
							$success = 'Новая субкатегория успешно добавлена!';
						}
				    }else{
					 	$error[] = 'Такая субкатегория уже существует!';
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
			 
	        require_once ROOT . "/views/admin/admin_insert_subcategory.php";
    	}
		 		 
    }

    // редактирование субкатегории товара
    public static function actionUpdateSubcategory($id_subcategory) {
    	if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
	    	$name_page = 'subcategory';
			$menu = CoreController::getMainMenu();
			$subcat = AdminSubcategory::getSubcategoryForParameter('id', $id_subcategory);
			if (isset($_POST['admin_update_subcat_submit'])) {
				$error = [];
				// массив данных для subcategory
				$data_subcat_up = [];		 		 
				// название субкатегории
				if (!empty(trim($_POST['adm_up_subcat_name'])) && mb_strlen($_POST['adm_up_subcat_name'])<50) {
					$data_subcat_up['name'] = htmlentities(trim($_POST['adm_up_subcat_name']), ENT_QUOTES) ;
				}else{
					$error[] = 'Введите правильное название субкатегории!';
				}

				if (empty($error)) {
					global $pdo; 
					$pdo->beginTransaction();
					// редактирование субкатегории
					$subcat_update = AdminProducts::updateDataTable($data_subcat_up, 'subcategory', $id_subcategory);
					// проверка на наличие субкатегории введенной в форму
				    $check_subcat_up = AdminSubcategory::getSubcategoryForParameter('name',trim($_POST['adm_up_subcat_name']));
				    if (count($check_subcat_up)==1) {
				    	$pdo->commit();
				    	$success = 'Изменения внесены успешно!';
				    	$subcat = AdminSubcategory::getSubcategoryForParameter('id', $id_subcategory);
				    }else{
				    	$pdo->rollBack();
				    	$error[] = 'Такая субкатегория уже существует!';
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
			 
	        require_once ROOT . "/views/admin/admin_update_subcategory.php";	
    	}
		 	 
    }
}
?>