<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';

$user_id=$_SESSION['user']['id'];


$query3 = "SELECT Master.ID FROM Master JOIN User ON Master.ID_user=User.ID WHERE User.ID='$user_id'";
$result3 = mysqli_query($link, $query3) or die("Ошибка " . mysqli_error($link));

if($result3) {
	$master = mysqli_fetch_assoc($result3); 
	$master_id=$master['ID'];
}


$org_course_id = $_POST["org_course_id"];


$query = "UPDATE Organized_course SET isEnded = '1' WHERE ID = $org_course_id";
$result = mysqli_query($link, $query) or die("Ошибка " .
	mysqli_error($link));

$query2 = "UPDATE Course_registration JOIN Organized_course ON Course_registration.ID_organizedCourse=Organized_course.ID SET ID_status ='6' WHERE Organized_course.ID = $org_course_id";
$result2 = mysqli_query($link, $query2) or die("Ошибка " .
	mysqli_error($link));


$query4 = "UPDATE Lesson_progress SET isChecked ='1' WHERE ID_organizedCourse = $org_course_id";
$result4 = mysqli_query($link, $query4) or die("Ошибка " .
	mysqli_error($link));


	?>

	<!--------- COURSES BLOCK --------->
	<div class="block" id="user-courses-block">
		<div class="admin-title-group">
			<div class="admin-panel-title">Ваши курсы</div>
			<a class="add-entry-button" href="master_add_organized_course.php">
				Добавить курс в расписание
			</a>
		</div>
		<div class="refresh-page-msg none">Обновите страницу для дальнейшей работы</div>
		<div class="master-courses-cards">


			<?php

			$query2 = "SELECT Course.ID, Organized_course.startDate, Organized_course.ID as id_org_course, Organized_course.isEnded, User.name, Course.title, Course.price, Course.photo, Group_type.groupType, Group_type.priceCoefficient FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Organized_course.ID_master='$master_id' AND Organized_course.isEnded='0' ORDER BY Organized_course.startDate DESC";

			require '..\..\page_elements\master_courses_cards.php'; 

			if($rows==0) {
				echo "<div>На данный момент вы не проводите ни один курс. </div>";
			}
			?>
		</div> 
	</div>
	<!--------- /COURSES BLOCK --------->  


	<!--------- ARCHIVE COURSES BLOCK --------->
	<div class="block" id="user-archive-courses-block">
		<div class="admin-title-group">
			<div class="admin-panel-title">Архив курсов</div>
		</div>

		<?php

		$query2 = "SELECT Course.ID, Organized_course.startDate, Organized_course.ID as id_org_course, Organized_course.isEnded, User.name, Course.title, Course.price, Course.photo, Group_type.groupType, Group_type.priceCoefficient FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Organized_course.ID_master='$master_id' AND Organized_course.isEnded='1' ORDER BY Organized_course.startDate DESC";

		require '..\..\page_elements\master_courses_cards.php'; 

		if($rows==0) {
			echo "<div>На данный момент у вас нет проведённых курсов. </div>";
		}
		?>

	</div>
	<!--------- /ARCHIVE COURSES BLOCK --------->  