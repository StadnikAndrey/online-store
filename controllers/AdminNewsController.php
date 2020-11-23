<?php 
class AdminNewsController{
	// переход по "Управление новостями"	 	 
	public static function actionIndex() {
		if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0) {
			$name_page = 'news';
		    $menu = CoreController::getMainMenu();
		    $news = News::getAllNews($_POST,10);		     
		    // постраничная навигация
		    $quantity_news = News::getQuantityNews($_POST);			   
		    $countPage = ceil($quantity_news/10);
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
			 		 
	        require_once ROOT . "/views/admin/admin_news.php";
		}
		 		 
    }

    // добавление новости	 	 
	public static function actionInsertNews() {
		if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0) {
			$name_page = 'news';
		    $menu = CoreController::getMainMenu();
		    if (isset($_POST['adm_news_insert_submit'])) {
		    	$error = [];
				// массив данных для news
				$data_news = [];
				// заголовок
				if (!empty(trim($_POST['adm_news_in_title']))) {
					$data_news['title'] = nl2br(htmlentities(trim($_POST['adm_news_in_title']), ENT_QUOTES),false) ;
				}else{
					$error[] = 'Введите заголовок статьи!';
				}

				// дата добавления(для показа пользователю)
				$data_news['date'] = date("d.m.Y");

				// подзаголовок
				if (!empty(trim($_POST['adm_news_in_subtitle']))) {
					$data_news['subtitle'] = nl2br(htmlentities(trim($_POST['adm_news_in_subtitle']), ENT_QUOTES),false) ;
				}else{
					$error[] = 'Введите подзаголовок!';
				}

				// 1-й текстовый блок				 
				if (!empty(trim($_POST['adm_news_in_txt_one']))) {
					$data_news['txt_one'] = nl2br(htmlentities(trim($_POST['adm_news_in_txt_one']), ENT_QUOTES),false) ;
				}

				// 2-й текстовый блок				 
				if (!empty(trim($_POST['adm_news_in_txt_two']))) {
					$data_news['txt_two'] = nl2br(htmlentities(trim($_POST['adm_news_in_txt_two']), ENT_QUOTES),false) ;
				}

				// 3-й текстовый блок				 
				if (!empty(trim($_POST['adm_news_in_txt_three']))) {
					$data_news['txt_three'] = nl2br(htmlentities(trim($_POST['adm_news_in_txt_three']), ENT_QUOTES),false) ;
				}

				if (empty($error)) {
					global $pdo ;
                    $pdo->beginTransaction();
                    $new = News::insertDataTable($data_news, 'news');
                    // если новость добавлена
                    if ($new != 0) {
                        // загружаем фото в папку и записываем имя фото в соответствующие поля news
                        $data_img = [];                         
                        // основное фото     
                        if(!$_FILES['img_first']['error'] && $_FILES['img_first']['size'] <= 3000000) { 
                            //Адрес папки для сохранения
                            $dirPath = ROOT . "/public/img_news/" . $new . '_main_'. "{$_FILES['img_first']['name']}";            
                            if(move_uploaded_file($_FILES['img_first']['tmp_name'] , $dirPath)){
                                $data_img['img_first'] = $new . '_main_'. "{$_FILES['img_first']['name']}";
                            }else{
                                $error[] = "Ошибка при загрузке главного изображения!";
                            }                       
                        }else {//Если файл не прошел проверку  
                            $error[] = "Главное изображение не выбрано или превышен размер!";
                        }                         

                        //изображения к 1-му текстовому блоку
                        $one_img_arr = [];
                        foreach($_FILES['img_one']['error'] as $key => $error_img) {                        	 
					        //Проверяем значение ошибки и не превышен ли допустимый размер	 
							if(!$error_img && $_FILES['img_one']['size'][$key] <= 3000000) { 
								//Адрес папки для сохранения
								$dirPath = ROOT . "/public/img_news/" . $new . "_one_". "{$_FILES['img_one']['name'][$key]}"; 			 
								if(move_uploaded_file($_FILES['img_one']['tmp_name'][$key], $dirPath)){
									$one_img_arr[] = $new . "_one_" . $_FILES['img_one']['name'][$key];
								}else{
									$error[] = "Ошибка при загрузке фото к 1-му текстовому блоку!";
								}						
							} 
					    }
					    if (!empty($one_img_arr)) {
					    	$data_img['img_one'] = json_encode($one_img_arr);
					    }
					    
					    //изображения ко 2-му текстовому блоку
					    if (isset($_FILES['img_two'])) {
					    	$two_img_arr = [];
                            foreach($_FILES['img_two']['error'] as $key => $error_img) {                       	 
						        //Проверяем значение ошибки и не превышен ли допустимый размер	 
								if(!$error_img && $_FILES['img_two']['size'][$key] <= 3000000) { 
									//Адрес папки для сохранения
									$dirPath = ROOT . "/public/img_news/" . $new . "_two_". "{$_FILES['img_two']['name'][$key]}"; 			 
									if(move_uploaded_file($_FILES['img_two']['tmp_name'][$key], $dirPath)){
										$two_img_arr[] = $new . "_two_" . $_FILES['img_two']['name'][$key];
									}else{
										$error[] = "Ошибка при загрузке фото ко 2-му текстовому блоку!";
									}						
								} 
					        }
						    if (!empty($two_img_arr)) {
						    	$data_img['img_two'] = json_encode($two_img_arr);
						    }
					    }
                                                                       

                        if ($new != 0  && empty($error)  && News::updateDataTable($data_img, 'news', $new)) {
                            $pdo->commit();                             
                            header('Location: /admin/news');
                        }else{
                            $pdo->rollBack();
                            $error[] = 'Не возможно добавить новость';
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
		     
		 		 
   			require_once ROOT . "/views/admin/admin_news_insert.php";
		}
		 		 
    }

     // удаление новости асинхронно
    public static function actionDeleteNews(){
        if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){      	 
        	    if (isset($_POST['id_news']) && !empty($_POST['id_news'])) {
        	    	global $pdo ;
                    $pdo->beginTransaction();
		        		$one_news = News::getOneNews($_POST['id_news']);
		              // массив с фотографиями новости:	
		              $arr_img = [];	
		              // главное изображение 
					  $arr_img[] =  $one_news['img_first'];			   
					  // изображения 1-го блока текста
					  if (!empty($one_news['img_one'])) {
					  	$arr_img = array_merge($arr_img, json_decode($one_news['img_one']));
					  }			   
					  // изображения 2-го блока текста
					  if (!empty($one_news['img_two'])) {
					  	$arr_img = array_merge($arr_img, json_decode($one_news['img_two']));
					  }			   
					  $arr_img = deleteEmptyElement($arr_img);

					  // удаление фотографий новости из папки		 
					  for ($i=0; $i < count($arr_img) ; $i++) { 
						   $img = ROOT . "/public/img_news/{$arr_img[$i]}";
						   if(file_exists($img)){
							  unlink($img);
						   }   
					  }
		                         
		              $delete_news = News::deleteById('news', 'id', $_POST['id_news']);                   
		             
			           
			          if ($delete_news) {
                            $pdo->commit();
                            echo 1;
                            exit;                          
                        }else{
                            $pdo->rollBack();
                            $error[] = 'Не возможно удалить новость';
                        }
			          exit;
        	    }               
        }        
         
    }

    // редактирование новости  
    public static function actionUpdateNews($id_news){
    	if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1 && $_SESSION['user']['is_ban']==0){
    		$name_page = 'news';
		    $menu = CoreController::getMainMenu();
		    $one_news = News::getOneNews($id_news);
		    if (isset($_POST['adm_news_up_submit'])) {
		    	$error = [];
                // массив данных для редактирования новости
                $data_news_up = [];

                // заголовок
				if (!empty(trim($_POST['adm_news_up_title']))) {
					$data_news_up['title'] = nl2br(htmlentities(trim($_POST['adm_news_up_title']), ENT_QUOTES),false) ;
				}else{
					$error[] = 'Введите заголовок статьи!';
				}				 

				// подзаголовок
				if (!empty(trim($_POST['adm_news_up_subtitle']))) {
					$data_news_up['subtitle'] = nl2br(htmlentities(trim($_POST['adm_news_up_subtitle']), ENT_QUOTES),false) ;
				}else{
					$error[] = 'Введите подзаголовок!';
				}

				// 1-й текстовый блок				 
				$data_news_up['txt_one'] = nl2br(htmlentities(trim($_POST['adm_news_up_txt_one']), ENT_QUOTES),false) ;				 

				// 2-й текстовый блок			 
				$data_news_up['txt_two'] = nl2br(htmlentities(trim($_POST['adm_news_up_txt_two']), ENT_QUOTES),false) ;	 

				// 3-й текстовый блок				 
				$data_news_up['txt_three'] = nl2br(htmlentities(trim($_POST['adm_news_up_txt_three']), ENT_QUOTES),false) ;
				  
				// ИЗОБРАЖЕНИЯ:                                               
                // основное фото (если загружено)    
                if(!$_FILES['img_first']['error'] && empty($error)) {
                	if ($_FILES['img_first']['size'] <= 3000000) {
	                	  // удаление основного фото из папки                	 
			              $arr_img = [];		               
						  $arr_img[] =  $one_news['img_first'];					      
						  $arr_img = deleteEmptyElement($arr_img);
						  // удаление основного фото из папки		 
						  for ($i=0; $i < count($arr_img) ; $i++) { 
							   $img = ROOT . "/public/img_news/{$arr_img[$i]}";
							   if(file_exists($img)){
								  unlink($img);
							   }   
						  }
						// сохраняем новое изображени в папку и добавляем в $data_news_up имя изображения
	                    //Адрес папки для сохранения
	                    $dirPath = ROOT . "/public/img_news/" . $one_news['id'] . '_main_'. "{$_FILES['img_first']['name']}";            
	                    if(move_uploaded_file($_FILES['img_first']['tmp_name'] , $dirPath)){
	                        $data_news_up['img_first'] = $one_news['id'] . '_main_'. "{$_FILES['img_first']['name']}";
	                    }else{
	                        $error[] = "Ошибка при загрузке главного изображения!";
	                    }  
                	}else{
                		$error[] = "Превышен размер файла главного изображения!";
                	}
                	                       
                }                         

                //изображения к 1-му текстовому блоку
                if ($_FILES['img_one']['size'][0] >0 && $_FILES['img_one']['size'][0] <= 3000000 && empty($error)) {
                	// удаление старых фотографий из папки
				    	$arr_img = [];		               		   
					    // изображения 1-го блока текста
					    if (!empty($one_news['img_one'])) {
					  	  $arr_img = array_merge($arr_img, json_decode($one_news['img_one']));
					    }					   	   
						$arr_img = deleteEmptyElement($arr_img);
					    // удаление изображения 1-го блока текста из папки		 
					    for ($i=0; $i < count($arr_img) ; $i++) { 
						     $img = ROOT . "/public/img_news/{$arr_img[$i]}";
						     if(file_exists($img)){
							    unlink($img);
						     }   
					    }
                	
                	$one_img_arr = [];
                    foreach($_FILES['img_one']['error'] as $key => $error_img) {                        	 
				        //Проверяем значение ошибки и не превышен ли допустимый размер	 
						if(!$error_img) {
							if ($_FILES['img_one']['size'][$key] <= 3000000) {
							 	//Адрес папки для сохранения
								$dirPath = ROOT . "/public/img_news/" . $one_news['id'] . "_one_". "{$_FILES['img_one']['name'][$key]}"; 			 
								if(move_uploaded_file($_FILES['img_one']['tmp_name'][$key], $dirPath)){
									$one_img_arr[] = $one_news['id'] . "_one_" . $_FILES['img_one']['name'][$key];
								}else{
									$error[] = "Ошибка при загрузке фото к 1-му текстовому блоку!";
								}	
							}else{
								$error[] = "Превышен размер файла к 1-му текстовому блоку!";
							}						 					
						} 
			        }
				    if (!empty($one_img_arr)) {
				    	$data_news_up['img_one'] = json_encode($one_img_arr);				    	 
				    }
                }                 
					    
			    //изображения ко 2-му текстовому блоку			    
			    	if ($_FILES['img_two']['size'][0] >0 && $_FILES['img_two']['size'][0] <= 3000000 && empty($error)) {
			    		$arr_img = [];			               	   
							  // удаление изображений 2-го блока текста из папки
							  if (!empty($one_news['img_two'])) {
							  	$arr_img = array_merge($arr_img, json_decode($one_news['img_two']));
							  }			   
							  $arr_img = deleteEmptyElement($arr_img);
							  // удаление изображений 2-го блока текста из папки		 
							  for ($i=0; $i < count($arr_img) ; $i++) { 
								   $img = ROOT . "/public/img_news/{$arr_img[$i]}";
								   if(file_exists($img)){
									  unlink($img);
								   }   
							  }

						// сохранение в папку и формирование массива с именами
				    	$two_img_arr = [];
	                    foreach($_FILES['img_two']['error'] as $key => $error_img) {                       	 
					        //Проверяем значение ошибки и не превышен ли допустимый размер	 
							if(!$error_img  ) { 
								if ($_FILES['img_two']['size'][$key] <= 3000000) {
									//Адрес папки для сохранения
									$dirPath = ROOT . "/public/img_news/" . $one_news['id'] . "_two_". "{$_FILES['img_two']['name'][$key]}"; 			 
									if(move_uploaded_file($_FILES['img_two']['tmp_name'][$key], $dirPath)){
										$two_img_arr[] = $one_news['id'] . "_two_" . $_FILES['img_two']['name'][$key];
									}else{
										$error[] = "Ошибка при загрузке фото ко 2-му текстовому блоку!";
									}
								}else{
									$error[] = "Превышен размер файла ко 2-му текстовому блоку!";
								}							 						
							} 
				        }
					    if (!empty($two_img_arr)) {
						    $data_news_up['img_two'] = json_encode($two_img_arr);
						       
					    }
			        }
			   

			    if (empty($error)) {                     
                    if (News::updateDataTable($data_news_up, 'news', $id_news)) {
                        $one_news = News::getOneNews($id_news);
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
		    
		    require_once ROOT . "/views/admin/admin_news_update.php";

    	}

    }
}
?>