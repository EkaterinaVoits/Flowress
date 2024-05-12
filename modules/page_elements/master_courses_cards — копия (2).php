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


$query2 = "SELECT Course.ID, Organized_course.startDate, Organized_course.ID as id_org_course, User.name, Course.title, Course.price, Course.photo, Group_type.groupType, Group_type.priceCoefficient FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID ORDER BY Organized_course.startDate DESC";
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

		<div class='course-item-content-wrapper-3'>

		<div class='course-item-title'>Группа ".$id_org_course.". ".$course['title']."</div>

		<div class='course-item-title'>".$course['groupType']."</div>

		<div class='group'>	";


			$groupQuery = "SELECT User.name, User.email FROM Course_registration JOIN User ON Course_registration.ID_user=User.ID WHERE Course_registration.ID_status BETWEEN 4 AND 6 AND Course_registration.ID_organizedCourse=$id_org_course";
			$groupResult = mysqli_query($link, $groupQuery) or die("Ошибка".mysqli_error($link));
			if($groupResult) {
				$groupRows = mysqli_num_rows($groupResult);

				if($groupRows!=0) {
					
					for($g = 0; $g < $groupRows; ++$g) 
					{
						$group = mysqli_fetch_assoc($groupResult); 
						echo "<div class='row row-margin'>
							<div class='col-1'>".$course['ID']."</div>
							<div class='col-1'>".$group['name']."</div>
							<div class='col-2'>".$group['email']."</div>
							<div class='col-4'>".$course['fullDescription']."</div>
							<div class='col-1'>".$course['price']."</div>
							<div class='col-3'><button class='del-course-btn admin-btn' id='".$course['ID']."'>Удалить</button>
							</div></div>";
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
					График не добавлен преподавателем
				</div>";
			}
			
		}

		echo "
		</div>
		<div class='course-item-title'>Стоимость: ".$course['price']*$course['priceCoefficient']."  BYN</div>

		
		
		</div>
		</div>

		<div class='two-lines'></div>
		</div>
		</div>
		";
	}


	

} 

?>