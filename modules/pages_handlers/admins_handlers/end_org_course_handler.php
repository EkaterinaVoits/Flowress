<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';

$org_course_id = $_POST["org_course_id"];


$query = "UPDATE Organized_course SET isEnded = '1' WHERE ID = $org_course_id";
$result = mysqli_query($link, $query) or die("Ошибка " .
	mysqli_error($link));

$query = "UPDATE Course_registration JOIN Organized_course ON Course_registration.ID_organizedCourse=Organized_course.ID SET ID_status ='6' WHERE Organized_course.ID = $org_course_id";
$result = mysqli_query($link, $query) or die("Ошибка " .
	mysqli_error($link));





?>

<div class="block" id="admin-organized-courses-block">

	<div class="admin-title-group">
		<div class="admin-panel-title">Расписание курсов</div>
		<a class="add-entry-button" href="admin_add_organized_course.php">
			Добавить курс в расписание
		</a>
	</div>

	<?php 

	$query2 = "SELECT Course.ID, Organized_course.startDate, Organized_course.isEnded, Organized_course.ID as id_org_course, User.name, Course.title, Course.price, Course.photo, Group_type.groupType, Group_type.priceCoefficient FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Organized_course.isEnded='0' ORDER BY Organized_course.startDate DESC ";

	require '..\..\page_elements\admin_tables\admin_org_courses_cards.php'; ?>

</div>
<!--------- /ORGANIZED COURSES BLOCK --------->

<!--------- ENDED COURSES BLOCK --------->
<div class="block" id="admin-ended-organized-courses-block">

	<div class="admin-title-group">
		<div class="admin-panel-title">Расписание курсов</div>
		<a class="add-entry-button" href="admin_add_organized_course.php">
			Добавить курс в расписание
		</a>
	</div>

	<?php 

	$query2 = "SELECT Course.ID, Organized_course.startDate, Organized_course.isEnded, Organized_course.ID as id_org_course, User.name, Course.title, Course.price, Course.photo, Group_type.groupType, Group_type.priceCoefficient FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Organized_course.isEnded='1' ORDER BY Organized_course.startDate DESC ";

	require '..\..\page_elements\admin_tables\admin_org_courses_cards.php'; ?>

</div>
<!--------- /ENDED COURSES BLOCK --------->
