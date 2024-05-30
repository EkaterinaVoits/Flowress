<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\connect\connect_database.php';

$course_id=$_POST["course_id"];
$course_title=$_POST["course_title"];
$course_description=$_POST["course_description"];
$course_full_description=$_POST["course_full_description"];
$course_price=floatval($_POST["course_price"]);

$error_fields=[];

$regex='/^[а-яА-ЯёЁa-zA-Z0-9\s\«\»\-]+$/u';
$regex2='/[\p{L}\s\d,.!?;:\'"\-\«\»]+[.!?]?$/u';

$courseTitleError='';
if($course_title==null) {
	$error_fields[]='course-title';
	$courseTitleError='Заполните поле';
} elseif (!preg_match($regex, $course_title)) {
	$error_fields[]='course-title';
	$courseTitleError='Название курса не соответствует требованиям';
}

$courseDescriptionError='';
if($course_description==null) {
	$error_fields[]='course-description';
	$courseDescriptionError='Заполните поле';
} elseif (!preg_match($regex2, $course_description)) {
	$error_fields[]='course-description';
	$courseDescriptionError='Описание курса не соответствует требованиям';
}

$courseFullDescriptionError='';
if($course_full_description==null) {
	$error_fields[]='course-full-description';
	$courseFullDescriptionError='Заполните поле';
} elseif (!preg_match($regex2, $course_full_description)) {
	$error_fields[]='course-full-description';
	$courseFullDescriptionError='Полное описание курса не соответствует требованиям';
}

$coursePriceError='';
if($course_price==null) {
	$error_fields[]='course-price';
	$coursePriceError='Заполните поле';
} 


$courseLessonsError='';
if(empty($_POST['lessons_array'])) {
	$courseLessonsError='Выберите уроки курса';
} else {
	$lessons_array = $_POST['lessons_array'];
}


if(!empty($error_fields)) {
	$response = [
		"status"=> false,
		"type" => 1,
		"fields"=>$error_fields,
		"courseTitleError"=>$courseTitleError,
		"courseDescriptionError"=>$courseDescriptionError,
		"courseFullDescriptionError"=>$courseFullDescriptionError,
		"coursePriceError"=>$coursePriceError,
		//"coursePhotoError"=>$coursePhotoError,
		"courseLessonsError"=>$courseLessonsError,
	];
	echo json_encode($response);

	die();

} else {
	/*$addCourseQuery = "INSERT INTO Course(ID_user, title, description, fullDescription, price) VALUES ('$user_id', '$course_title', '$course_description', '$course_full_description', '$course_price')";
	$addCourseResult = mysqli_query($link, $addCourseQuery) or die("Ошибка".mysqli_error($link));*/
	$query = "UPDATE Course SET title='$course_title', description='$course_description', fullDescription='$course_full_description', price='$course_price'  WHERE ID = '$course_id'";
	$result = mysqli_query($link, $query) or die("Ошибка " .mysqli_error($link));

	// существующие ID уроков для этого курса
	$existing_lessons = array();
	$query = "SELECT ID_lesson FROM Course_lessons WHERE ID_course = '$course_id'";
	$result = mysqli_query($link, $query);
	while ($row = mysqli_fetch_assoc($result)) {
	    $existing_lessons[] = $row['ID_lesson'];
	}


	// Сравнивваем ID уроков до изменения курса в бд с ID уроков в новом массиве 
	$lessons_to_add = array_diff($lessons_array, $existing_lessons);
	$lessons_to_delete = array_diff($existing_lessons, $lessons_array);

	// Вставка недостающих ID уроков в бд
	foreach ($lessons_to_add as $lesson_id) {
	    $addCourseLessonsQuery = "INSERT INTO Course_lessons (ID_course, ID_lesson) VALUES ('$course_id', '$lesson_id')";
	    $addCourseLessonsResult = mysqli_query($link, $addCourseLessonsQuery) or die("Ошибка " .mysqli_error($link));
	}

	// Удалить ID уроков, которых нет в массиве, из бд
	foreach ($lessons_to_delete as $lesson_id) {

		$deleteCourseLessonProgressQuery = "DELETE Lesson_progress FROM Lesson_progress JOIN Course_lessons ON Lesson_progress.ID_courseLesson = Course_lessons.ID WHERE Course_lessons.ID_course = '$course_id' AND Course_lessons.ID_lesson = '$lesson_id'";
	    $deleteCourseLessonProgressResult = mysqli_query($link, $deleteCourseLessonProgressQuery) or die("Ошибка " .mysqli_error($link));


	    $deleteCourseLessonsQuery = "DELETE FROM Course_lessons WHERE ID_course = '$course_id' AND ID_lesson = '$lesson_id'";
	    $deleteCourseLessonsResult = mysqli_query($link, $deleteCourseLessonsQuery) or die("Ошибка " .mysqli_error($link));
	}


	/*if($addCourseResult) {

		$findCourseIdQuery="SELECT ID FROM Course ORDER BY ID DESC LIMIT 1";
		$findCourseIdResult = mysqli_query($link, $findCourseIdQuery) or die("Ошибка".mysqli_error($link));
		if($findCourseIdResult) {
			$row = mysqli_fetch_row($findCourseIdResult); 
			$course_id=$row[0];

			for($i = 0; $i < count($_POST['lessons_array']); ++$i) 
			{
				//echo($_POST['lessons_id'][$i]);
				$lesson_id= $_POST['lessons_array'][$i];
				$addCourseLessonQuery = "INSERT INTO Course_lessons(ID_course, ID_lesson) VALUES ('$course_id','$lesson_id')";
				$addCourseLessonResult = mysqli_query($link, $addCourseLessonQuery) or die("Ошибка".mysqli_error($link));
			}
			
		}
	}*/

	$response = [
			"status"=> true,
		];
	echo json_encode($response);
}





/*if (isset($_POST["course_title"]) && isset($_POST["course_description"]) && isset($_POST["course_full_description"]) && isset($_POST["course_price"])) {
	
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
*/


?>