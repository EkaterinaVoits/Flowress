<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';

$user_id=$_SESSION['user']['id'];

$course_id = $_POST["course_id"];
//$master_id = $_POST["master_id"];
$course_startDate = $_POST["course_startDate"];
// $course_duration_id = $_POST["course_duration_id"];
$course_groupType_id = $_POST["course_groupType_id"];	

$masterQuery="SELECT Master.ID FROM Master JOIN User ON Master.ID_user=User.ID WHERE User.ID=$user_id";
$masterResult=mysqli_query($link, $masterQuery) or die("Ошибка".mysqli_error($link));

if($masterResult) {
	$master = mysqli_fetch_row($masterResult);
	$master_id=$master[0];

	if($course_startDate!=null) {
		$addOrgCourseQuery = "INSERT INTO Organized_course(ID_course, ID_master, ID_groupType,  startDate) VALUES ('$course_id','$master_id','$course_groupType_id', '$course_startDate')";

		$orgCourseResult = mysqli_query($link, $addOrgCourseQuery) or die("Ошибка".mysqli_error($link));


		$courseLessonsQuery = "SELECT ID FROM Course_lessons WHERE ID_course=$course_id";

		$courseLessonsResult = mysqli_query($link, $courseLessonsQuery) or die("Ошибка".mysqli_error($link));


		$idOrgCourseQuery = "SELECT ID FROM Organized_course ORDER BY ID DESC LIMIT 1";

		$idOrgCourseResult = mysqli_query($link, $idOrgCourseQuery) or die("Ошибка".mysqli_error($link));


		if($courseLessonsResult && $idOrgCourseResult) {

			$rows = mysqli_num_rows($courseLessonsResult);

			$org_course=mysqli_fetch_row($idOrgCourseResult); 
			$id_org_course=$org_course[0];

			if($rows>0) {

				for($i = 0; $i < $rows; ++$i)
				{
					$courseLesson = mysqli_fetch_row($courseLessonsResult); 
					$courseLesson_id=$courseLesson[0];
					
					$addLessonProgressQuery = "INSERT INTO Lesson_progress(ID_courseLesson, ID_organizedCourse) VALUES ('$courseLesson_id','$id_org_course')";

					$addLessonProgressResult = mysqli_query($link, $addLessonProgressQuery) or die("Ошибка".mysqli_error($link));
				}
			}
		} 

		if(!$orgCourseResult) {
			echo "<div>Не удалось добавить курс</div>";
		}

	}
	else {
		echo "<div>Выбрите дату начала курса</div>";
	}
}


?>