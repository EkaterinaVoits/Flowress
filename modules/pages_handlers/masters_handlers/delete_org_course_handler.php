<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';


$id_org_course = $_POST["id_org_course"];
$master_id=$_SESSION['user']['id'];

$findRegistrationsQuery = "SELECT * FROM Course_registration WHERE ID_organizedCourse=$id_org_course";
$findRegistrationsResult = mysqli_query($link, $findRegistrationsQuery) or die("Ошибка " . mysqli_error($link));

if($findRegistrationsResult) {
    $rows = mysqli_num_rows($findRegistrationsResult);
    
    if($rows>0) {
        $response = [
			"status"=> false
		];
		echo json_encode($response);

	die();
    } else {
        $dropLessonProgressQuery = "DELETE FROM Lesson_progress WHERE ID_organizedCourse = $id_org_course";
        $resultDropLessonProgress = mysqli_query($link, $dropLessonProgressQuery) or die("Ошибка " . mysqli_error($link));

        $dropScheduleQuery = "DELETE FROM Courses_schedule WHERE ID_organizedCourse = $id_org_course";
        $resultDropSchedule = mysqli_query($link, $dropScheduleQuery) or die("Ошибка " . mysqli_error($link));

        $dropOrgCourseQuery = "DELETE FROM Organized_course WHERE ID = $id_org_course";
        $resultDropOrgCourse = mysqli_query($link, $dropOrgCourseQuery) or die("Ошибка " . mysqli_error($link));

         


		$query2 = "SELECT Course.ID, Organized_course.startDate, Organized_course.ID as id_org_course, Organized_course.isEnded, User.name, Course.title, Course.price, Course.photo, Group_type.groupType, Group_type.priceCoefficient FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Organized_course.ID_master='$master_id' AND Organized_course.isEnded='0' ORDER BY Organized_course.startDate DESC";


		$response = [
			"status"=> true, 
			"html" => "<div>Обновите страницу</div>"
		];
		echo json_encode($response);

    }

/*$dropQuery = "DELETE FROM Consultation WHERE ID = $consult_id";
$resultDrop = mysqli_query($link, $dropQuery) or die("Ошибка " .
    mysqli_error($link));*/

}

?>