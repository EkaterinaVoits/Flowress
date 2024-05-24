<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';

$title = $_POST["title"];
$description = $_POST["description"];
$lesson_photo_path=false;

if(isset($_FILES['new_lesson_material']['name'])) {

	$lesson_material_path = $_FILES['new_lesson_material']['name'];

	if (!move_uploaded_file($_FILES['new_lesson_material']['tmp_name'], '../../../lessons_materials/lesson_guides/'.$lesson_material_path)) {
	} 
} 

if(isset($_FILES['new_lesson_homework']['name'])) {

	$lesson_homeworkTask_path = $_FILES['new_lesson_homework']['name'];

	if (!move_uploaded_file($_FILES['new_lesson_homework']['tmp_name'], '../../../lessons_materials/homework_tasks/'.$lesson_homeworkTask_path)) {
	} 
} 

if(isset($_FILES['new_lesson_photo']['name'])) {

	$lesson_photo_path = $_FILES['new_lesson_photo']['name'];

	if (!move_uploaded_file($_FILES['new_lesson_photo']['tmp_name'], '../../../images/lessons_images/'.$lesson_photo_path)) {
	} 
} 

if($title && $description && $lesson_photo_path){

	/*$response = [
		"status"=>true
	];
	echo json_encode($response);*/

	$addLessonQuery = "INSERT INTO Lesson(title, description, photo, lessonMaterial, homeworkTask) VALUES ('$title','$description', '$lesson_photo_path', '$lesson_material_path', '$lesson_homeworkTask_path')";
	$addLessonResult = mysqli_query($link, $addLessonQuery) or die("Ошибка".mysqli_error($link));
} else {
	echo "Ошибка. ";
}

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