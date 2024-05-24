<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';

$course_id = $_POST["course_id"];
$master_id = $_POST["master_id"];
$course_startDate = $_POST["course_startDate"];
$course_groupType_id = $_POST["course_groupType_id"];	

if($course_id && $master_id && $course_startDate && $course_groupType_id) {

	if(true){
		$addOrgCourseQuery = "INSERT INTO Organized_course(ID_course, ID_master, ID_groupType,  startDate) VALUES ('$course_id','$master_id','$course_groupType_id', '$course_startDate')";
		$orgCourseResult = mysqli_query($link, $addOrgCourseQuery) or die("Ошибка".mysqli_error($link));

		if(!$orgCourseResult) {
			echo "Что-то пошло не так";
		}
	}
} else if (!$course_startDate) {
	echo "Выберите дату начала курса";
}



?>