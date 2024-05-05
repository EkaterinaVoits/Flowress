<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\connect\connect_database.php';
 
$user_id=$_SESSION['user']['id'];

if (isset($_POST["count_lessons"]) && isset($_POST["start_date"])) {

	$count_lessons=$_POST["count_lessons"];
	$start_date=$_POST["start_date"];
	$course_price=$_POST["course_price"];
	$master_id=$_POST["master_id"];
	$course_wishes_description=$_POST["course_wishes_description"];


	//для заполнения информации о курсе (кто составил, пожелания к курсу)
	$userQuery="SELECT * FROM User WHERE ID=$user_id" ;
	$userResult = mysqli_query($link, $userQuery) or die("Ошибка".mysqli_error($link));

	$user = mysqli_fetch_assoc($userResult); 

	$user_name=$user['name']; 
	$user_email=$user['email']; 
	$user_telephone=$user['telephone'];
	/*номер телефона: $user['telephone'], email: $user['email'] */



	$addCourseQuery = "INSERT INTO Course(ID_user, title, description, fullDescription, price) VALUES ('$user_id', 'Пользовательский курс', 'Cоставитель кусра: $user_name ($user_telephone, $user_email, ID: $user_id)', 'Пожелания к курсу: $course_wishes_description', '$course_price')";
	$addCourseResult = mysqli_query($link, $addCourseQuery) or die("Ошибка".mysqli_error($link));

	if($addCourseResult) {

		if(isset($_POST['lessons_id'])){

			$findCourseIdQuery="SELECT ID FROM `Course` WHERE ID_user=$user_id ORDER BY ID DESC LIMIT 1" ;
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
				}
			}

			$addOrgCourseQuery = "INSERT INTO Organized_course(ID_course, ID_master, ID_groupType, startDate) VALUES ('$course_id','$master_id', '1', '$start_date')";
			$orgCourseResult = mysqli_query($link, $addOrgCourseQuery) or die("Ошибка".mysqli_error($link));

			$findOrgCourseIdQuery="SELECT ID FROM Organized_course WHERE ID_course=$course_id" ;
			$findOrgCourseIdResult = mysqli_query($link, $findOrgCourseIdQuery) or die("Ошибка".mysqli_error($link));

			if($findOrgCourseIdResult) {
				$row = mysqli_fetch_row($findOrgCourseIdResult); 
				$org_course_id=$row[0];

				$addRegQuery = "INSERT INTO Course_registration(ID_user, ID_organizedCourse, ID_status) VALUES ('$user_id','$org_course_id', 1)";
				$addRegResult = mysqli_query($link, $addRegQuery) or die("Ошибка".mysqli_error($link));
			}
			
		}

	} 

}


?>