<?php
class AdminSliderController  {
	// переход по "Управление слайдером"	 
	public static function actionIndex() {
		if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
			$name_page = 'slider';
			$menu = CoreController::getMainMenu();
			$slides = Slider::getAdminSlider();	
            // поиск по сайту
            if (isset($_POST['srch'])) {
                $result = Search::getResultSearch($_POST);           
                if (!empty($result)) {
                    header("location: /{$result[0]['link']}");
                }            
            } 
		 
		 
            require_once ROOT . "/views/admin/admin_slider.php";
		}		 
    }

    // изменение видимости слайда при клике по checkbox (асинхронным запросом)
    public static function actionVisibility(){
    	 if (isset($_POST['adm_slider_id_slide'])) {
    	 	$data = [];
    	 	if (isset($_POST['adm_slider_visibility'])) {
    	 		$data['visibility'] = 1;
    	 	}else{
    	 		$data['visibility'] = 0;
    	 	}    	 	 

    	 	$up_visibility = Slider::updateDataTable($data, 'slider', $_POST['adm_slider_id_slide']);    		  
    	 }
    }

    // добавление слайда
    public static function actionInsertSlide(){
     	if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
     		$name_page = 'slider';
			$menu = CoreController::getMainMenu();
            if (isset($_POST['adm_slider_form_submit'])) {
                 $error = [];
                // массив данных для slider
                $data_slider = [];                    

                // название бренда
                if (!empty(trim($_POST['alt_logo'])) && mb_strlen(trim($_POST['alt_logo'])<50)) {
                    $data_slider['alt_logo'] =  htmlentities(trim($_POST['alt_logo']), ENT_QUOTES) ;
                }else{
                   $error[] = 'Введите название бренда!';
                }  

                // заголовок
                if (!empty(trim($_POST['title'])) && mb_strlen(trim($_POST['title'])<500)) {
                    $data_slider['title'] = htmlentities(trim($_POST['title']), ENT_QUOTES) ;
                }else{
                    $error[] = 'Введите заголовок!';
                }

                // подзаголовок
                if (!empty(trim($_POST['subtitle'])) && mb_strlen(trim($_POST['subtitle'])<500)) {
                    $data_slider['subtitle'] = htmlentities(trim($_POST['subtitle']), ENT_QUOTES) ;
                }else{
                    $error[] = 'Введите подзаголовок!';
                }

                // id товара
                if (!empty(trim($_POST['id_product'])) && preg_match('/^[0-9\s]{1,100}$/iu', $_POST['id_product'])) {
                    $data_slider['link'] = htmlentities(trim($_POST['id_product']), ENT_QUOTES) ;
                }else{
                    $error[] = 'Введите id товара!';
                }

                // видимость слайда
                 $data_slider['visibility'] = $_POST['visibility_slide'];

                if (empty($error)) {
                     global $pdo ;
                     $pdo->beginTransaction();
                     $new_slide = Slider::insertDataTable($data_slider, 'slider');                      
                     // если новый слайд загружен:
                     if ($new_slide != 0) {
                        // загружаем фото в папку и записываем имя фото в slider        
                        $data_img = [];                         
                        // логотип     
                        if(!$_FILES['img_brand']['error'] && $_FILES['img_brand']['size'] <= 3000000) { 
                            //Адрес папки для сохранения
                            $dirPath = ROOT . "/public/img_slider/" . $new_slide . 'logo_'. "{$_FILES['img_brand']['name']}";            
                            if(move_uploaded_file($_FILES['img_brand']['tmp_name'] , $dirPath)){
                                $data_img['logo'] = $new_slide . 'logo_'. "{$_FILES['img_brand']['name']}";
                            }else{
                                $error[] = "Ошибка при загрузке фото логотипа!";
                            }                       
                        }else {//Если файл не прошел проверку  
                            $error[] = "Фото логотипа не выбрано или превышен размер!";
                        }
                        // основное изображение     
                        if(!$_FILES['img']['error'] && $_FILES['img']['size'] <= 3000000) { 
                            //Адрес папки для сохранения
                            $dirPath = ROOT . "/public/img_slider/" . $new_slide . 'main_'. "{$_FILES['img']['name']}";            
                            if(move_uploaded_file($_FILES['img']['tmp_name'] , $dirPath)){
                                $data_img['img'] = $new_slide . 'main_'. "{$_FILES['img']['name']}";
                            }else{
                                $error[] = "Ошибка при загрузке основного фото!";
                            }                       
                        }else { 
                            $error[] = "Основное фото не выбрано или превышен размер!";
                        }                         

                        if ($new_slide != 0 && Slider::updateDataTable($data_img, 'slider', $new_slide)) {
                            $pdo->commit();
                            header('Location: /admin/slider');
                        }else{
                            $pdo->rollBack();
                            $error[] = 'Не возможно добавить слайд';
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

			require_once ROOT . "/views/admin/admin_slider_insert.php";
     	}

    }

    // удаление слайда
    public static function actionDeleteSlide($id_slide){
        if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
            $slide = Slider::getOneSlide($id_slide);
             $arr_img = [];
            // фото логотипа      
            $arr_img[] =  $slide['logo'];
            $arr_img[] =  $slide['img'];
            // удаление фотографий из папки img_slider     
            for ($i=0; $i < count($arr_img) ; $i++) { 
                 $img = ROOT . "/public/img_slider/{$arr_img[$i]}";
                 if(file_exists($img)){
                      unlink($img);
                    }   
            }                
            $delete_slide = Slider::deleteById('slider', 'id', $id_slide);                   
            header("Location: /admin/slider");
        }        
         
    }

    // редактирование слайда
    public static function actionUpdateSlide($id_slide){
        if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
            $name_page = 'slider';
            $menu = CoreController::getMainMenu();
            $slide = Slider::getOneSlide($id_slide);
            if (isset($_POST['adm_slider_up_form_submit'])) {
                $error = [];
                // массив данных для редактирования слайда
                $data_slide_up = [];                 

                // название бренда
                if (!empty(trim($_POST['alt_logo'])) && mb_strlen(trim($_POST['alt_logo'])<50)) {
                    $data_slide_up['alt_logo'] =  htmlentities(trim($_POST['alt_logo']), ENT_QUOTES) ;
                }else{
                   $error[] = 'Введите название бренда!';
                }  

                // заголовок
                if (!empty(trim($_POST['title'])) && mb_strlen(trim($_POST['title'])<500)) {
                    $data_slide_up['title'] = htmlentities(trim($_POST['title']), ENT_QUOTES) ;
                }else{
                    $error[] = 'Введите заголовок!';
                }

                // подзаголовок
                if (!empty(trim($_POST['subtitle'])) && mb_strlen(trim($_POST['subtitle'])<500)) {
                    $data_slide_up['subtitle'] = htmlentities(trim($_POST['subtitle']), ENT_QUOTES) ;
                }else{
                    $error[] = 'Введите подзаголовок!';
                }                 

                // id товара
                if (!empty(trim($_POST['id_product'])) && preg_match('/^[0-9\s]{1,100}$/iu', $_POST['id_product'])) {
                    $data_slide_up['link'] = htmlentities(trim($_POST['id_product']), ENT_QUOTES) ;
                }else{
                    $error[] = 'Введите id товара!';
                }

                // видимость слайда
                 $data_slide_up['visibility'] = $_POST['visibility_slide'];

                // фото логотипа
                if ($_FILES['img_brand']['size'] > 0 && $_FILES['img_brand']['size'] <= 3000000 && empty($error)) {
                   // удаление фотографии логотипа из папки img_slider
                    $img = ROOT . "/public/img_slider/{$slide['logo']}";
                    if(file_exists($img)){
                        unlink($img);
                    }
                    // сохранение фото и названия фото:
                    if(!$_FILES['img_brand']['error'] && $_FILES['img_brand']['size'] <= 3000000) { 
                            //Адрес папки для сохранения
                            $dirPath = ROOT . "/public/img_slider/" . $id_slide . 'logo_'. "{$_FILES['img_brand']['name']}";            
                            if(move_uploaded_file($_FILES['img_brand']['tmp_name'] , $dirPath)){
                                $data_slide_up['logo'] = $id_slide . 'logo_'. "{$_FILES['img_brand']['name']}";
                            }else{
                                $error[] = "Ошибка при загрузке фото логотипа!";
                            }                       
                        }else {//Если файл не прошел проверку  
                            $error[] = "Фото логотипа не выбрано или превышен размер!";
                        }
                }

                 // основное изображение
                if ($_FILES['img']['size'] >0 && $_FILES['img']['size'] <= 3000000 && empty($error)) {
                   // удаление фотографии логотипа из папки img_slider
                    $img = ROOT . "/public/img_slider/{$slide['img']}";
                    if(file_exists($img)){
                        unlink($img);
                    }
                    // сохранение фото и названия фото:
                    if(!$_FILES['img']['error'] && $_FILES['img']['size'] <= 3000000) { 
                            //Адрес папки для сохранения
                            $dirPath = ROOT . "/public/img_slider/" . $id_slide . 'main_'. "{$_FILES['img']['name']}";            
                            if(move_uploaded_file($_FILES['img']['tmp_name'] , $dirPath)){
                                $data_slide_up['img'] = $id_slide . 'main_'. "{$_FILES['img']['name']}";
                            }else{
                                $error[] = "Ошибка при загрузке основного фото!";
                            }                       
                        }else {//Если файл не прошел проверку  
                            $error[] = "Фото логотипа не выбрано или превышен размер!";
                        }
                }

                if (empty($error)) {                     
                    if (Slider::updateDataTable($data_slide_up, 'slider', $id_slide)) {
                        $slide = Slider::getOneSlide($id_slide);
                        $success = 'Изменения внесены!';
                    }else{
                        $error[] = 'Изменение слайда временно не доступно!';
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

            require_once ROOT . "/views/admin/admin_slider_update.php";
        }
    }
	 
}
?>