<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';


$org_course_id = $_POST["org_course_id"];


$dropScheduleQuery = "DELETE FROM Courses_schedule WHERE ID_organizedCourse = $org_course_id";
$resultDropSchedule= mysqli_query($link, $dropScheduleQuery) or die("Ошибка " . mysqli_error($link));

?>