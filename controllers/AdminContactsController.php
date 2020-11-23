<?php
class AdminContactsController  {
	 
	// переход по 'Контакты' в админпанели
	public static function actionUpdateContacts() {
		if (isset($_SESSION['user']) && $_SESSION['user']['super_admin']==1 && $_SESSION['user']['is_ban']==0) {
			$name_page = 'contacts';
			$menu = CoreController::getMainMenu();
		    $info = Contacts::getContacts();	
		    if (isset($_POST['adm_contacts_up_submit'])) {
		    	 	 $error = [];
                     // массив данных для редактирования контактной инф. компании
                     $data_contacts_up = [];

                     // фото  
	                if ($_FILES['img_contact']['size'] > 0 && $_FILES['img_contact']['size'] <= 3000000) {
	                   // удаление фотографии   из папки img_info
	                    $img = ROOT . "/public/img_info/{$info['img']}";
	                    if(file_exists($img)){
	                        unlink($img);
	                    }
	                    // сохранение фото и названия фото:
	                    if(!$_FILES['img_contact']['error'] && $_FILES['img_contact']['size'] <= 3000000) { 
	                            //Адрес папки для сохранения
	                            $dirPath = ROOT . "/public/img_info/" . $info['id'] . '_contact_'. "{$_FILES['img_contact']['name']}";            
	                            if(move_uploaded_file($_FILES['img_contact']['tmp_name'] , $dirPath)){
	                                $data_contacts_up['img'] = $info['id'] . '_contact_'. "{$_FILES['img_contact']['name']}";
	                            }else{
	                                $error[] = "Ошибка при загрузке фото!";
	                            }                       
	                        }else {//Если файл не прошел проверку  
	                            $error[] = "Превышен размер фото!";
	                        }
	                }                     

	                //контактная инф. компании				 
					$data_contacts_up['text'] = nl2br(trim($_POST['adm_contacts_txt']),false) ;
					                     
                    if (Contacts::updateDataTable($data_contacts_up, 'contacts', $info['id'])) {
                        $info = Contacts::getContacts();
                        $success = 'Изменения внесены!';
                    }else{
                        $error[] = 'Изменение контактной информации компании временно не доступно!';
                    }
                    	
		    }

		    // поиск по сайту
			if (isset($_POST['srch'])) {
				$result = Search::getResultSearch($_POST);			 
				if (!empty($result)) {
					header("location: /{$result[0]['link']}");
				}			 
		    }
	    	 
            require_once ROOT . "/views/admin/admin_contacts_update.php";
		}
		 		 
    }	 
}
?>