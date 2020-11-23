<?php 
class AdminBrands{
     public static $table = 'brands';

     // поиск бренда по параметрам($name)
    public static function getBrandForParameter($col, $name){
		global $pdo; 		 
		$query = "SELECT * FROM " . self::$table . " WHERE $col=:name " ;
		$q = $pdo->prepare($query);
		$q->bindValue(':name', $name);		 		 
		$q->execute();
		return $result = $q->fetchAll();		 
	}
}
?>