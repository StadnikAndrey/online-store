<?php 
class AdminSubcategory{
     public static $table = 'subcategory';

     // поиск субкатегории по параметрам($name)
    public static function getSubcategoryForParameter($col, $name){
		global $pdo; 		 
		$query = "SELECT * FROM " . self::$table . " WHERE $col=:name " ;
		$q = $pdo->prepare($query);
		$q->bindValue(':name', $name);		 		 
		$q->execute();
		return $result = $q->fetchAll();		 
	}

}
?>