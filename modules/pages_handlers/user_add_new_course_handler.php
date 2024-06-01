<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\connect\connect_database.php';
 
$user_id=$_SESSION['user']['id'];

$course_startDate=$_POST["start_date"];
$count_lessons=$_POST["count_lessons"];
$start_date=$_POST["start_date"];
$course_price=$_POST["course_price"];
$master_id=$_POST["master_id"];
$course_wishes_description=$_POST["course_wishes_description"];

$error_fields=[];

//для заполнения информации о курсе (кто составил, пожелания к курсу)
$userQuery="SELECT * FROM User WHERE ID=$user_id" ;
$userResult = mysqli_query($link, $userQuery) or die("Ошибка".mysqli_error($link));

$user = mysqli_fetch_assoc($userResult); 

$user_name=$user['name']; 
$user_email=$user['email']; 
$user_telephone=$user['telephone'];


if($course_wishes_description==null){
	$course_wishes_description="Пожелания к курсу не добавлены";
}

$courseLessonsError='';
if($count_lessons==0) {
	$courseLessonsError='Выберите уроки курса';
	$error_fields[]='course-lessons';
}

$courseStartDateError='';
if($course_startDate==null) {
	$courseStartDateError='Выберите дату начала курса';
	$error_fields[]='course-start-date';
}


if(!empty($error_fields)) {
	$response = [
		"status"=> false,
		"type" => 1,
		"fields"=>$error_fields,
		"courseLessonsError"=>$courseLessonsError,
		"courseStartDateError"=>$courseStartDateError
	];
	echo json_encode($response);

	die();

} else {

	//запись пользовательского курса в бд
	$addCourseQuery = "INSERT INTO Course(ID_user, title, description, fullDescription, price) VALUES ('$user_id', 'Пользовательский курс', '$course_wishes_description','Cоставитель кусра: $user_name ($user_telephone, $user_email, ID: $user_id), Уроки: ', '$course_price')";
	$addCourseResult = mysqli_query($link, $addCourseQuery) or die("Ошибка".mysqli_error($link));

	if($addCourseResult) {

		if(isset($_POST['lessons_array'])){

			$findCourseIdQuery="SELECT ID FROM Course WHERE ID_user=$user_id ORDER BY ID DESC LIMIT 1" ;
			$findCourseIdResult = mysqli_query($link, $findCourseIdQuery) or die("Ошибка".mysqli_error($link));

			if($findCourseIdResult) {
				$row = mysqli_fetch_row($findCourseIdResult); 
				$course_id=$row[0];

				$lessons_string="";

				//запись уроков пользовательского курса в бд
				for($i = 0; $i < count($_POST['lessons_array']); ++$i) 
				{
					//echo($_POST['lessons_id'][$i]);
					$lesson_id= $_POST['lessons_array'][$i];
					$addCourseLessonQuery = "INSERT INTO Course_lessons(ID_course, ID_lesson) VALUES ('$course_id','$lesson_id')";
					$addCourseLessonResult = mysqli_query($link, $addCourseLessonQuery) or die("Ошибка".mysqli_error($link));

					$findLessonTitleQuery="SELECT title FROM Lesson WHERE ID='$lesson_id'";
					$findLessonTitleResult = mysqli_query($link, $findLessonTitleQuery) or die("Ошибка " .mysqli_error($link));

					$lesson = mysqli_fetch_row($findLessonTitleResult); 
					$lesson_title=$lesson[0];

					$lessons_string.=" -".$lesson_title;
				}
			}

			$updateQuery = "UPDATE Course SET title = 'Пользовательский курс $course_id', fullDescription= CONCAT(fullDescription, '$lessons_string') WHERE ID = '$course_id'";
			$result4 = mysqli_query($link, $updateQuery) or die("Ошибка " .mysqli_error($link));

			//создание орг.курса (в расписание) 
			$addOrgCourseQuery = "INSERT INTO Organized_course(ID_course, ID_master, ID_groupType, startDate) VALUES ('$course_id','$master_id', '1', '$start_date')";
			$orgCourseResult = mysqli_query($link, $addOrgCourseQuery) or die("Ошибка".mysqli_error($link));

			$findOrgCourseIdQuery="SELECT ID FROM Organized_course WHERE ID_course=$course_id" ;
			$findOrgCourseIdResult = mysqli_query($link, $findOrgCourseIdQuery) or die("Ошибка".mysqli_error($link));

			if($findOrgCourseIdResult) {
				$row = mysqli_fetch_row($findOrgCourseIdResult); 
				$org_course_id=$row[0];

				//добавление регистрации пользователя на орг.курс 
				$addRegQuery = "INSERT INTO Course_registration(ID_user, ID_organizedCourse, ID_status) VALUES ('$user_id','$org_course_id', 1)";
				$addRegResult = mysqli_query($link, $addRegQuery) or die("Ошибка".mysqli_error($link));
			}

			//добавление уроков в таблицу прогресса уроков курса
			$courseLessonsQuery = "SELECT ID FROM Course_lessons WHERE ID_course=$course_id";
			$courseLessonsResult = mysqli_query($link, $courseLessonsQuery) or die("Ошибка".mysqli_error($link));

			if($courseLessonsResult){
				$rows = mysqli_num_rows($courseLessonsResult);
				for($j = 0; $j < $rows; ++$j)
				{
					$courseLesson = mysqli_fetch_row($courseLessonsResult); 
					$courseLesson_id=$courseLesson[0];
					
					$addLessonProgressQuery = "INSERT INTO Lesson_progress(ID_courseLesson, ID_organizedCourse) VALUES ('$courseLesson_id','$org_course_id')";

					$addLessonProgressResult = mysqli_query($link, $addLessonProgressQuery) or die("Ошибка".mysqli_error($link));

				}
			}
			
		}

	} 
	$response = [
			"status"=> true,
		];
	echo json_encode($response);
}



?>