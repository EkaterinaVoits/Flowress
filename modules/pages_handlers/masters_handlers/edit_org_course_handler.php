<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';

$org_course_id = $_POST["org_course_id"];
$course_startDate = $_POST["course_startDate"];
$course_groupType_id = $_POST["course_groupType_id"];

	$query = "UPDATE Organized_course SET startDate='$course_startDate', ID_groupType='$course_groupType_id' WHERE ID = '$org_course_id'";
	$result = mysqli_query($link, $query) or die("Ошибка " .mysqli_error($link));
	


?>