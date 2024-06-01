<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';

$user_id=$_SESSION['user']['id'];

$masterScheduleQuery = "SELECT DateTime_class.day, DateTime_class.time, DateTime_class.ID_groupType  FROM Master JOIN User ON User.ID=Master.ID_user JOIN Organized_course ON Organized_course.ID_master=Master.ID JOIN Courses_schedule ON Organized_course.ID=Courses_schedule.ID_organizedCourse JOIN DateTime_class ON Courses_schedule.ID_dateTimeClass=DateTime_class.ID WHERE Organized_course.isEnded=0 AND User.ID='$user_id'";
$masterScheduleResult = mysqli_query($link, $masterScheduleQuery) or die("Ошибка".mysqli_error($link)); 
$masterScheduleRows = mysqli_num_rows($masterScheduleResult);
$days=array();

for($s = 0; $s < $masterScheduleRows; ++$s) 
{
	$masterScheduleRow = mysqli_fetch_row($masterScheduleResult); 
	$days[]=$masterScheduleRow[0];
}



if ($_POST["schedule_items_array"] && $_POST["org_course_item_id"]){

	$org_course_item_id=$_POST['org_course_item_id'];


	for($i = 0; $i < count($_POST['schedule_items_array']); ++$i) 
	{
		$schedule_id= $_POST['schedule_items_array'][$i];

		$findDayTimeQuery = "SELECT DateTime_class.day, DateTime_class.time, DateTime_class.ID_groupType  FROM DateTime_class WHERE ID='$schedule_id'";
		$findDayTimeResult = mysqli_query($link, $findDayTimeQuery) or die("Ошибка".mysqli_error($link));

		$dayTime = mysqli_fetch_row($findDayTimeResult); 
		$day=$dayTime[0];
		$time=$dayTime[1];
		$id_groupType=$dayTime[2];

		//работает ли преподаватель в этот день
		if(in_array($day,$days)){

			$masterScheduleQuery2 = "SELECT * FROM Master JOIN User ON User.ID=Master.ID_user JOIN Organized_course ON Organized_course.ID_master=Master.ID JOIN Courses_schedule ON Organized_course.ID=Courses_schedule.ID_organizedCourse JOIN DateTime_class ON Courses_schedule.ID_dateTimeClass=DateTime_class.ID WHERE Organized_course.isEnded=0 AND User.ID='$user_id' AND DateTime_class.day='$day' AND DateTime_class.id_groupType='$id_groupType'";
			$masterScheduleResult2 = mysqli_query($link, $masterScheduleQuery2) or die("Ошибка".mysqli_error($link));

			$masterScheduleRows2 = mysqli_num_rows($masterScheduleResult2);
			if($masterScheduleRows2!=0) {
				echo "<div style='color:red;'>Невозможно добавить ".$day."-".$time.", так как это время в этот день уже занято</div>";
			} else {
				$addScheduleQuery = "INSERT INTO Courses_schedule(ID_dateTimeClass, ID_organizedCourse) VALUES ('$schedule_id', '$org_course_item_id')";
				$addScheduleResult = mysqli_query($link, $addScheduleQuery) or die("Ошибка".mysqli_error($link));
			}

		} else {
			$addScheduleQuery = "INSERT INTO Courses_schedule(ID_dateTimeClass, ID_organizedCourse) VALUES ('$schedule_id', '$org_course_item_id')";
			$addScheduleResult = mysqli_query($link, $addScheduleQuery) or die("Ошибка".mysqli_error($link));
		}
	}
}


if($addScheduleResult){

	//вывод в карточке
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