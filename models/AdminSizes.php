<?php 
class AdminSizes{
	public static $table = 'sizes';

     // поиск размера по параметрам($name)
    public static function getSizeForParameter($col, $name){
		global $pdo; 		 
		$query = "SELECT * FROM " . self::$table . " WHERE $col=:name " ;
		$q = $pdo->prepare($query);
		$q->bindValue(':name', $name);		 		 
		$q->execute();
		return $result = $q->fetchAll();		 
	}
}
?>