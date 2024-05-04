<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\connect\connect_database.php';
 
$user_id=$_SESSION['user']['id'];



if (isset($_POST["count_lessons"]) && isset($_POST["start_date"])) {

	$count_lessons=$_POST["count_lessons"];
	$start_date=$_POST["start_date"];

	$addCourseQuery = "INSERT INTO Course(ID_user, title, description, fullDescription, price) VALUES ('$user_id', 'Пользовательский курс от $user_id', '))', '))))))', '5')";
	$addCourseResult = mysqli_query($link, $addCourseQuery) or die("Ошибка".mysqli_error($link));

	if($addCourseResult) {

		/*if(isset($_POST['lessons_id'])){

			$findCourseIdQuery="SELECT ID FROM `Course` ORDER BY ID DESC LIMIT 1";
			$findCourseIdResult = mysqli_query($link, $findCourseIdQuery) or die("Ошибка".mysqli_error($link));
			if($findCourseIdResult) {
				$row = mysqli_fetch_row($findCourseIdResult); 
				$course_id=$row[0];

				//$lessons_id=$_POST['lessons_id'];
				for($i = 0; $i < count($_POST['lessons_id']); ++$i) 
				{
					//echo($_POST['lessons_id'][$i]);
					$lesson_id= $_POST['lessons_id'][$i];
					$addCourseLessonQuery = "INSERT INTO Course_lessons(ID_course, ID_lesson) VALUES ('$course_id','$lesson_id')";
					$addCourseLessonResult = mysqli_query($link, $addCourseLessonQuery) or die("Ошибка".mysqli_error($link));

					if($addCourseLessonResult) {
						echo "))))))";
					}
				}
			}
		}
*/


		echo "Курс добавлен";
		
	} else {
		echo "Ошибка добавления нового курса";
	}

}


?>