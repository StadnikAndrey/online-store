<?php
class AdminDeliveryController  {
	 
	// переход по 'доставка' в админпанели
	public static function actionUpdateDelivery() {
		if (isset($_SESSION['user']) && $_SESSION['user']['super_admin']==1 && $_SESSION['user']['is_ban']==0) {

			$name_page = 'delivery';
			$menu = CoreController::getMainMenu();
		    $info = Delivery::getInfoDelivery();	
		    if (isset($_POST['adm_delivery_up_submit'])) {
		    	 	 $error = [];
                     // массив данных для редактирования инф. об условиях доставки
                     $data_delivery_up = [];

                     // фото  
	                if ($_FILES['img']['size'] > 0 && $_FILES['img']['size'] <= 3000000) {
	                   // удаление фотографии из папки img_info
	                    $img = ROOT . "/public/img_info/{$info['img']}";
	                    if(file_exists($img)){
	                        unlink($img);
	                    }
	                    // сохранение фото и названия фото:
	                    if(!$_FILES['img']['error'] && $_FILES['img']['size'] <= 3000000) { 
	                            //Адрес папки для сохранения
	                            $dirPath = ROOT . "/public/img_info/" . $info['id'] . '_delivery_'. "{$_FILES['img']['name']}";            
	                            if(move_uploaded_file($_FILES['img']['tmp_name'] , $dirPath)){
	                                $data_delivery_up['img'] = $info['id'] . '_delivery_'. "{$_FILES['img']['name']}";
	                            }else{
	                                $error[] = "Ошибка при загрузке фото!";
	                            }                       
	                        }else {//Если файл не прошел проверку  
	                            $error[] = "Превышен размер фото!";
	                        }
	                }

	                //инф. о компании				 
					$data_delivery_up['text'] = nl2br(trim($_POST['adm_delivery_txt']),false) ;

					if (empty($error)) {                     
	                    if (Delivery::updateDataTable($data_delivery_up, 'delivery', $info['id'])) {
	                        $info = Delivery::getInfoDelivery();	
	                        $success = 'Изменения внесены!';
	                    }else{
	                        $error[] = 'Изменение информации о компании временно не доступно!';
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
		      
            require_once ROOT . "/views/admin/admin_delivery_update.php";
		}
		 		 
    }	 
}
?>