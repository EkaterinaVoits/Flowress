<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<link rel="stylesheet" href="../../css/style.css" type="text/css">
<link rel="stylesheet" href="../../css/course_schedule_style.css" type="text/css">
<link rel="stylesheet" href="../../css/course_item_style.css" type="text/css">
<link rel="stylesheet" href="../../css/course_style.css" type="text/css">	
<?php

//$id_orgCourse=$_GET['id_orgCourse'];
if(isset($_SESSION['user']['id'])) {
	$id_user=$_SESSION['user']['id'];
} else {
	$id_user="";
} 

$organizedCourseResult = mysqli_query($link, $organizedCourseQuery) or die("Ошибка".mysqli_error($link));

if($organizedCourseResult)
{
	$rows = mysqli_num_rows($organizedCourseResult); 


	for($c = 0; $c < $rows; ++$c)
	{
		$organizedCourse = mysqli_fetch_assoc($organizedCourseResult); 
		$id_organizedCourse=$organizedCourse['ID'];

		$countRegCourseQuery = "SELECT Count(*) FROM Course_registration JOIN Status ON Course_registration.ID_status=Status.ID WHERE Status.ID IN (4,5) AND ID_organizedCourse='$id_organizedCourse'";
		$countRegCourseResult = mysqli_query($link, $countRegCourseQuery) or die("Ошибка".mysqli_error($link));

		if ($countRegCourseResult) {
			$registrations = mysqli_fetch_row($countRegCourseResult);
			$countRegistrations=$registrations[0];

			//если количество оплаченных заявок меньше чем вместительность группы, то вывести карточку курса
			if($countRegistrations<$organizedCourse['groupSize']) {

				echo "
				<div class='course-item'>

				<div class='course-white-rect'> 
				<div class='course-item-content'>

				<div class='course-item-content-wrapper'>

				<div class='course-item-title'>".$organizedCourse['title']."</div>

				<div class='course-item-description'>
				
				<div><span>Начало: </span>".date('d.m.Y', strtotime($organizedCourse['startDate']))."</div>
				<div><span>Группа: </span>".$organizedCourse['groupType']."</div>";

				$countLessonsQuery = "SELECT COUNT(*) FROM Course_lessons JOIN Course ON Course_lessons.ID_course=Course.ID JOIN Organized_course ON Organized_course.ID_course=Course.ID WHERE Organized_course.ID=$id_organizedCourse";
				$countLessonsResult = mysqli_query($link, $countLessonsQuery) or die("Ошибка".mysqli_error($link));

				if($countLessonsResult) {

					$countLessons=mysqli_num_rows($countLessonsResult)+1;
					$countHours=$countLessons*3.5;

					echo "
					<div><span>Клоичество занятий: </span>".$countLessons." урока (".$countHours." часов)</div>";
				}

				echo "
				<div class='course-item-schedule'><span>График: </span> ";


				$scheduleQuery = "SELECT * FROM Courses_schedule JOIN DateTime_class ON Courses_schedule.ID_dateTimeClass=DateTime_class.ID  WHERE Courses_schedule.ID_organizedCourse=$id_organizedCourse";
				$scheduleResult = mysqli_query($link, $scheduleQuery) or die("Ошибка".mysqli_error($link));

				if($scheduleResult) 
				{	
					$rows3 = mysqli_num_rows($scheduleResult);
					for($s = 0; $s < $rows3; ++$s) 
					{
						$schedule = mysqli_fetch_assoc($scheduleResult); 
						echo "<p>".$schedule['day']."-".date('H:i', strtotime($schedule['time']))." </p>
						";
					}
					mysqli_free_result($scheduleResult);
				}

				echo "
				</div>
				<div><span>Преподаватель: </span><a href='index.php'>
				".$organizedCourse['name']."</a></div>	
				</div>

				<div class='course-item-title'>Стоимость: ".$organizedCourse['price']*$organizedCourse['priceCoefficient']."  BYN</div>	
				
				<div class='course-item-title'>Осталось ".$organizedCourse['groupSize']-$countRegistrations." свободных мест из ".$organizedCourse['groupSize']."</div>
				
				<div class='status-or-reserve-btn".$organizedCourse['ID']."'>";

				$regQuery = "SELECT * FROM Course_registration JOIN Status ON Course_registration.ID_status=Status.ID WHERE ID_user='$id_user' AND ID_organizedCourse='$id_organizedCourse'";
				$regResult = mysqli_query($link, $regQuery) or die("Ошибка".mysqli_error($link));

				if(mysqli_num_rows($regResult)>0) {

					$registration = mysqli_fetch_assoc($regResult);
					echo "<div class='status'>".$registration['status']."</div>";

				} else {

					if(isset($_SESSION['user']['id'])) {
						echo "<button class='course-item-button' onclick='applyCourse(this.id)' id=".$organizedCourse['ID'].">Подать заявку</button>";
					//echo "<div class='show_status' id='status".$row[0]."'>Заявка подана</div>"; 

					} else {
						echo "<div class='log-in'><a href='../modules/authorization/authorization.php'>Войдите</a> или <a href='../modules/registration/registration.php'>зарегистрируйтесь</a>, чтобы подать заявку</div>"; 
					}
				}

				echo "

				</div>
				</div>
				</div>

				<div class='two-lines'></div>
				</div>
				</div>
				";


			}
		}

		
		
	}
	
}

?>