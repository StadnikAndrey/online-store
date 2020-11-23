<?php 
class AccountController{
	// переход по пункту меню "ВОЙТИ" для входа или регистрации  
	public static function actionEntrance(){
		// авторизация пользователя
		global $settings;
		if (isset($_POST['entrance_submit'])) {
			$error_messages = [];
			if ( isset($_POST['entrance_email']) && !empty($_POST['entrance_email']) &&
			    isset($_POST['entrance_password']) && !empty($_POST['entrance_password']) ) {
				$auth = Account::authoris($_POST['entrance_email'], $_POST['entrance_password']);				 
				if(is_array($auth) && isset($auth['id']) && !empty($auth['id']) && $auth['is_ban'] ==1) {
					$error_messages[] = 'Ваша учетная запись заблокирована администратором!';					 
				}else if(is_array($auth) && isset($auth['id']) && !empty($auth['id']) && $auth['is_ban'] !=1 ) {
					$_SESSION['user'] = $auth;
					header("Location: /cabinet");
					exit;
				} else {
					$error_messages[] = "Неудачная попытка входа. Количество оставшихся попыток " . (($settings['login_tries'] +1) - $auth)  ;
				}

			}else{
				$error_messages[] = 'Введены не все данные!';
			}
			 
		}
		require_once ROOT . "/views/account/entrance.php";
	}

	// регистрация пользователя (с валидацией формы регистрации)
	public static function actionRegistration(){		 
		$menu = CoreController::getMainMenu();
		if (isset($_POST['registration_submit'])) {
			$error = [];
			$user_data = [];			 
			// имя
			if(mb_strlen($_POST['name']) < 100 && preg_match('/^[а-яА-Я\s-]{1,100}$/iu', $_POST['name'])) {
				$user_data['name'] = trim($_POST['name']);
			} else {
				 $error[] = 'Введите корректное имя кирилицей!';
			}
			// отчество
			if(mb_strlen($_POST['patronymic']) < 100 && preg_match('/^[а-яА-Я\s-]{1,100}$/iu', $_POST['patronymic'])) {
				$user_data['patronymic'] = trim($_POST['patronymic']);
			} else {
				 $error[] = 'Введите корректное отчество кирилицей!';
			}
			// фамилия
			if(mb_strlen($_POST['surname']) < 100 && preg_match('/^[а-яА-Я\s-]{1,100}$/iu', $_POST['surname'])) {
				$user_data['surname'] = trim($_POST['surname']);
			} else {
				 $error[] = 'Введите корректную фамилию кирилицей!';
			}
			// пол пользователя
			$user_data['gender'] = $_POST['gender'];
			// день рождения
			if ($_POST['year'] == '' || $_POST['month'] == '' || $_POST['day'] == '') {
					$user_data['date_of_birth'] = null;
				}else{
					$user_data['date_of_birth'] = trim($_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day']);
				}		 
			// номер мобильного телефона		 
			if (preg_match('/^(((\+38){0,1}|(38){0,1}|(8){0,1})([0-9]){10})$/iu', trim($_POST['mobile_number']))) {		 
				$user_data['mobile_number'] = trim($_POST['mobile_number']);
			}else{
				$error[] = 'Не корректный номер телефона!';
			}		  
			// e-mail
			if(mb_strlen($_POST['email']) < 100 && filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
				$exist_email = Account::checkExists(trim($_POST['email']));
				if ($exist_email == 'not_exists') {
					$user_data['email'] = trim($_POST['email']);
				}else{
					$error[] = 'Пользователь с таким e-mail уже зарегистрирован!';
				}
			 
			} else {
				$error[] = 'Не правильный E-mail!';
			}		 
			// hash пароля
			if(mb_strlen($_POST['password']) > 5 && mb_strlen($_POST['password']) < 20 &&
				mb_strlen($_POST['password_confirmation']) > 5  && mb_strlen($_POST['password_confirmation']) < 20){
					if (trim($_POST['password']) == trim($_POST['password_confirmation'])) {
						$user_data['password_hash'] = trim(password_hash($_POST['password'], PASSWORD_DEFAULT));
					}else{
						$error[] = 'Пароль и подтверждение пароля не совпадают!';
					}
				 
			} else {
				 $error[] = 'Пароль должен содержать от 6 до 20 символов';
			}         

			if (empty($error)) {
				$user_exist = Account::checkExists(trim($_POST['email']));
					if ($user_exist == 'not_exists') {
						$registration = Account::save($user_data);
						if($registration === true) {
								  header('Location: /login');
								  exit;
							}
					}else{
						$error[] = 'Пользователь с таким e-mail уже существует!';
					}
			}				 
			 
		}		 
		require_once ROOT . "/views/account/registration.php";
	}

	// вход (авторизация) сразу после регистрации пользователя
	public static function actionLogin(){
		global $settings;
		$menu = CoreController::getMainMenu();
		if (isset($_POST['login_submit'])) {
			$error_messages = [];
			if ( isset($_POST['login_email']) && !empty($_POST['login_email']) &&
			    isset($_POST['login_password']) && !empty($_POST['login_password']) ) {

				$auth = Account::authoris($_POST['login_email'], $_POST['login_password']);			 
				if(is_array($auth) && isset($auth['id']) && !empty($auth['id'])) {
					$_SESSION['user'] = $auth;
					header("Location: /cabinet");
					exit;
				} else {
					$error_messages[] = "Неудачная попытка входа. Количество оставшихся попыток " . (($settings['login_tries'] +1) - $auth)  ;
				}

			}else{
				$error_messages[] = 'Введены не все данные!';
			}
			 
		}
		require_once ROOT . "/views/account/login.php";		 
	}
	 
	// выход
	public static function actionLogout() {
		session_destroy();
		header("Location: /");
		exit;
	}

	// восстановление пароля:
	// форма при переходе по "Забыли пароль?"
	public static function actionRecovery(){
		$error_messages = array();
		if (isset($_POST['recovery_pass_submit'])) {
			if (isset($_POST['recovery_pass_email']) && !empty($_POST['recovery_pass_email'])
	        && filter_var($_POST['recovery_pass_email'], FILTER_VALIDATE_EMAIL)) {    		   
	        $email = Account::getEmail($_POST['recovery_pass_email']);
	        if ($email) {   
	        	Account::updateHash($_POST['recovery_pass_email']);
	        	$error_messages[] = 'Вам отправлено письмо. Перейдите по ссылке в письме для смены пароля!';
	        }else{
	        	$error_messages[] = 'Не верный адрес электронной почты!';
	        	}
        }else{
        	$error_messages[] = 'Введите правильный email!';
        	}
		}
	     
		include_once ROOT . '/views/account/recovery_pass.php';	 
	}
	
	// форма создания нового пароля при переходе по ссылке из письма
	public static function actionCreateNewPassword($hash){
		$userHash = Account::getRecoverHash($hash);		 
		if ($userHash) {
			$error_messages = array();
			if (isset($_POST['new_pass_submit'])) {
				if (strlen($_POST['new_pass'])<6 && strlen($_POST['new_pass_confirmation'])<6 ){
					$error_messages[] = 'Пароль должен содержать не меньше 6 символов';
				}else if ($_POST['new_pass'] == $_POST['new_pass_confirmation']) {		 	 	 
				 	 	  $newHash = Account::newHash($_POST['new_pass'],$_POST['new_pass_submit']);		 	 	 
				 	 	  $error_messages[] = 'Пароль успешно изменен!';				 	 	   
				 	      }else{
			 		           $error_messages[] = 'Пароль и подтверждение пароля не совпадают!!'; 
			 	               }
			}		
			require_once ROOT . "/views/account/create_new_password.php";
		}else{
			require_once ROOT . "/views/account/empty.php";
			exit;
			}
	}		 
}
?>