<?php 
class AdminCardsController{
	// переход по "Управление cards"	 
	public static function actionIndex() {
		if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
			$name_page = 'cards';
			$menu = CoreController::getMainMenu();
			$cards = Cards::getAllCards();
            // поиск по сайту
            if (isset($_POST['srch'])) {
                $result = Search::getResultSearch($_POST);           
                if (!empty($result)) {
                    header("location: /{$result[0]['link']}");
                }            
            }		 
		 
            require_once ROOT . "/views/admin/admin_cards.php";
		}		 
    }

    // изменение видимости карточки при клике по checkbox (асинхронным запросом)
    public static function actionCardVisibility(){
    	 if (isset($_POST['adm_card_id'])) {
    	 	$data = [];
    	 	if (isset($_POST['adm_card_visibility'])) {
    	 		$data['visibility'] = 1;
    	 	}else{
    	 		$data['visibility'] = 0;
    	 	}    	 	 

    	 	$up_visibility = Cards::updateDataTable($data, 'cards', $_POST['adm_card_id']);    		  
    	 }
    }

    //добавление новой карточки  
    public static function actionInsertCard(){
         if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
            $name_page = 'cards';
            $menu = CoreController::getMainMenu();
            if (isset($_POST['adm_card_form_submit'])) {
                $error = [];
                // массив данных для cards
                $data_cards = [];

                // id товара
                if (!empty(trim($_POST['id_product'])) && preg_match('/^[0-9\s]{1,100}$/iu', $_POST['id_product'])) {
                    $data_cards['link'] = htmlentities(trim($_POST['id_product']), ENT_QUOTES) ;
                }else{
                    $error[] = 'Введите id товара!';
                }                    

                // название бренда
                if (!empty(trim($_POST['alt_img'])) && mb_strlen(trim($_POST['alt_img'])<50)) {
                    $data_cards['alt_img'] =  htmlentities(trim($_POST['alt_img']), ENT_QUOTES) ;
                }else{
                   $error[] = 'Введите название бренда!';
                } 

                // видимость карточки
                 $data_cards['visibility'] = $_POST['visibility_card']; 

                if (empty($error)) {
                     global $pdo ;
                     $pdo->beginTransaction();
                     $new_card = Cards::insertDataTable($data_cards, 'cards');                      
                     // если новыая карточка загружена:
                     if ($new_card != 0) {
                        // загружаем фото в папку и записываем имя фото в slider        
                        $data_img = [];                         
                        // логотип     
                        if(!$_FILES['img']['error'] && $_FILES['img']['size'] <= 3000000) { 
                            //Адрес папки для сохранения
                            $dirPath = ROOT . "/public/img_cards/" . $new_card . "_" . "{$_FILES['img']['name']}";          
                            if(move_uploaded_file($_FILES['img']['tmp_name'] , $dirPath)){
                                $data_img['img'] = $new_card . "_" . "{$_FILES['img']['name']}";
                            }else{
                                $error[] = "Ошибка при загрузке изображения!";
                            }                       
                        }else {//Если файл не прошел проверку  
                            $error[] = "Изображение не выбрано или превышен размер!";
                        }                                          

                        if ($new_card != 0 && Cards::updateDataTable($data_img, 'cards', $new_card)) {
                            $pdo->commit();
                            header('Location: /admin/cards');
                        }else{
                            $pdo->rollBack();
                            $error[] = 'Не возможно добавить карточку';
                        }
                      
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
         
            require_once ROOT . "/views/admin/admin_card_insert.php";
        }   
    }

    // удаление карточки
    public static function actionDeleteCard($id_card){
        if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
            $card = Cards::getOneCard($id_card);
            // удаление фотографии
            $img = ROOT . "/public/img_cards/{$card['img']}";
            if(file_exists($img)){
                unlink($img);
            }                        
            $delete_card = Cards::deleteById('cards', 'id', $id_card);                   
            header("Location: /admin/cards");
        }         
    }

    //редактирование карточки  
    public static function actionUpdateCard($id_card){
        if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
            $name_page = 'cards';
            $menu = CoreController::getMainMenu();
            $card = Cards::getOneCard($id_card);
            if (isset($_POST['adm_card_up_form_submit'])) {
                $error = [];
                // массив данных для редактирования карточки
                $data_card_up = [];

                // id товара
                if (!empty(trim($_POST['id_product'])) && preg_match('/^[0-9\s]{1,100}$/iu', $_POST['id_product'])) {
                    $data_card_up['link'] = htmlentities(trim($_POST['id_product']), ENT_QUOTES) ;
                }else{
                    $error[] = 'Введите id товара!';
                }

                // название бренда
                if (!empty(trim($_POST['name_brand'])) && mb_strlen(trim($_POST['name_brand'])<100)) {
                    $data_card_up['alt_img'] = htmlentities(trim($_POST['name_brand']), ENT_QUOTES) ;
                }else{
                    $error[] = 'Введите название бренда!';
                }                

                // видимость карточки
                 $data_card_up['visibility'] = $_POST['visibility'];

                // изображение
                if ($_FILES['img']['size'] >0 && $_FILES['img']['size'] <= 3000000 && empty($error)) {
                   // удаление фотографии из папки img_cards
                    $img = ROOT . "/public/img_cards/{$card['img']}";
                    if(file_exists($img)){
                        unlink($img);
                    }
                    // сохранение фото и названия фото:
                    if(!$_FILES['img']['error'] && $_FILES['img']['size'] <= 3000000) { 
                            //Адрес папки для сохранения
                            $dirPath = ROOT . "/public/img_cards/" . $id_card . '_'. "{$_FILES['img']['name']}";            
                            if(move_uploaded_file($_FILES['img']['tmp_name'] , $dirPath)){
                                $data_card_up['img'] = $id_card . '_'. "{$_FILES['img']['name']}";
                            }else{
                                $error[] = "Ошибка при загрузке фото!";
                            }                       
                        }else {//Если файл не прошел проверку  
                            $error[] = "Фото не выбрано или превышен размер!";
                        }
                }

                if (empty($error)) {                     
                    if (Cards::updateDataTable($data_card_up, 'cards', $id_card)) {
                        $card = Cards::getOneCard($id_card);
                        $success = 'Изменения внесены!';
                    }else{
                        $error[] = 'Изменение карточки временно не доступно!';
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

            require_once ROOT . "/views/admin/admin_card_update.php";
             
        } 

    }
}
?>