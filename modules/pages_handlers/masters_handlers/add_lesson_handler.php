<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';

$title = $_POST["title"];
$description = $_POST["description"];
$lesson_photo_path=false;
$lesson_material_path=false;
$lesson_homeworkTask_path=false;

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

$lessonMaterialError='';
if(isset($_FILES['new_lesson_material']['name'])) { 

	$lesson_material_path = $_FILES['new_lesson_material']['name'];

	if (!move_uploaded_file($_FILES['new_lesson_material']['tmp_name'], '../../../lessons_materials/lesson_guides/'.$lesson_material_path)) {
		$response = [
			"status"=> false,
			"type" => 2
		];
		echo json_encode($response);
	} 
} else {
	$error_fields[]='new-lesson-material';
	$lessonMaterialError='Прикрепите материалы урока';
}

$lessonHomeworkTaskError='';
if(isset($_FILES['new_lesson_homeworkTask']['name'])) {

	$lesson_homeworkTask_path = $_FILES['new_lesson_homeworkTask']['name'];

	if (!move_uploaded_file($_FILES['new_lesson_homeworkTask']['tmp_name'], '../../../lessons_materials/homework_tasks/'.$lesson_homeworkTask_path)) {
		$response = [
			"status"=> false,
			"type" => 2
		];
		echo json_encode($response);
	} 
} else {
	$error_fields[]='new-lesson-homeworkTask';
	$lessonHomeworkTaskError='Прикрепите домашнее задание урока';
}

$lessonPhotoError='';
if(isset($_FILES['new_lesson_photo']['name'])) {

	$lesson_photo_path = $_FILES['new_lesson_photo']['name'];

	if (!move_uploaded_file($_FILES['new_lesson_photo']['tmp_name'], '../../../images/lessons_images/'.$lesson_photo_path)) {
		$response = [
			"status"=> false,
			"type" => 2
		];
		echo json_encode($response);
	} 
} else {
	$error_fields[]='new-lesson-photo';
	$lessonPhotoError='Прикрепите фото урока';
}


if(!empty($error_fields)) {
	$response = [
		"status"=> false,
		"type" => 1,
		"fields"=>$error_fields,
		"lessonTitleError"=>$lessonTitleError,
		"lessonDescriptionError"=>$lessonDescriptionError,
		"lessonMaterialError"=>$lessonMaterialError,
		"lessonHomeworkTaskError"=>$lessonHomeworkTaskError,
		"lessonPhotoError"=>$lessonPhotoError
	];
	echo json_encode($response);

	die();

} else {
	$addLessonQuery = "INSERT INTO Lesson(title, description, photo, lessonMaterial, homeworkTask) VALUES ('$title','$description', '$lesson_photo_path', '$lesson_material_path', '$lesson_homeworkTask_path')";
	$addLessonResult = mysqli_query($link, $addLessonQuery) or die("Ошибка".mysqli_error($link));

	$response = [
			"status"=> true,
		];
	echo json_encode($response);
}


/*if($title && $description && $lesson_photo_path){


	$addLessonQuery = "INSERT INTO Lesson(title, description, photo, lessonMaterial, homeworkTask) VALUES ('$title','$description', '$lesson_photo_path', '$lesson_material_path', '$lesson_homeworkTask_path')";
	$addLessonResult = mysqli_query($link, $addLessonQuery) or die("Ошибка".mysqli_error($link));
} else {
	echo "Ошибка. ";
}*/

/*if(!$title){
	
	echo "Добавьте название урока. ";
} 

if(!$description){
	

	echo "Добавьте описание урока. ";
} 

if(!$lesson_photo_path){
	

	echo "Добавьте фото урока. ";
}
	*/


?>