<?php 
class AdminStatusOrder{
	public static $table = 'order_statuses';

     // поиск статуса по параметрам($name)
    public static function getStatusForParameter($col, $name){
		global $pdo; 		 
		$query = "SELECT * FROM " . self::$table . " WHERE $col=:name " ;
		$q = $pdo->prepare($query);
		$q->bindValue(':name', $name);		 		 
		$q->execute();
		return $result = $q->fetchAll();		 
	}
}
?>