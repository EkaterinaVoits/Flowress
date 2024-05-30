<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\connect\connect_database.php';


if(isset($_POST['user_course_id'])) {

	$user_id=$_SESSION['user']['id'];

    $user_course_id=$_POST['user_course_id'];
    $start_date=$_POST['start_date'];
    $master_id=$_POST['master_id'];
  

    $addOrgCourseQuery = "INSERT INTO Organized_course(ID_course, ID_master,ID_groupType, startDate) VALUES ('$user_course_id', '$master_id', '1', '$start_date')";
    $addOrgCourseResult = mysqli_query($link, $addOrgCourseQuery) or die("Ошибка " . mysqli_error($link));


    if($addOrgCourseResult) {

		$findOrgCourseIdQuery="SELECT ID FROM Organized_course ORDER BY ID DESC LIMIT 1";
		$findOrgCourseIdResult = mysqli_query($link, $findOrgCourseIdQuery) or die("Ошибка".mysqli_error($link));

        $courseLessonsQuery = "SELECT ID FROM Course_lessons WHERE ID_course=$user_course_id";
        $courseLessonsResult = mysqli_query($link, $courseLessonsQuery) or die("Ошибка".mysqli_error($link));

		if($findOrgCourseIdResult && $courseLessonsResult) {
			$row = mysqli_fetch_row($findOrgCourseIdResult); 
			$org_course_id=$row[0];

			$addRegQuery = "INSERT INTO Course_registration(ID_user, ID_organizedCourse ,ID_status) VALUES ('$user_id', '$org_course_id', '1')";
    		$addRegResult = mysqli_query($link, $addRegQuery) or die("Ошибка " . mysqli_error($link));

    		$query2 = "SELECT Course_registration.ID, Organized_course.startDate, Organized_course.ID as id_org_course, User.name, Course.ID as course_id, Course.title, Course.price, Course.photo, Status.status, Status.ID as id_status,Group_type.groupType, Group_type.priceCoefficient FROM Course_registration JOIN Organized_course ON Course_registration.ID_organizedCourse=Organized_course.ID JOIN Status ON Status.ID=Course_registration.ID_status JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Course_registration.ID_user='$user_id' AND Status.ID BETWEEN 1 AND 3 ORDER BY Organized_course.startDate DESC";

    		

            $rows = mysqli_num_rows($courseLessonsResult);
            if($rows>0) {

                for($i = 0; $i < $rows; ++$i)
                {
                    $courseLesson = mysqli_fetch_row($courseLessonsResult); 
                    $courseLesson_id=$courseLesson[0];
                    
                    $addLessonProgressQuery = "INSERT INTO Lesson_progress(ID_courseLesson, ID_organizedCourse) VALUES ('$courseLesson_id','$org_course_id')";
                    $addLessonProgressResult = mysqli_query($link, $addLessonProgressQuery) or die("Ошибка".mysqli_error($link));
                }
            }


            require '../../modules/page_elements/user_courses_cards.php';


		}
	}
    
    /*require '../../modules/page_elements/user_courses_cards.php';*/
}


?>
