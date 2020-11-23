<?php 
class Search{
	public static $table = 'search';

	public static function getResultSearch($post){
		global $pdo;
		if (isset($post['srch']) 
			&& preg_match('/^[а-яА-я\s]{4,150}$/iu', trim($post['srch']) )){
			$search  = htmlspecialchars(trim($post['srch']));			 	 
		    }else{
		    	$search = '';
		    }
		      
		 if ($search != '') {
		 	$query = "SELECT * FROM " . self::$table . " WHERE quest LIKE '%$search%' ";		 
			$q = $pdo->query($query);	
			$result = $q->fetchAll(); 
		 
			return $result;
		 }	 
	}	 
}
?>