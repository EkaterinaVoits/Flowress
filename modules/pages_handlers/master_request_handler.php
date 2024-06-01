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

$id_user=$_SESSION['user']['id'];

$error_fields=[];

$user_telephone=$_POST["telephone"];
clearString($user_telephone); 

$telephoneError='';
//$regex_tel='/(?:\+375|80)\s?\(?\d\d\)?\s?\d\d(?:\d[\-\s]\d\d[\-\s]\d\d|[\-\s]\d\d[\-\s]\d\d\d|\d{5})/';
$regex_tel='/^\+375\s\((29|33|44|25)\)\s\d{3}-\d{2}-\d{2}$/';

if($user_telephone==='') {
	$error_fields[]='user_telephone_consult';
	$telephoneError='Заполните поле';
} elseif (!preg_match($regex_tel, $user_telephone)) {
	$error_fields[]='user_telephone_consult';
	$telephoneError='Введенный телефон соответствует требованиям';
}



$portfolioError='';


if(isset($_FILES['portfolio']['name'])) {
	$portfolio_path = 'portfolio'.$user_telephone.$_FILES['portfolio']['name'];
	if (!move_uploaded_file($_FILES['portfolio']['tmp_name'], '../../portfolio/'.$portfolio_path)) {
		$response = [
			"status"=> false,
			"type" => 2
		];
		echo json_encode($response);
	}
} else {
	$error_fields[]='portfolio';
	$portfolioError='Прикрепите Ваше портфолио';
}



if(!empty($error_fields)) {
	$response = [
		"status"=> false,
		"type" => 1,
		"fields"=>$error_fields,
		"telephoneError"=>$telephoneError,
		"portfolioError"=>$portfolioError,
	];
	echo json_encode($response);

	die();
} else {
	$query = "INSERT INTO Master_request(ID_user, telephone, portfolio) VALUES ('$id_user', '$user_telephone', '$portfolio_path')";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

	$response = [
			"status"=> true,
		];
	echo json_encode($response);
}




?>  