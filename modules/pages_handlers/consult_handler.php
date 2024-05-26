<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\connect\connect_database.php';


//---Функция обрабатывающая поля---
function clearString($str) {
		$str = trim($str); //удаляем пробелы 
		$str = strip_tags($str); //удаляем теги HTML
		$str = stripslashes($str); //удаляем экранирование символов
		if(isset($str)) {
			return $str;
		}	
	} 


$error_fields=[];

$user_name=$_POST["user_name"];
clearString($user_name); 

$nameError='';
$regex_name = '/[А-ЯA-Z]{1}[а-яa-z]{2,}/u';

if($user_name==='') {
	$error_fields[]='user_name_consult';
	$nameError='Заполните поле';
} elseif (!preg_match($regex_name, $user_name)) {
	$error_fields[]='user_name_consult';
	$nameError='Введенное имя не соответствует требованиям';
}


$user_telephone=$_POST["user_telephone"];
clearString($user_telephone); 

$telephoneError='';
/*regex_tel='/(?:\+375|80)\s?\(?\d\d\)?\s?\d\d(?:\d[\-\s]\d\d[\-\s]\d\d|[\-\s]\d\d[\-\s]\d\d\d|\d{5})/';*/
$regex_tel='/^\+375\s\((29|33|44|25)\)\s\d{3}-\d{2}-\d{2}$/';

if($user_telephone==='') {
	$error_fields[]='user_telephone_consult';
	$telephoneError='Заполните поле';
} elseif (!preg_match($regex_tel, $user_telephone)) {
	$error_fields[]='user_telephone_consult';
	$telephoneError='Введенный телефон не соответствует требованиям';
}

if(!empty($error_fields)) {
	$response = [
		"status"=> false,
		"type" => 1,
		"fields"=>$error_fields,
		"nameError"=>$nameError,
		"telephoneError"=>$telephoneError,
	];
	echo json_encode($response);

	die();
} else {
	$query = "INSERT INTO Consultation(user_name, user_telephone, ID_status) VALUES ('$user_name', '$user_telephone', 1)";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

	$response = [
			"status"=> true,
		];
	echo json_encode($response);
}




?>  