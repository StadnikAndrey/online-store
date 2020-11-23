<?php 
class CabinetController{
	//переход по 'личный кабинет' или после авторизации
	public static function actionCabinet(){	
		if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
			$page = 'cabinet';	
			$menu = CoreController::getMainMenu();	
			// все заказы пользователя
			$allOrders = Orders::getAllOrdersUser($_SESSION['user']['id']);	
			// поиск по сайту
			if (isset($_POST['srch'])) {
				$result = Search::getResultSearch($_POST);			 
				if (!empty($result)) {
					header("location: /{$result[0]['link']}");
				}			 
		    }
			  
			require_once ROOT . "/views/cabinet/cabinet.php";
		}
		 
	}

	// переход по 'профиль'
	public static function actionProfile(){		 
		$page = 'profile';	 
		$menu = CoreController::getMainMenu();
		if (isset($_SESSION['user']) && !empty($_SESSION['user'])){
			// получение данных пользователя
		$user = Account::getUser($_SESSION['user']['id']);		 
		 
		// редактирование данных пользователя:
		// если отправлена форма изменения данных пользователя
		if (isset($_POST['btn_cabinet_profile_editing'])) {			 
			$error = [];
			$user_data = [];			 
		// имя
		if(mb_strlen($_POST['pr_ed_name']) < 100 && preg_match('/^[а-яА-Я\s-]{1,100}$/iu', $_POST['pr_ed_name'])) {
			$user_data['name'] = trim($_POST['pr_ed_name']);
		} else {
			 $error[] = 'Введите корректное имя кирилицей!';
		}
		// отчество
		if(mb_strlen($_POST['pr_ed_patronymic']) < 100 && preg_match('/^[а-яА-Я\s-]{1,100}$/iu', $_POST['pr_ed_patronymic'])) {
			$user_data['patronymic'] = trim($_POST['pr_ed_patronymic']);
		} else {
			 $error[] = 'Введите корректное отчество кирилицей!';
		}
		// фамилия
		if(mb_strlen($_POST['pr_ed_surname']) < 100 && preg_match('/^[а-яА-Я\s-]{1,100}$/iu', $_POST['pr_ed_surname'])) {
			$user_data['surname'] = trim($_POST['pr_ed_surname']);
		} else {
			 $error[] = 'Введите корректную фамилию кирилицей!';
		}
		// пол пользователя
		$user_data['gender'] = $_POST['pr_ed_gender'];		 
		// день рождения
		if ($_POST['pr_ed_year'] == '' || $_POST['pr_ed_month'] == '' || $_POST['pr_ed_day'] == '') {
				$user_data['date_of_birth'] = null;
			}else{
				$user_data['date_of_birth'] = trim($_POST['pr_ed_year'] . '-' . $_POST['pr_ed_month'] . '-' . $_POST['pr_ed_day']);
			}		 
		// номер мобильного телефона		 
		if (preg_match('/^(((\+38){0,1}|(38){0,1}|(8){0,1})([0-9]){10})$/iu', trim($_POST['pr_ed_mobile_number']))) {		 
			$user_data['mobile_number'] = trim($_POST['pr_ed_mobile_number']);
		}else{
			$error[] = 'Не корректный номер телефона!';
		}		  
		// e-mail
		if(mb_strlen($_POST['pr_ed_email']) < 100 && filter_var(trim($_POST['pr_ed_email']), FILTER_VALIDATE_EMAIL)) {	  
			$user_data['email'] = trim($_POST['pr_ed_email']);			 
		} else {
			$error[] = 'Не правильный E-mail!';
		}		 
		// если данные введены правильно     
		if (empty($error)) {
			  global $pdo;
			  $pdo->beginTransaction();
			 // редактирование данных пользователя
			 $updateUser = Account::updateUserData($user_data,$_SESSION['user']['id']);	
			 // проверка количества пользователей с одинаковым email		   
			 $quantity_email = Account::getQantityEmail($_POST['pr_ed_email']);
			 // если пользователей с одинаковым email нет:сохраняем отредактированные данные и получаем $user для отображения на странице профиля актуальных данных пользователя		  
			 if ($quantity_email['COUNT(id)']==1) {
			 	$pdo->commit();
			 	$user = Account::getUser($_SESSION['user']['id']);	
			 }else{
			 	$pdo->rollBack();
			 	$error[] = 'Пользователь с таким e-mail уже зарегистрирован!';
			 }
		}		 
				 
		}
		// ИЗМЕНЕНИЕ ПАРОЛЯ:		 
		if (isset($_POST['hidden_cabinet_profile_change_pass'])) {
			$error_ch_pass = [];
			// проверка правильности ввода старого пароля
			$check_old_pass = password_verify(trim($_POST['pr_ch_old_pass']), $user['password_hash']);
			if ($check_old_pass) {
					$user_data_change_pass = [];
					// пароль
					if(mb_strlen($_POST['pr_ch_new_pass']) > 5 && mb_strlen($_POST['pr_ch_new_pass']) < 20 &&
						mb_strlen($_POST['pr_ch_new_pass_confirm']) > 5  && mb_strlen($_POST['pr_ch_new_pass_confirm']) < 20){
							if (trim($_POST['pr_ch_new_pass']) == trim($_POST['pr_ch_new_pass_confirm'])) {
								  $user_data_change_pass['password_hash'] = trim(password_hash($_POST['pr_ch_new_pass'], PASSWORD_DEFAULT));
								 
							}else{
								$error_ch_pass[] = 'Пароль и подтверждение пароля не совпадают!';
							}
						 
					} else {
						 $error_ch_pass[] = 'Пароль должен содержать от 6 до 20 символов';
					}         

					if (empty($error_ch_pass)) {
						    $user_pass_update = Account::updateUserData($user_data_change_pass,$user['id']);
							if ($user_pass_update) {
								session_destroy();
								header('Location: /login');
								exit;									 
							}else{
								$error_ch_pass[] = 'Смена пароля в данный момент не возможна по техническим причинам!';
							}
					}

			}else{
				$error_ch_pass[] = 'Неправильный старый пароль!';
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
 
		require_once ROOT . "/views/cabinet/profile.php";
	}
}
?>