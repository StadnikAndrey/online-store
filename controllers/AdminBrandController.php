<?php 
class AdminBrandController  {
	// переход по "Управление брендами"	 	 
	public static function actionIndex() {
		if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0) {
			$name_page = 'brand';
			$menu = CoreController::getMainMenu();
			$brands = AdminProducts::getAdminFormFilter('brands');
			// поиск по сайту
			if (isset($_POST['srch'])) {
				$result = Search::getResultSearch($_POST);			 
				if (!empty($result)) {
					header("location: /{$result[0]['link']}");
				}			 
		    }		 
	        require_once ROOT . "/views/admin/admin_brands.php";
		}
		 		 
    }

    // добавление бренда
    public static function actionAddBrand() {
    	if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0) {
    		$name_page = 'brand';
			$menu = CoreController::getMainMenu();
			if (isset($_POST['admin_insert_brand_submit'])) {
				$error = [];
				// массив данных для brands
				$data_brands = [];		 		 
				// название бренда
				if (!empty(trim($_POST['adm_ins_brand_name'])) && mb_strlen($_POST['adm_ins_brand_name'])<50) {
					$data_brands['name'] = htmlentities(trim($_POST['adm_ins_brand_name']), ENT_QUOTES) ;
				}else{
					$error[] = 'Введите название бренда!';
				}	 

				if (empty($error)) {
					// проверка на наличие добавляемого бренда
				    $check_brand = AdminBrands::getBrandForParameter('name',trim($_POST['adm_ins_brand_name']));			    
				    if (empty($check_brand)) {
				    	$new_brand = AdminProducts::insertDataTable($data_brands, 'brands');
						if ($new_brand != 0) {
							$success = 'Новый бренд успешно добавлен!';
						}
				    }else{
					 	$error[] = 'Такой бренд уже существует!';
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
		 		 
        require_once ROOT . "/views/admin/admin_insert_brand.php";	
    	}
		 	 
    }

    // редактирование бренда
    public static function actionUpdateBrand($id_brand) {
    	if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0) {
	    	$name_page = 'brand';
			$menu = CoreController::getMainMenu();
			$brand = AdminBrands::getBrandForParameter('id',$id_brand);
			if (isset($_POST['admin_update_brand_submit'])) {
				$error = [];
				// массив данных для brands
				$data_brands_up = [];		 		 
				// название бренда
				if (!empty(trim($_POST['admin_update_brand_name'])) && mb_strlen($_POST['admin_update_brand_name'])<50) {
					$data_brands_up['name'] = htmlentities(trim($_POST['admin_update_brand_name']), ENT_QUOTES) ;
				}else{
					$error[] = 'Введите правильное название бренда!';
				}

				if (empty($error)) {
					global $pdo; 
					$pdo->beginTransaction();
					// редактирование бренда
					$brand_update = AdminProducts::updateDataTable($data_brands_up, 'brands', $id_brand);
					// проверка на наличие бренда введенного в форму
				    $check_brand_up = AdminBrands::getBrandForParameter('name',trim($_POST['admin_update_brand_name']));
				    if (count($check_brand_up)==1) {
				    	$pdo->commit();
				    	$success = 'Изменения внесены успешно!';
				    	$brand = AdminBrands::getBrandForParameter('id',$id_brand);
				    }else{
				    	$pdo->rollBack();
				    	$error[] = 'Такой бренд уже существует!';
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
			require_once ROOT . "/views/admin/admin_update_brand.php";	
    	}
		 
	}	 
}
?>