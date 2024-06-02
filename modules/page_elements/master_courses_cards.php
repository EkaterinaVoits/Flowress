
<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();



$result2 = mysqli_query($link, $query2) or die("Ошибка".mysqli_error($link));

if($result2)
{
	$rows = mysqli_num_rows($result2);
	for($c = 0; $c < $rows; ++$c)
	{
		$course = mysqli_fetch_assoc($result2); 
		$id_course=$course['ID'];
		$id_org_course=$course['id_org_course'];

		$scheduleQuery = "SELECT DateTime_class.day, DateTime_class.time FROM Courses_schedule JOIN DateTime_class ON DateTime_class.ID=Courses_schedule.ID_dateTimeClass WHERE Courses_schedule.ID_organizedCourse=$id_org_course";
		$scheduleResult = mysqli_query($link, $scheduleQuery) or die("Ошибка".mysqli_error($link));
		$scheduleRows = mysqli_num_rows($scheduleResult);

		echo "
		<div class='course-item'>

		<div class='course-white-rect-2'>
		<div class='course-item-content'>

		<div class='course-item-content-wrapper' style='margin-left:0px;'>

		<div class='course-item-title' id='show-more-org-course-".$id_org_course."' onclick='showMoreOrgCourse(this.id)'><div>";
		if($scheduleRows!=0) {
			echo "<img src='images/icons/added_shedule.svg' class='list-img' id='list-img-".$id_org_course."'>";
		} else {
			echo "<img src='images/icons/no_shedule.svg' class='list-img' id='list-img-".$id_org_course."'>";
		}
		
		echo "
		Группа ".$id_org_course.". ".$course['groupType'].". <br>".$course['title']."
		</div><img src='images/icons/show_more.svg' class='tab-icon show-more-icon' id='icon-".$id_org_course."'>
		</div>

		<div class='none' id='org-course-info-".$id_org_course."'>

		<div class='group'>";
			$groupQuery = "SELECT User.name, User.email, User.telephone FROM Course_registration JOIN User ON Course_registration.ID_user=User.ID WHERE Course_registration.ID_status BETWEEN 4 AND 6 AND Course_registration.ID_organizedCourse=$id_org_course";
			$groupResult = mysqli_query($link, $groupQuery) or die("Ошибка".mysqli_error($link));
			if($groupResult) {
				$groupRows = mysqli_num_rows($groupResult);

				if($groupRows!=0) {
					
					for($g = 0; $g < $groupRows; ++$g) 
					{
						$group = mysqli_fetch_assoc($groupResult); 
						echo "<p>".($g+1).". ".$group['name']." (".$group['telephone'].", ".$group['email'].")</p>
						";
					}

				} 
			}

		echo "
		</div>


		<div class='course-item-description'>
		<div><span>Начало: </span>".date('d.m.Y', strtotime($course['startDate']))."</div></div>
		";


		if($scheduleResult) 
		{	
			
			echo "<div class='org-course-schedule-block-".$id_org_course."'>";
			if($scheduleRows!=0) {
				echo "<div class='course-item-schedule'><span>График: </span> ";
				for($s = 0; $s < $scheduleRows; ++$s) 
				{
					$schedule = mysqli_fetch_assoc($scheduleResult); 
					echo "<p style='margin-left:5px;'>".$schedule['day']."-".date('H:i', strtotime($schedule['time']))." </p>
					";
				}
				mysqli_free_result($scheduleResult);
				echo "</div>";
			} else {
				if($course['isEnded']=='0'){
					echo "
					<button class='change-btn' id='add-shedule-btn-".$id_org_course."' onclick='showSheduleBlock(this.id)'><span>Составить график</span>
						<img src='images/icons/show_more.png' >
					</button> 

					<div id='add-schedule-block-".$id_org_course."' class='add-schedule-block none'>
					<div class='error-shedule-msg-".$id_org_course."'></div>
					<div id='schedule-block-".$id_org_course."'>
					<select name='schedule-select' class='schedule-item select-style'>";

					$id_groupType=$course['id_groupType'];
					if($id_groupType==1){
						$scheduleListQuery = "SELECT * FROM DateTime_class";
					} else {
						$scheduleListQuery = "SELECT * FROM DateTime_class WHERE id_groupType IN ('$id_groupType')";
					}

					//$scheduleListQuery = "SELECT * FROM DateTime_class WHERE id_groupType IN ('$id_groupType')";
					$scheduleListResult = mysqli_query($link, $scheduleListQuery) or die("Ошибка".mysqli_error($link));

					if($scheduleListResult) 
					{	
						$scheduleListRows = mysqli_num_rows($scheduleListResult);
						for($i = 0; $i < $scheduleListRows; ++$i)
						{
							$scheduleListRow = mysqli_fetch_assoc($scheduleListResult); 
							echo "<option value='".$scheduleListRow['ID']."'>".$scheduleListRow['day']."  ".$scheduleListRow['time']."</option>";
						}
					}

					echo "
					</select>
					</div>
					";
					

					echo "
					<button class='add-shedule-item-btn' id='".$id_org_course."' onclick='addSheduleItem(this.id)'>
						<img src='images/icons/add_icon.svg'>
					</button>

					
					<button id='".$id_org_course."' class='form-btn' onclick='saveShedule(this.id)'>
						Сохранить изменения
					</button>
					</div>
					";
				}
				
			}
			echo "</div>";
		}

		echo "
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
				echo "<div class='course-lesson-item' id='course-lesson-item-".$lessonProgressRow['ID']."'>";
				if($lessonProgressRow['isChecked']==1) {
					echo "<input type='checkbox' class='course-lessons-checkboxes lessons-ckbx' name='lesson' value='".$lessonProgressRow['ID']."' checked disabled>";
				} else {
					echo "<input type='checkbox' class='course-lessons-checkboxes lessons-ckbx' name='lesson' id='".$lessonProgressRow['ID']."' value='".$lessonProgressRow['ID']."'>";
				}
				echo "
					<label for='lesson' id='lesson-title".$lessonProgressRow['ID']."'>Занятие ".($l+1).". ".$lessonProgressRow['title']."</label>
					</div>";
			}
		}
		


		echo "


		</div>";

		if($course['isEnded']=='0'){
			echo "
			<div class='cant-del-msg none' id='cant-del-msg-".$id_org_course."'>Невозможно удалить курс, так как на него уже есть регистрации пользователей</div>
			<div class='edit-org-course-masters-btns'>";

			$findRegistrationsQuery = "SELECT * FROM Course_registration WHERE ID_organizedCourse=$id_org_course";
			$findRegistrationsResult = mysqli_query($link, $findRegistrationsQuery) or die("Ошибка " . mysqli_error($link));

			if($findRegistrationsResult) {
			    $rows5 = mysqli_num_rows($findRegistrationsResult);
			    if($rows5==0){
			    	echo "

					<button class='form-btn' id='edit-".$id_org_course."' onclick='editOrgCourse(this.id)'>Редактировать курс</button>

					<button class='form-btn' id='delete-".$id_org_course."' onclick='deleteOrgCourse(this.id)'>Удалить курс</button>
					";
			    } else {
			    	echo "
					<button class='form-btn' id='".$id_org_course."' onclick='endOrgCourse(this.id)'>Завершить курс</button>
					";
			    }
    
   			}
		    
			echo "

			

			

			</div>";
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