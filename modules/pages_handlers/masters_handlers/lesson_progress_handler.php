<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';

/*if (isset($_POST['lessons_id'] ) ) {
	$implodLessonsID = implode("','", $_POST['lessons_id']);
} else {
	$implodLessonsID = "";
}*/

$id_lessons_progress=$_POST["id_lessons_progress"];

//echo count($_POST['id_lessons_progress']);

for($i = 0; $i < count($_POST['id_lessons_progress']); ++$i) 
{
	//echo($_POST['lessons_id'][$i]);
	$lesson_progress_id= $_POST['id_lessons_progress'][$i];

	$checkLessonProgressQuery="SELECT isChecked FROM Lesson_progress WHERE ID=$lesson_progress_id";

	$checkLessonProgressResult = mysqli_query($link, $checkLessonProgressQuery) or die("Ошибка".mysqli_error($link));

	if($checkLessonProgressResult) {
		$lesson_progress_row=mysqli_fetch_row($checkLessonProgressResult); 
		$lesson_progress=$lesson_progress_row[0];

		if($lesson_progress=='0'){
			$addLessonProgressQuery = "UPDATE Lesson_progress SET isChecked = '1' WHERE ID=$lesson_progress_id AND isChecked='0'";

			$addLessonProgressResult = mysqli_query($link, $addLessonProgressQuery) or die("Ошибка".mysqli_error($link));

				
		} /*else {
			$deleteLessonProgressQuery = "UPDATE Lesson_progress SET isChecked = '0' WHERE ID=$lesson_progress_id AND isChecked='1'";

			$deleteLessonProgressResult = mysqli_query($link, $deleteLessonProgressQuery) or die("Ошибка".mysqli_error($link));
		}*/
	}
}

/*
$addLessonProgressQuery = "UPDATE Lesson_progress SET isChecked = 1 WHERE Lesson_progress.ID_organizedCourse=id_lesson_progress";

$addLessonProgressResult = mysqli_query($link, $addLessonProgressQuery) or die("Ошибка".mysqli_error($link));*/

?>