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


$query2 = "SELECT Course.ID, Organized_course.startDate, Organized_course.ID as id_org_course, User.name, Course.title, Course.price, Course.photo, Group_type.groupType, Group_type.priceCoefficient FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Organized_course.ID_master='$master_id' ORDER BY Organized_course.startDate DESC";
$result2 = mysqli_query($link, $query2) or die("Ошибка".mysqli_error($link));

if($result2)
{
	$rows = mysqli_num_rows($result2);
	for($c = 0; $c < $rows; ++$c)
	{
		$course = mysqli_fetch_assoc($result2); 
		$id_course=$course['ID'];
		$id_org_course=$course['id_org_course'];
				

		echo "
		<div class='course-item'>

		<div class='course-white-rect-2'>
		<div class='course-item-content'>

		<div class='course-item-content-wrapper'>

		<div class='course-item-title'>Группа ".$id_org_course.". ".$course['title']."</div>

		<div class='course-item-title'>".$course['groupType']."</div>

		<div class='group'>";
			$groupQuery = "SELECT User.name, User.email FROM Course_registration JOIN User ON Course_registration.ID_user=User.ID WHERE Course_registration.ID_status BETWEEN 4 AND 6 AND Course_registration.ID_organizedCourse=$id_org_course";
			$groupResult = mysqli_query($link, $groupQuery) or die("Ошибка".mysqli_error($link));
			if($groupResult) {
				$groupRows = mysqli_num_rows($groupResult);

				if($groupRows!=0) {
					
					for($g = 0; $g < $groupRows; ++$g) 
					{
						$group = mysqli_fetch_assoc($groupResult); 
						echo "<p>".($g+1).". ".$group['name']."-".$group['email']." </p>
						";
					}

				} else {
					echo "<div>Группа не собрана</div>";
				}
			}

		echo "
		</div>


		<div class='course-item-description'>
		<div><span>Начало: </span>".$course['startDate']."</div>
		";


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
			} else {
				echo "<div>
				<button class='add-shedule-btn'>Составить график</button>
				<div class='add-schedule-block'>fff</div>
				</div>";
			}
			
		}

		echo "
		</div>
		<div class='course-item-title'>Стоимость: ".$course['price']*$course['priceCoefficient']."  BYN</div>

		<div class='course-item-title'>Занятия: </div>
		<div class='course-item-lessons'>";


		/*$lessonsQuery = "SELECT Course_lessons.ID, Lesson.title FROM Lesson JOIN Course_lessons ON Lesson.ID=Course_lessons.ID_lesson JOIN Course ON Course_lessons.ID_course=Course.ID WHERE Course.ID=$id_course";
		$lessonsResult = mysqli_query($link, $lessonsQuery) or die("Ошибка".mysqli_error($link));*/

		$lessonsProgressQuery = "SELECT Lesson_progress.ID, Lesson_progress.isChecked, Lesson.title FROM Lesson_progress JOIN Course_lessons ON Lesson_progress.ID_courseLesson=Course_lessons.ID JOIN Organized_course ON Lesson_progress.ID_organizedCourse=Organized_course.ID JOIN Lesson ON Course_lessons.ID_lesson=Lesson.ID WHERE Organized_course.ID=$id_org_course";
		$lessonsProgressResult = mysqli_query($link, $lessonsProgressQuery) or die("Ошибка".mysqli_error($link));

		if($lessonsProgressResult)
		{
			$lessonProgressRows = mysqli_num_rows($lessonsProgressResult);
			for($l = 0; $l < $lessonProgressRows; ++$l)
			{
				$lessonProgressRow = mysqli_fetch_assoc($lessonsProgressResult); 
				/*$lessonpProgressRow = mysqli_fetch_assoc($lessonsResult); */
				echo "<div class='course-lesson-item'>";
				if($lessonProgressRow['isChecked']==1) {
					echo "<input type='checkbox' class='course-lessons-checkboxes lessons-ckbx' name='lesson' value='".$lessonProgressRow['ID']."' checked>";
				} else {
					echo "<input type='checkbox' class='course-lessons-checkboxes lessons-ckbx' name='lesson' value='".$lessonProgressRow['ID']."'>";
				}
				echo "
					<label for='lesson'>Занятие ".($l+1).". ".$lessonProgressRow['title']."</label>
					</div>";
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

?>