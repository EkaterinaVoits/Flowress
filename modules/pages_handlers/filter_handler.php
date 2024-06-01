<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\connect\connect_database.php';

$today = date('Y-m-d');

if (isset($_POST['courses_id'] ) ) {
	$implodCoursesID = implode("','", $_POST['courses_id']);
} else {
	$implodCoursesID = "";
}

if (isset($_POST['masters_id'] ) ) {
	$implodMastersID = implode("','", $_POST['masters_id']);
} else {
	$implodMastersID = "";
}

if (isset($_POST['groups_type_id'] ) ) {
	$implodGroupTypeID = implode("','", $_POST['groups_type_id']);
} else {
	$implodGroupTypeID="";
}


// --- ничего не выбрано ---
if(!isset($_POST['courses_id']) && !isset($_POST['groups_type_id']) && !isset($_POST['masters_id'])){ 

	$organizedCourseQuery = "SELECT Organized_course.ID, Organized_course.startDate, User.name, Course.title, Course.price, Group_type.groupType, Group_type.priceCoefficient, Group_type.groupSize FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Courses_schedule ON Courses_schedule.ID_organizedCourse=Organized_course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID  WHERE Organized_course.startDate>'$today' AND Course.title NOT LIKE 'Пользовательский курс%' GROUP BY Organized_course.ID";
	include '../page_elements/courses_cards.php';
	mysqli_free_result($organizedCourseResult);
}

// --- фильтр по курсу ---
if(isset($_POST['courses_id']) && !isset($_POST['groups_type_id']) && !isset($_POST['masters_id'])){ 

	//$querySecondPart="AND Organized_course.ID_groupType IN ('$implodGroupTypeID')";
	$organizedCourseQuery = "SELECT Organized_course.ID, Organized_course.startDate, User.name, Course.title, Course.price, Group_type.groupType, Group_type.priceCoefficient, Group_type.groupSize FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Courses_schedule ON Courses_schedule.ID_organizedCourse=Organized_course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Organized_course.startDate>'$today' AND Organized_course.ID_course IN ('$implodCoursesID') AND Course.title NOT LIKE 'Пользовательский курс%' GROUP BY Organized_course.ID";
	include '../page_elements/courses_cards.php';
	mysqli_free_result($organizedCourseResult);
}

if(!isset($_POST['courses_id']) && isset($_POST['groups_type_id']) && !isset($_POST['masters_id'])){ 

	//$querySecondPart="AND Organized_course.ID_groupType IN ('$implodGroupTypeID')";
	$organizedCourseQuery = "SELECT Organized_course.ID, Organized_course.startDate, User.name, Course.title, Course.price, Group_type.groupType, Group_type.priceCoefficient, Group_type.groupSize FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Courses_schedule ON Courses_schedule.ID_organizedCourse=Organized_course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Organized_course.startDate>'$today' AND Organized_course.ID_groupType IN ('$implodGroupTypeID') AND Course.title NOT LIKE 'Пользовательский курс%' GROUP BY Organized_course.ID";
	include '../page_elements/courses_cards.php';
	mysqli_free_result($organizedCourseResult);
}

if(!isset($_POST['courses_id']) && !isset($_POST['groups_type_id']) && isset($_POST['masters_id'])){ 

	//$querySecondPart="AND Organized_course.ID_groupType IN ('$implodGroupTypeID')";
	$organizedCourseQuery = "SELECT Organized_course.ID, Organized_course.startDate, User.name, Course.title, Course.price, Group_type.groupType, Group_type.priceCoefficient, Group_type.groupSize FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Courses_schedule ON Courses_schedule.ID_organizedCourse=Organized_course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Organized_course.startDate>'$today' AND Organized_course.ID_master IN ('$implodMastersID') AND Course.title NOT LIKE 'Пользовательский курс%' GROUP BY Organized_course.ID";
	include '../page_elements/courses_cards.php';
	mysqli_free_result($organizedCourseResult);
}

if(isset($_POST['courses_id']) && !isset($_POST['groups_type_id']) && !isset($_POST['masters_id'])){ 

	//$querySecondPart="AND Organized_course.ID_master IN ('$implodMastersID')";
	$organizedCourseQuery = "SELECT Organized_course.ID, Organized_course.startDate, User.name, Course.title, Course.price, Group_type.groupType, Group_type.priceCoefficient, Group_type.groupSize FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Courses_schedule ON Courses_schedule.ID_organizedCourse=Organized_course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Organized_course.startDate>'$today' AND Organized_course.ID_master IN ('$implodMastersID') AND Course.title NOT LIKE 'Пользовательский курс%' GROUP BY Organized_course.ID";
	include '../page_elements/courses_cards.php';
	mysqli_free_result($organizedCourseResult);
}
 
if(isset($_POST['courses_id']) && isset($_POST['groups_type_id']) && !isset($_POST['masters_id'])){ 

	//$querySecondPart="AND Organized_course.ID_groupType IN ('$implodGroupTypeID')";
	$organizedCourseQuery = "SELECT Organized_course.ID, Organized_course.startDate, User.name, Course.title, Course.price, Group_type.groupType, Group_type.priceCoefficient, Group_type.groupSize FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Courses_schedule ON Courses_schedule.ID_organizedCourse=Organized_course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Organized_course.startDate>'$today' AND Organized_course.ID_course IN ('$implodCoursesID') AND Organized_course.ID_groupType IN ('$implodGroupTypeID') AND Course.title NOT LIKE 'Пользовательский курс%' GROUP BY Organized_course.ID";
	include '../page_elements/courses_cards.php';
	mysqli_free_result($organizedCourseResult);
}

if(isset($_POST['courses_id']) && !isset($_POST['groups_type_id']) && isset($_POST['masters_id'])){ 

	//$querySecondPart="AND Organized_course.ID_groupType IN ('$implodGroupTypeID')";
	$organizedCourseQuery = "SELECT Organized_course.ID, Organized_course.startDate, User.name, Course.title, Course.price, Group_type.groupType, Group_type.priceCoefficient, Group_type.groupSize FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Courses_schedule ON Courses_schedule.ID_organizedCourse=Organized_course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Organized_course.startDate>'$today' AND Organized_course.ID_course IN ('$implodCoursesID') AND Organized_course.ID_master IN ('$implodMastersID') AND Course.title NOT LIKE 'Пользовательский курс%' GROUP BY Organized_course.ID";
	include '../page_elements/courses_cards.php';
	mysqli_free_result($organizedCourseResult);
}

if(!isset($_POST['courses_id']) && isset($_POST['groups_type_id']) && isset($_POST['masters_id'])){ 

	//$querySecondPart="AND Organized_course.ID_groupType IN ('$implodGroupTypeID')";
	$organizedCourseQuery = "SELECT Organized_course.ID, Organized_course.startDate, User.name, Course.title, Course.price, Group_type.groupType, Group_type.priceCoefficient, Group_type.groupSize FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Courses_schedule ON Courses_schedule.ID_organizedCourse=Organized_course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Organized_course.startDate>'$today' AND Organized_course.ID_groupType IN ('$implodGroupTypeID') AND Organized_course.ID_master IN ('$implodMastersID') AND Course.title NOT LIKE 'Пользовательский курс%' GROUP BY Organized_course.ID";
	include '../page_elements/courses_cards.php';
	mysqli_free_result($organizedCourseResult);
}


//$querySecondPart="AND Organized_course.ID_groupType IN ('$implodGroupTypeID') AND Organized_course.ID_master IN ('$implodMastersID')";

/*универсальный (выбрано всё)*/
$organizedCourseQuery="SELECT Organized_course.ID, Organized_course.startDate, User.name, Course.title, Course.price, Group_type.groupType, Group_type.priceCoefficient, Group_type.groupSize FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Courses_schedule ON Courses_schedule.ID_organizedCourse=Organized_course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Organized_course.startDate>'$today' AND Organized_course.ID_groupType IN ('$implodGroupTypeID') AND Organized_course.ID_master IN ('$implodMastersID') AND Organized_course.ID_course IN ('$implodCoursesID') AND Course.title NOT LIKE 'Пользовательский курс%' GROUP BY Organized_course.ID";

$organizedCourseResult = mysqli_query($link, $organizedCourseQuery) or die("Ошибка".mysqli_error($link));
include '../page_elements/courses_cards.php';
mysqli_free_result($organizedCourseResult);

?>

