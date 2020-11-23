<?php 
class AdminProductController{
	// страница управления товарами
	public static function actionIndex(){
		if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
			$name_page = 'products';	
			$menu = CoreController::getMainMenu();
			$categorys = AdminProducts::getAdminFormFilter('category');
			$subcategorys = AdminProducts::getAdminFormFilter('subcategory');
			$brands = AdminProducts::getAdminFormFilter('brands');
			$minMaxPrice = AdminProducts::getMinMaxPriceProducts();
			$sizesProduct = AdminProducts::getAdminFormFilter('sizes');
			$products = AdminProducts::getAdminProducts($_POST,10);
			// постраничная навигация
			$countProducts = AdminProducts::getQuantityProducts($_POST);		 
			$countPage = ceil($countProducts/10);
			// prev & next
			$page = 1;
			$prev = 1;
			$next= 2;
			if (isset($_POST['page']) ) {
				$page = (int)($_POST['page'][0]);			 
			    if ( $page!=1 ) {			 
				$prev = $page-1;
			    }else{
				    $prev=$page;
			    }		     
			    if ( $page != $countPage  ) {			           
				    $next = $page+1;
			    }else{
				  $next=$page;   
			    }		  
			}

			// поиск по сайту
			if (isset($_POST['srch'])) {
				$result = Search::getResultSearch($_POST);			 
				if (!empty($result)) {
					header("location: /{$result[0]['link']}");
				}			 
		    }
			 
			require_once ROOT . "/views/admin/admin_products.php";
		}
		 
	}

	// страница добавления товара
	public static function actionInsertProduct(){
		if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
			$name_page = 'products';	
			$menu = CoreController::getMainMenu();
			$categorys = AdminProducts::getAdminFormFilter('category');		 
			$subcategorys = AdminProducts::getAdminFormFilter('subcategory');
			$brands = AdminProducts::getAdminFormFilter('brands');
			$sizesProduct = AdminProducts::getAdminFormFilter('sizes');	
			// добавление товара
			if (isset($_POST['adm_insert_hidden'])) {			 
				$error = [];
				// массив данных для products
				$data_products = [];
				// категория
				if (!empty($_POST['adm_insert_category'])) {
					$data_products['id_category'] = (int)$_POST['adm_insert_category'];
				}else{
					$error[] = 'Выберите категорию!';
				}			 
				// название
				if (!empty(trim($_POST['adm_insert_name'])) && mb_strlen($_POST['adm_insert_name'])<50) {
					$data_products['name'] = htmlentities(trim($_POST['adm_insert_name']), ENT_QUOTES) ;
				}else{
					$error[] = 'Введите правильное название товара!';
				}
				 
				// субкатегория
				if (!empty($_POST['adm_insert_subcategory'])) {
					$data_products['id_subcategory'] = (int)$_POST['adm_insert_subcategory'];
				}else{
					$error[] = 'Выберите тип товара!';
				}
				 
				// модель
				if (!empty(trim($_POST['adm_insert_model'])) && mb_strlen($_POST['adm_insert_model'])<50) {
					$data_products['model'] = htmlentities(trim($_POST['adm_insert_model']), ENT_QUOTES);
				}else{
					$error[] = 'Введите правильное название модели!';
				}
				 
				// бренд
				if (!empty($_POST['adm_insert_brand'])) {
					$data_products['id_brand'] = (int)$_POST['adm_insert_brand'];
				}else{
					$error[] = 'Выберите бренд товара!';
				}
				 
				// артикул
				if (!empty(trim($_POST['adm_insert_code'])) && mb_strlen($_POST['adm_insert_code'])<20) {
					$data_products['code'] = htmlentities(trim($_POST['adm_insert_code']), ENT_QUOTES);
				}else{
					$error[] = 'Введите правильное название артикула!';
				}
				 
				// цена
				if (!empty(trim($_POST['adm_insert_price'])) && mb_strlen($_POST['adm_insert_price'])<10
			        && preg_match('/^[0-9]{1,6}[,]{0,1}[0-9]{1,6}$/iu', trim($_POST['adm_insert_price']))) {
					$data_products['price'] = trim((int)$_POST['adm_insert_price']);
				}else{
					$error[] = 'Введите правильную цену товара!';
				}
				 
				// описание
				if (!empty(trim($_POST['adm_insert_description']))) {
					$data_products['description'] = htmlentities(trim($_POST['adm_insert_description']), ENT_QUOTES);	 
				}else{
					$error[] = 'Введите правильное описание товара!';
				}				 
	 
				// детали
					 if (!empty(trim($_POST['adm_insert_details'])) && mb_strlen($_POST['adm_insert_details'])<500) {
					$data_products['details'] = nl2br(htmlentities(trim($_POST['adm_insert_details']), ENT_QUOTES),false);
				}else{
					$error[] = 'Введите детальное описание товара!';
				}
				 // если не выбрано хоть оно значение количества товара одного размера
				if (array_sum($_POST['adm_insert_quantity_product'])==0) {
				 $error[] = 'Выберите количество товара соответственно размеру!';	 	 			 			   			 
				}			 
			      

				if (empty($error)) {
					// запись нового товара в products
				$new_product = AdminProducts::insertDataTable($data_products, 'products');
				//если запись нового товара добавлена - получаем информацию о добавленном товаре для получения value полей формы для добавления записи в products_size и добавляем фотографии товара(используется id товара для создания уникального имени фотографии)
				if ($new_product != 0) {
					$product = Products::getById($new_product);
					// добавление фотографий товара			 
				    $arr_name_img = [];	
				    $data_products_udate_img = [];			 
					//Для всех загруженных файлов 
					//(к-ство элементов в подмассивах одинаково, error используем для пересчета и одновременной проверки)
					foreach($_FILES['adm_insert_imgs']['error'] as $key => $error_img) {
					    //Проверяем значение ошибки и не превышен ли допустимый размер	 
						if(!$error_img && $_FILES['adm_insert_imgs']['size'][$key] <= 30000000) { 
							//Адрес папки для сохранения
							$dirPath = ROOT . "/public/img_products/" . $new_product . "_". "{$_FILES['adm_insert_imgs']['name'][$key]}"; 			 
							if(move_uploaded_file($_FILES['adm_insert_imgs']['tmp_name'][$key], $dirPath)){
								$arr_name_img[] = $new_product . "_" . $_FILES['adm_insert_imgs']['name'][$key];
							}else{
								$error[] = "Ошибка при загрузке фото!";
							}						
						}else {//Если файл не прошел проверку  
							$error[] = "Фото не выбрано или превышен размер!";
						}
					}
					 if (count($arr_name_img) == 1) {
					 	$arr_name_img[]= '';
					 } 
					 $str_name_img = implode(",", $arr_name_img);			 
					 $data_products_udate_img['img'] = $str_name_img;
					 if (empty($error)) {
					 	$up_product_img = AdminProducts::updateDataTable($data_products_udate_img, 'products', $new_product);
					 }
					  
				}
				// запись в products_size
				foreach ($_POST['adm_ins_quantity_id_size'] as $key => $value) {
				if (!empty($_POST['adm_insert_quantity_product'][$key])) {
				$data_product_size = [];
				$data_product_size['id_product'] = $new_product;
				$data_product_size['id_size'] = $_POST['adm_ins_quantity_id_size'][$key];
				$data_product_size['id_category'] = $product['id_category'];
				$data_product_size['products_count'] = $_POST['adm_insert_quantity_product'][$key];

				$product_size = AdminProducts::insertDataTable($data_product_size, 'product_size');			   			 
				}			 
			    }
			    // изменение visibility в products на 1
			    if (isset($product_size)&&$product_size != 0) {
			    	$data_visibility = [];
			    	$data_visibility['visibility'] = 1;
			    	$visibility = AdminProducts::updateDataTable($data_visibility, 'products', $new_product);
			    }
			    header("Location: /admin/product");
				}
				 
			}

			// поиск по сайту
			if (isset($_POST['srch'])) {
				$result = Search::getResultSearch($_POST);			 
				if (!empty($result)) {
					header("location: /{$result[0]['link']}");
				}			 
		    }		 
			require_once ROOT . "/views/admin/admin_insert_product.php";
		}
		 
	}

	// удаление товара
	public static function actionDeleteProduct($id_product){
		if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
			$product = Products::getById($id_product);
			// массив с фотографиями товара		 
			$arr_img = deleteEmptyElement(explode(",", $product['img'])) ;
			// удаление фотографий товара из папки		 
			for ($i=0; $i < count($arr_img) ; $i++) { 
				 $img = ROOT . "/public/img_products/{$arr_img[$i]}";
				 if(file_exists($img)){
				 	  unlink($img);
				    }   
			}		 		 
		    $delete_product_size = AdminProducts::deleteById('product_size', 'id_product', $id_product);
			$delete_product = AdminProducts::deleteById('products', 'id', $id_product);		 
			header("Location: /admin/product");
		}		 
		 
	}

	// редактирование товара
	public static function actionUpdateProduct($id_product){
		if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
				$name_page = 'products';	
			$menu = CoreController::getMainMenu();
			$categorys = AdminProducts::getAdminFormFilter('category');				 
			$subcategorys = AdminProducts::getAdminFormFilter('subcategory');
			$brands = AdminProducts::getAdminFormFilter('brands');
			$sizesProduct = AdminProducts::getAdminFormFilter('sizes');
			$product = Products::getById($id_product);
			$arr_img = deleteEmptyElement(explode(",", $product['img']));
			$product_size = AdminProducts::getProductSizesOneProduct($id_product);		 
			if (isset($_POST['adm_update_hidden'])) {
				 
				$error = [];
				// массив данных для редактирования товара в products
				$data_products_up = [];
				// категория
				if (!empty($_POST['adm_upd_category'])) {
					$data_products_up['id_category'] = (int)$_POST['adm_upd_category'];
				}else{
					$error[] = 'Выберите категорию!';
				}			 
				// название
				if (!empty(trim($_POST['adm_upd_name'])) && mb_strlen($_POST['adm_upd_name'])<50) {
					$data_products_up['name'] = htmlentities(trim($_POST['adm_upd_name']), ENT_QUOTES) ;
				}else{
					$error[] = 'Введите правильное название товара!';
				}
				 
				// субкатегория
				if (!empty($_POST['adm_upd_subcategory'])) {
					$data_products_up['id_subcategory'] = (int)$_POST['adm_upd_subcategory'];
				}else{
					$error[] = 'Выберите тип товара!';
				}
				 
				// модель
				if (!empty(trim($_POST['adm_upd_model'])) && mb_strlen($_POST['adm_upd_model'])<50) {
					$data_products_up['model'] = htmlentities(trim($_POST['adm_upd_model']), ENT_QUOTES);
				}else{
					$error[] = 'Введите правильное название модели!';
				}
				 
				// бренд
				if (!empty($_POST['adm_upd_brand'])) {
					$data_products_up['id_brand'] = (int)$_POST['adm_upd_brand'];
				}else{
					$error[] = 'Выберите бренд товара!';
				}
				 
				// артикул
				if (!empty(trim($_POST['adm_upd_code'])) && mb_strlen($_POST['adm_upd_code'])<20) {
					$data_products_up['code'] = htmlentities(trim($_POST['adm_upd_code']), ENT_QUOTES);
				}else{
					$error[] = 'Введите правильное название артикула!';
				}
				 
				// цена
				if (!empty(trim($_POST['adm_upd_price'])) && mb_strlen($_POST['adm_upd_price'])<10
			        && preg_match('/^[0-9]{1,6}[,]{0,1}[0-9]{1,6}$/iu', trim($_POST['adm_upd_price']))) {
					$data_products_up['price'] = trim((int)$_POST['adm_upd_price']);
				}else{
					$error[] = 'Введите правильную цену товара!';
				}
				 
				// описание
				if (!empty(trim($_POST['adm_upd_description']))) {
					$data_products_up['description'] = htmlentities(trim($_POST['adm_upd_description']), ENT_QUOTES);	 
				}else{
					$error[] = 'Введите правильное описание товара!';
				}				 

				// фотографии
				if ($_FILES['adm_upd_img']['size'][0] > 0 && $_FILES['adm_upd_img']['size'][0] <= 3000000 && empty($error)) {
					// удаление старых фотографий из папки:				 
						$product = Products::getById($id_product);
						// массив со старыми фотографиями товара		 
						$arr_img_del =  deleteEmptyElement(explode(",", $product['img']));					 			 
						// удаление фотографий товара из папки		 
						for ($i=0; $i < count($arr_img_del) ; $i++) { 
							 $img = ROOT . "/public/img_products/{$arr_img_del[$i]}";
							 // chmod($img, 0750);
							 if(file_exists($img)){
							 	  unlink($img);
							 	  // clearstatcache();
							    }   
						}	

					// добавление (перезапись) фотографий товара
					$arr_name_img_up = [];				 
					//Для всех загруженных файлов 
					//(к-ство элементов в подмассивах одинаково, error используем для пересчета и одновременной проверки)
					foreach($_FILES['adm_upd_img']['error'] as $key => $error_img) {
					    //Проверяем значение ошибки и не превышен ли допустимый размер	 
						if(!$error_img && $_FILES['adm_upd_img']['size'][$key] <= 3000000) { 
							//Адрес папки для сохранения
							$dirPath = ROOT . "/public/img_products/"  . $id_product . "_" ."{$_FILES['adm_upd_img']['name'][$key]}"; 			 
							if(move_uploaded_file($_FILES['adm_upd_img']['tmp_name'][$key], $dirPath)){
								$arr_name_img_up[] = $id_product . "_" . $_FILES['adm_upd_img']['name'][$key];
							}else{
								$error[] = "Ошибка при загрузке фото!";
							}						
						}else {//Если файл не прошел проверку  
							$error[] = "Превышен размер!";
						}
					}
					 if (count($arr_name_img_up) == 1) {
					 	$arr_name_img_up[]= '';
					 } 
					 $str_name_img_up = implode(",", $arr_name_img_up);			 
					 $data_products_up['img'] = $str_name_img_up;
				}			 
				 
	 
				// детали
					 if (!empty(trim($_POST['adm_upd_details'])) && mb_strlen($_POST['adm_upd_details'])<500) {
					$data_products_up['details'] = nl2br(htmlentities(preg_replace('/(<br>){0,100}/iu','', trim($_POST['adm_upd_details'])) , ENT_QUOTES),false);
				}else{
					$error[] = 'Введите детальное описание товара!';
				}
	   
				if (empty($error)) {
					 
					//изменнение данных товара в products
					$up_product = AdminProducts::updateDataTable($data_products_up, 'products', $id_product);
					//если изменнение данных товара успешны - получаем информацию о добавленном товаре для получения value полей формы для добавления записи в products_size
					if ($up_product) {
						$product_up = Products::getById($id_product);					 
						// получение новых изображений товара
						$arr_img = deleteEmptyElement(explode(",", $product_up['img']));				  
					}
				// // запись в products_size:
					// удаление всех строк товара из product_size
					$delete_product_size = AdminProducts::deleteById('product_size', 'id_product', $id_product);
					// добавление новых записей в product_size
					foreach ($_POST['admin_update_quantity_id_size'] as $key => $value) {
					  if (!empty($_POST['admin_update_quantity_product'][$key])) {
					  $data_product_size_up = [];
					  $data_product_size_up['id_product'] = $id_product;
					  $data_product_size_up['id_size'] = $_POST['admin_update_quantity_id_size'][$key];
					  $data_product_size_up['id_category'] = $product_up['id_category'];
					  $data_product_size_up['products_count'] = $_POST['admin_update_quantity_product'][$key];

					  $product_size_up = AdminProducts::insertDataTable($data_product_size_up, 'product_size');			   			 
					  }			 
				    }

			        // изменение visibility в products учитывая наличие в product_size		    
			     	$data_visibility_up = [];
			     	$product_for_product_size = AdminProducts::getProductSizesOneProduct($id_product);
			     	if (empty($product_for_product_size)) {
			     		$data_visibility_up['visibility'] = 0;
			     	}else{
			     		$data_visibility_up['visibility'] = 1;
			     	}
			    	 
			    	$visibility_up = AdminProducts::updateDataTable($data_visibility_up, 'products', $id_product);		      
			    	$txt = 'Изменения сохранены!';
			      
				}	

			}

			// поиск по сайту
			if (isset($_POST['srch'])) {
				$result = Search::getResultSearch($_POST);			 
				if (!empty($result)) {
					header("location: /{$result[0]['link']}");
				}			 
		    }

			require_once ROOT . "/views/admin/admin_update_product.php";

		}
		 
	}
}

?>