<?php
// удаление пустых элементов массива
function deleteEmptyElement($arr){
	$newArr = [];
        	foreach ($arr as $key => $value) {
        		if (!empty($value)) {
        			$newArr[] = $value;
        		}
        	}
    return $newArr;
}
// сохранение введенных даных в полях формы при неудачной отправке
function getArrVal($array, $key) {
	if(is_array($array)) {
			if(array_key_exists($key, $array)) {
			return $array[$key];
		} else {
			return '';
		}
	} else {
		return '';
	}
}
// склонение слова 'товар' для страницы оформление заказа
function declensionWord($quantity){ 
	if($quantity>=5 && $quantity<=20){
		return 'товаров';
	}else if ($quantity%10 == 1) {
		return 'товар';
	}else if ($quantity%10 >= 2 && $quantity%10 <= 4) {
		return 'товара';
	}else{
		return 'товаров';
	}

}
// сохранение значения выпадающего списка при неудачной отправке формы
function selected($post,$name,$value) {
	if (isset($post[$name])) {                
        if ($post[$name] == $value) {
         echo 'selected';
        }else{
     	   echo '';
        }      
   }
}
 
// сохранение значения радио-кнопок
function checkedRadio($post,$name,$value) {
	if (isset($post[$name])) {                
        if ($post[$name] == $value) {
         echo 'checked';
        }else{
     	   echo '';
        }      
   }
}
 
?>