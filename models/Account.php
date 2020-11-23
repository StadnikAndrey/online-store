<?php
class Account {
	public static $table = 'users';
	// сохранение регистрационных данных юзера
	public static function save($user_data) {
		global $pdo;		 
 		if (isset($user_data)&&!empty($user_data)) {  
			$query = "INSERT INTO " . self::$table . " SET ";

			foreach ($user_data as $field => $value) {
				$query .= $field . ' = :' . $field . ', ';
			}

			$query = substr($query, 0, -2);
			$query .= ";";
			
			$q = $pdo->prepare($query);

			foreach ($user_data as $field => $value) {
				$q->bindValue(':' . $field, $value);
			}

			return $q->execute();
	    }
	}
	 
	// проверка существования юзера по email  
	public static function checkExists($email) {
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE email = :email";
		$q = $pdo->prepare($query);		 
		$q->bindValue(':email', $email);
		$q->execute();
		$user = $q->fetch();
		if(empty($user)) {
			return 'not_exists';
		} else {			 
			if($user['email'] == $email) {
				return 'email_exists';
			}			 
		}
	}

	// авторизация
		public static function authoris($email, $password) {
		$user = self::getByEmail($email);
		if(!empty($user)) {
			$auth = password_verify($password, $user['password_hash']);
		} else {
			$auth = false;
		}

		if($auth === true) {
			Account::resetTries();
			return $user;
		} else {
			return Account::badAuth();
		}
	}
	// получение всех данных пользователя по email
	public static function getByEmail($email) {
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE email = :email";
		$q = $pdo->prepare($query);
		$q->bindValue(':email', $email);
		$q->execute();
		return $user = $q->fetch();
	}
	// количество неудачных попыток входа и запись в файл
	public static function badAuth() {
		global $settings;
		$ip = $_SERVER['REMOTE_ADDR'];
		$file_url = ROOT . '/logs/' . $ip . '.txt';
		if(file_exists($file_url)) {
			$con = file_get_contents($file_url);
		} else {
			$con = 1;
		}
		
		if($con == $settings['login_tries']) {
			require_once(ROOT . '/views/access_denied.php');
		} else {
			$con++;
			file_put_contents($file_url, $con);
		}

		return $con;
	}
	// удаление файла с количеством неудачных попыток после авторизации
	public static function resetTries() {
		global $setting;
		$ip = $_SERVER['REMOTE_ADDR'];
		$file_url = ROOT . '/logs/' . $ip . '.txt';
		if(file_exists($file_url)) {
			unlink($file_url);
		}
	}

	// восстановление пароля юзера:
    // получение email  юзера по email
	public static function getEmail($email){
		global $pdo;
		$query = "SELECT email FROM " . self::$table . " WHERE email = :email";
		$q = $pdo->prepare($query);
		$q->bindValue(':email', $email);
		$q->execute();
		return $email = $q->fetch();
	}
	// генерация хеш, сохранение в БД в recover_hash соответственно email,
	// отправка ссылки пользователю в письме на его email
	public static function updateHash($email){
		global $pdo;
		$str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $substr =  substr(str_shuffle(random_int(0, 100000). str_shuffle($str)),random_int(0, 5),random_int(5, 15)) ;
            $hash = preg_replace('/[\/]{0,100}/','', password_hash($substr, PASSWORD_DEFAULT)); 
            global $pdo;
        	$query = "UPDATE   users  SET recover_hash = :hash   WHERE email = :email  ";
        $q = $pdo->prepare($query);
		$q->bindValue(':hash', $hash);
		$q->bindValue(':email', $email);
		$q->execute();

		$today = date("Y-m-d H:i:s");  
		$to      = $email;
		$subject = "Восстановление пароля //$today";
		// Для отправки HTML-письма должен быть установлен заголовок Content-type
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset = utf-8' . "\r\n";
		$headers .= 'From: shoptest@shoptest.kl.com.ua' . "\r\n" ;		 
		$message = "
		<html>
		<head>
		  <title>Birthday Reminders for August</title>
		</head>
		<body>
		  <a href=\"http://shoptest.kl.com.ua/hash/$hash\">Восстановить пароль</a> 
		</body>
		</html>
		";
		 
		mail($to, $subject, $message,$headers);
	}
	// поиск пользователя с recover_hash, таким-же как в ссылке
	public static function getRecoverHash($hash){
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE recover_hash = :recover_hash ";
		$q = $pdo->prepare($query);
		$q->bindValue(':recover_hash', $hash);
		$q->execute();
		return $user = $q->fetch();
	}
	// создание нового хеша пароля, сохранение в БД,
	// очищение recover_hash пользователя
	public static function newHash($pass,$id_user){
		$newHash = password_hash($pass, PASSWORD_DEFAULT);
		global $pdo;
        $query = "UPDATE "  . self::$table . " SET recover_hash = '' , password_hash = :newHash   WHERE id = :id  ";
        $q = $pdo->prepare($query);
		$q->bindValue(':newHash', $newHash);
		$q->bindValue(':id', $id_user);
		$q->execute();

	}

	// методы для личного кабинета:
	// получение данных пользователя
	public static function getUser($id_user){
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE id = :id_user";
		$q = $pdo->prepare($query);
		$q->bindValue(':id_user', $id_user);
		$q->execute();
		return $user = $q->fetch();
	}
	// изменение данных пользователя 
	public static function updateUserData($user_data,$user_id) {
		global $pdo;		 
 		if (isset($user_data)&&!empty($user_data)) {  
			$query = "UPDATE " . self::$table . " SET ";

			foreach ($user_data as $field => $value) {
				$query .= $field . ' = :' . $field . ', ';
			}
			 
			$query = substr($query, 0, -2);			 
			$query .= " WHERE id=$user_id ";
			
			$q = $pdo->prepare($query);

			foreach ($user_data as $field => $value) {
				$q->bindValue(':' . $field, $value);
			}

			return $q->execute();
	    }
	}
	// получение количества одинаковых email для исключения 
	// существования пользователей с одинаковым email (применяется при редактировании пользователем своих данных в кабинете)  
	public static function getQantityEmail($email) {
		global $pdo;
		$query = "SELECT COUNT(id) FROM " . self::$table . " WHERE email = :email";
		$q = $pdo->prepare($query);		 
		$q->bindValue(':email', $email);
		$q->execute();
		$email = $q->fetch();
		return $email;
	}	 
}
?>