<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';

/*if (isset($_POST['lessons_id'] ) ) {
	$implodLessonsID = implode("','", $_POST['lessons_id']);
} else {
	$implodLessonsID = "";
}*/

$id_lesson_progress=$_POST["id_lesson_progress"];
$lesson_title=$_POST["lesson_title"];

$addLessonProgressQuery = "UPDATE Lesson_progress SET isChecked = '1' WHERE ID=$id_lesson_progress AND isChecked='0'";

$addLessonProgressResult = mysqli_query($link, $addLessonProgressQuery) or die("Ошибка".mysqli_error($link));


echo "<input type='checkbox' class='course-lessons-checkboxes lessons-ckbx' name='lesson' value='".$id_lesson_progress."' checked disabled>

		<label for='lesson'>".$lesson_title."</label>";

/*$checkLessonProgressQuery="SELECT * FROM Lesson_progress WHERE ID=$id_lesson_progress";

$checkLessonProgressResult = mysqli_query($link, $checkLessonProgressQuery) or die("Ошибка".mysqli_error($link));

if($checkLessonProgressResult) {
	$lesson_progress_row=mysqli_fetch_row($checkLessonProgressResult); 
	$lesson_progress=$lesson_progress_row[0];

	if($lesson_progress=='0'){
		
*/
		
		/*echo "<input type='checkbox' class='course-lessons-checkboxes lessons-ckbx' name='lesson' value='".$id_lesson_progress."' checked disabled>

		<label for='lesson'>Занятие cccccccccc</label>";*/



//echo count($_POST['id_lessons_progress']);

/*	}
}
 */
/*
$addLessonProgressQuery = "UPDATE Lesson_progress SET isChecked = 1 WHERE Lesson_progress.ID_organizedCourse=id_lesson_progress";

$addLessonProgressResult = mysqli_query($link, $addLessonProgressQuery) or die("Ошибка".mysqli_error($link));*/

?>