<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';

$lesson_id = $_POST["lesson_id"];
$title = $_POST["title"];
$description = $_POST["description"];


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
	
$query = "UPDATE Lesson SET title='$title', description='$description', lessonMaterial = '$lesson_material_path', homeworkTask='$lesson_homeworkTask_path'  WHERE ID = '$lesson_id'";
	$result = mysqli_query($link, $query) or die("Ошибка " .mysqli_error($link));

?>