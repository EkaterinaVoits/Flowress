<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';

$lesson_id = $_POST["lesson_id"];
$title = $_POST["title"];
$description = $_POST["description"];
$lesson_material_path2 = $_POST["lesson_material_path"];
$lesson_homeworkTask_path2 = $_POST["lesson_homework_path"];

$error_fields=[];

$regex='/^[а-яА-ЯёЁa-zA-Z0-9]+$/u';
$regex2='/[\p{L}\s\d,.!?;:\'"]+[.!?]?$/u';

$lessonTitleError='';
if($title==null) {
	$error_fields[]='lesson-title';
	$lessonTitleError='Заполните поле';
} elseif (!preg_match($regex, $title)) {
	$error_fields[]='lesson-title';
	$lessonTitleError='Название урока не соответствует требованиям';
}

$lessonDescriptionError='';
if($description==null) {
	$error_fields[]='lesson-description';
	$lessonDescriptionError='Заполните поле';
} elseif (!preg_match($regex2, $description)) {
	$error_fields[]='lesson-description';
	$lessonDescriptionError='Описание урока не соответствует требованиям';
}


if(isset($_FILES['new2_lesson_material']['name'])) {

	$lesson_material_path2 = $_FILES['new2_lesson_material']['name'];

	if (!move_uploaded_file($_FILES['new2_lesson_material']['tmp_name'], '../../../lessons_materials/lesson_guides/'.$lesson_material_path2)) {
	} 

	$query = "UPDATE Lesson SET lessonMaterial = '$lesson_material_path2' WHERE ID = '$lesson_id'";
	$result = mysqli_query($link, $query) or die("Ошибка " .mysqli_error($link));
} 

if(isset($_FILES['new2_lesson_homework']['name'])) {

	$lesson_homeworkTask_path2 = $_FILES['new2_lesson_homework']['name'];

	if (!move_uploaded_file($_FILES['new2_lesson_homework']['tmp_name'], '../../../lessons_materials/homework_tasks/'.$lesson_homeworkTask_path2)) {
	} 
	$query = "UPDATE Lesson SET homeworkTask = '$lesson_homeworkTask_path2' WHERE ID = '$lesson_id'";
	$result = mysqli_query($link, $query) or die("Ошибка " .mysqli_error($link));
} 


if(!empty($error_fields)) {
	$response = [
		"status"=> false,
		"type" => 1,
		"fields"=>$error_fields,
		"lessonTitleError"=>$lessonTitleError,
		"lessonDescriptionError"=>$lessonDescriptionError,
	];
	echo json_encode($response);

	die();

} else {
	$query = "UPDATE Lesson SET title='$title', description='$description' WHERE ID = '$lesson_id'";
	$result = mysqli_query($link, $query) or die("Ошибка " .mysqli_error($link));
	$response = [
			"status"=> true,
		];
	echo json_encode($response);
}
	


?>