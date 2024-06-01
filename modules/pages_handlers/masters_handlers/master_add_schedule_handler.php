<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';

$user_id=$_SESSION['user']['id'];
/*
$masterQuery = "SELECT DateTime_class.day, DateTime_class.time FROM Courses_schedule JOIN DateTime_class ON DateTime_class.ID=Courses_schedule.ID_dateTimeClass WHERE Courses_schedule.ID_organizedCourse=$org_course_item_id";
$scheduleResult = mysqli_query($link, $scheduleQuery) or die("Ошибка".mysqli_error($link));*/

if ($_POST["schedule_items_array"] && $_POST["org_course_item_id"]){



	for($i = 0; $i < count($_POST['schedule_items_array']); ++$i) 
	{
		$schedule_id= $_POST['schedule_items_array'][$i];
		$org_course_item_id=$_POST['org_course_item_id'];

		$addScheduleQuery = "INSERT INTO Courses_schedule(ID_dateTimeClass, ID_organizedCourse) VALUES ('$schedule_id', '$org_course_item_id')";
		$addScheduleResult = mysqli_query($link, $addScheduleQuery) or die("Ошибка".mysqli_error($link));

	}
}


if($addScheduleResult){
	$scheduleQuery = "SELECT DateTime_class.day, DateTime_class.time FROM Courses_schedule JOIN DateTime_class ON DateTime_class.ID=Courses_schedule.ID_dateTimeClass WHERE Courses_schedule.ID_organizedCourse=$org_course_item_id";
	$scheduleResult = mysqli_query($link, $scheduleQuery) or die("Ошибка".mysqli_error($link));

	if($scheduleResult) 
	{	
		$scheduleRows = mysqli_num_rows($scheduleResult);
		if($scheduleRows!=0) {
			echo "<div class='course-item-schedule'><span>График: </span> ";
			for($s = 0; $s < $scheduleRows; ++$s) 
			{
				$schedule = mysqli_fetch_assoc($scheduleResult); 
				echo "<p style='margin-left:5px;'> ".$schedule['day']."-".date('H:i', strtotime($schedule['time']))." </p>
				";
			}
			mysqli_free_result($scheduleResult);
		}
	}

}




?>