<?php 
class Connection {
	public static function connect() {
		global $settings;
		$host = $settings['db_address'];
		$db = $settings['db_name'];
		$charset = 'utf8';
		$login = $settings['db_user'];
		$pass = $settings['db_pass'];
		$pdoOpts = array(
		    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC 
		);

		if(DEBUG_MODE === true) {
			$pdoOpts[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		}
		return new PDO("mysql:host=$host;dbname=$db;charset=$charset", $login,$pass, $pdoOpts);
	}

}

?>