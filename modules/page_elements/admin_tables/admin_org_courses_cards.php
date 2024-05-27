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
		$id_course=$course['ID'];
		$id_org_course=$course['id_org_course'];
				
		/*$course_start_date=date($course['startDate']);*/

		echo "
		<div class='course-item'>

		<div class='course-white-rect-2'>
		<div class='course-item-content'>

		<div class='course-item-content-wrapper-3'>

		<div class='course-item-title' id='show-more-org-course-".$id_org_course."' onclick='showMoreOrgCourse(this.id)'>Группа ".$id_org_course.". ".$course['title']."
		<img src='images/icons/show_more.png' id='icon-".$id_org_course."'>
		</div>

		<div class='course-item-description none' id='org-course-info-".$id_org_course."'>

		<div class='course-content-wrapper'>

		<div><span>Начало: </span>".date('d.m.Y', strtotime($course['startDate']))."</div>

		<div><span>Преподаватель: </span>".$course['name']."</div>

		<div><span>Группа: </span>".$course['groupType']."</div>

		</div>

		<div class='group'>";

			$regQuery = "SELECT Course_registration.ID, Course_registration.ID_user, User.name, User.email, User.telephone, Status.status FROM Course_registration JOIN User ON Course_registration.ID_user=User.ID JOIN Status ON Course_registration.ID_status=Status.ID WHERE Course_registration.ID_status BETWEEN 4 AND 7 AND Course_registration.ID_organizedCourse=$id_org_course";
			$regResult = mysqli_query($link, $regQuery) or die("Ошибка".mysqli_error($link));
			
			if($regResult) {
				$registrationsRows = mysqli_num_rows($regResult);

				if($registrationsRows!=0) {
					
					for($g = 0; $g < $registrationsRows; ++$g) 
					{
						$registration = mysqli_fetch_assoc($regResult); 

						echo "
						<div class='admin-panel-table col-12'>
							<div class='table-border'>

								<div class='title-table row'> 
									<div class='col-2'>Имя</div>
									<div class='col-3'>email</div>
									<div class='col-3'>Телефон</div>
									<div class='col-2'>Статус</div>
									<div class='col-2'>Управление</div>
								</div>


								<div class='row row-margin'>
									<div class='col-2'>".($g+1).". ".$registration['name']."</div>
									<div class='col-3'>".$registration['email']."</div>
									<div class='col-3'>".$registration['telephone']."</div>
									<div class='reg_status col-2' id='course_status".$registration['ID']."'>".$registration['status']."</div>";

											$statusQuery = "SELECT * FROM Status WHERE ID BETWEEN 4 AND 6";
											$statusResult = mysqli_query($link, $statusQuery) or die("Ошибка".mysqli_error($link));
											echo "<select name='status-select' id='".$registration['ID']."' class='status_select select-style col-2'>";

											if($statusResult)
											{
												$rows2 = mysqli_num_rows($statusResult);
												echo "<option value='no_status'></option>";
												for($j = 0; $j < $rows2; ++$j)
												{
													$row2 = mysqli_fetch_row($statusResult); 
													echo "<option value='".$row2[0]."'>".$row2[1]."</option>";
												}
											}

									echo "</select>
								</div>
							</div>
						</div>";



						echo "<p>".($g+1).". ".$registration['name']."-".$registration['email']." </p>
						";
					}

				} else {
					echo "<div>Группа не собрана</div>";
				}
			}

		echo "
		</div>

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
		
		<div class='course-item-title'>Стоимость: ".$course['price']*$course['priceCoefficient']."  BYN</div>";

		if($course['isEnded']=='0'){

			echo "<button class='btn' id='".$id_org_course."' onclick='endOrgCourse(this.id)'>Завершить курс</button>";
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