<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\connect\connect_database.php';

$user_id=$_SESSION['user']['id'];

if (isset($_POST["course_title"]) && isset($_POST["course_description"]) && isset($_POST["course_full_description"]) && isset($_POST["course_price"])) {
	
	$course_title=$_POST["course_title"];
	$course_description=$_POST["course_description"];
	$course_full_description=$_POST["course_full_description"];
	$course_price=floatval($_POST["course_price"]);





	//проверка названия курса
	if($course_title==='') {
		echo "<div class='error-msg'>Добавьте название курса. </div>";
	} else if(!preg_match( '/\D/', $course_title)) {
		echo "Введенное назание курса не соответствует требованиям. ";
	} else {

		//проверка описания курса
		if($course_description==='') {
			echo "<div class='error-msg'>Добавьте описание курса. </div>";
		} else if(!preg_match( '/\D/', $course_description)) {
			echo "<div class='error-msg'>Введенное описание курса не соответствует требованиям. </div>";
		} else {

			//проверка стоимости курса
			if($course_price==0) {
				echo "<div class='error-msg'>Добавьте стоимость курса. </div>";
			} else {

				if(!isset($_POST['lessons_id'])){
					echo "<div class='error-msg'> Выберите уроки курса. </div>";
				} else {

					$addCourseQuery = "INSERT INTO Course(ID_user, title, description, fullDescription, price) VALUES ('$user_id', '$course_title', '$course_description', '$course_full_description', '$course_price')";
					$addCourseResult = mysqli_query($link, $addCourseQuery) or die("Ошибка".mysqli_error($link));

					if($addCourseResult) {

						if(isset($_POST['lessons_id'])){

							$findCourseIdQuery="SELECT ID FROM `Course` ORDER BY ID DESC LIMIT 1";
							$findCourseIdResult = mysqli_query($link, $findCourseIdQuery) or die("Ошибка".mysqli_error($link));
							if($findCourseIdResult) {
								$row = mysqli_fetch_row($findCourseIdResult); 
								$course_id=$row[0];

								for($i = 0; $i < count($_POST['lessons_id']); ++$i) 
								{
									//echo($_POST['lessons_id'][$i]);
									$lesson_id= $_POST['lessons_id'][$i];
									$addCourseLessonQuery = "INSERT INTO Course_lessons(ID_course, ID_lesson) VALUES ('$course_id','$lesson_id')";
									$addCourseLessonResult = mysqli_query($link, $addCourseLessonQuery) or die("Ошибка".mysqli_error($link));
								}
							}
						}
						echo "<div class='success-msg'>Курс добавлен</div>";
					} else {
						echo "<div class='error-msg'>Ошибка добавления нового курса</div>";
					}


				}
				
			}


		}
	}

	

	

} 

/*if (!$isset($_POST["course_description"])) {
	echo "Добавьте описание урока. ";
}

if (!$isset($_POST["course_full_description"])) {
	echo "Добавьте полное описание урока. ";
}

if (!$isset($_POST["course_price"])) {
	echo "Введите стоимость курса ";
}
*/

?>