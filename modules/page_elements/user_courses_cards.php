<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<link rel="stylesheet" href="../../css/style.css" type="text/css">
<link rel="stylesheet" href="../../css/profile_page_style.css" type="text/css">
<link rel="stylesheet" href="../../css/course_item_style.css" type="text/css">
<link rel="stylesheet" href="../../css/course_style.css" type="text/css">
<?php

if(isset($_SESSION['user']['id'])) {
	$id_user=$_SESSION['user']['id'];
} else {
	$id_user="";
} 

$result2 = mysqli_query($link, $query2) or die("Ошибка".mysqli_error($link));

if($result2)
{
	$rows = mysqli_num_rows($result2);
	for($c = 0; $c < $rows; ++$c)
	{
		$course = mysqli_fetch_assoc($result2); 
		$id_org_course=$course['id_org_course'];
		
		$id_registration=$course['ID'];
		$course_id=$course['course_id'];

		echo "
		<div class='course-item'>

		<img src='images/courses_images/".$course['photo']."' class='course-item-img'>

		<div class='course-white-rect'>
		<div class='course-item-content'>

		<img src='images/courses_images/".$course['photo']."' class='course-item-img-2'>

		<div class='course-item-content-wrapper'>

		<div class='course-item-title'>".$course['title']."</div>

		<div class='course-item-description'>
		<div><span>Начало: </span>".$course['startDate']."</div>
		<div><span>Группа: </span>".$course['groupType']."</div>";


		$scheduleQuery = "SELECT DateTime_class.day, DateTime_class.time FROM Courses_schedule JOIN DateTime_class ON DateTime_class.ID=Courses_schedule.ID_dateTimeClass WHERE Courses_schedule.ID_organizedCourse=$id_org_course";
		$scheduleResult = mysqli_query($link, $scheduleQuery) or die("Ошибка".mysqli_error($link));

		if($scheduleResult) 
		{	
			$scheduleRows = mysqli_num_rows($scheduleResult);
			if($scheduleRows!=0) {
				echo "<div class='course-item-schedule'><span>График: </span> ";
				for($s = 0; $s < $scheduleRows; ++$s) 
				{
					$schedule = mysqli_fetch_assoc($scheduleResult); 
					echo "<p>".$schedule['day']."-".$schedule['time']." </p>
					";
				}
				mysqli_free_result($scheduleResult);
				echo "</div>";
			}
			
		}

		$countLessonsQuery = "SELECT COUNT(*) FROM Course_lessons JOIN Course ON Course_lessons.ID_course=Course.ID WHERE Course.ID=$course_id";
		$countLessonsResult = mysqli_query($link, $countLessonsQuery) or die("Ошибка".mysqli_error($link));

		if($countLessonsResult) {

			$lessons=mysqli_fetch_row($countLessonsResult);
			$countLessons=$lessons[0];
			$countHours=$countLessons*3;

			echo "
			<div><span>Клоичество занятий: ".$course_id." </span>".$countLessons." урока (".$countHours." часов)</div>";
		}

		echo "

		<div><span>Преподаватель: </span><a href='index.php'>".$course['name']."</a></div>

		</div>
		<div class='course-item-title'>Стоимость: ".$course['price']*$course['priceCoefficient']."  BYN</div>";
		/*if (!$isMaster) {
			if($course['status']=="заявка отправлена") {
				echo "<div><button class='cancel-reg-btn' id='".$id_registration."' onclick='cancelReg(this.id)'>Отменить заявку</button></div>";
			} else {
				echo "<div class='course-item-status'>".$course['status']."</div>";
				if ($course['status']=="курс пройден"||$course['status']=="курс активен") {
					echo "<div><button>Добавить отзыв</button></div>";
				}
			}
		} else {
			if ($scheduleRows==0) {
				echo "<div><button>Составить график</button></div>";
			} else {
				echo "<div><button>Изменить график</button></div>";
			}
		}
*/

		if($course['id_status']=="1" || $course['id_status']=="2" || $course['id_status']=="3") {
			echo "<div>
					<div class='course-item-status'>".$course['status']."</div>
					<button class='cancel-reg-btn' id='".$id_registration."' onclick='cancelReg(this.id)'>Отменить заявку</button></div>";
		} else {
			echo "<div class='course-item-status'>".$course['status']."</div>";
			/*if ($course['id_status']=="5"||$course['id_status']=="6") {
				echo "<div><a href='course.php'>Добавить отзыв</a></div>";
			}*/
		}
		
		echo "
		</div>
		</div>

		<div class='two-lines'></div>
		</div>
		</div>
		";
	}

	if ($rows==0) {
		echo "<div>Вы не записаны ни на какой курс. <a href='course_schedule.php'>Успейте записаться!</a></div>";
	}


	

} 

?>