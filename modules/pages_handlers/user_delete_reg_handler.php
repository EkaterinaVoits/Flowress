<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\connect\connect_database.php';

require_once __DIR__ .'../../../mail/vendor/autoload.php';
$settings = require_once __DIR__ .'../../../mail/settings.php';
require_once __DIR__ .'../../../mail/functions.php';

if(isset($_POST['reg_id'])) {
    $reg_id=$_POST['reg_id'];
    $user_id=$_SESSION['user']['id'];
    $user_email=$_SESSION['user']['email'];

    $findQuery = "SELECT Course.title, Organized_course.ID FROM Course_registration JOIN Organized_course ON Course_registration.ID_organizedCourse=Organized_course.ID JOIN Course ON Organized_course.ID_course=Course.ID WHERE Course_registration.ID='$reg_id'";
   	$findResult = mysqli_query($link, $findQuery) or die("Ошибка " . mysqli_error($link));

    $reg = mysqli_fetch_row($findResult);
    $course_title=$reg[0];
    $org_course_id=$reg[1];

    $dropQuery = "DELETE FROM Course_registration WHERE ID = $reg_id";
    $resultDrop = mysqli_query($link, $dropQuery) or die("Ошибка " .
        mysqli_error($link));

    $isCustomCourse = strpos($course_title, "Пользовательский курс") === 0;

    if($isCustomCourse) {

        $dropLessonProgressQuery = "DELETE FROM Lesson_progress WHERE ID_organizedCourse='$org_course_id'";
        $resultDropLessonProgress = mysqli_query($link, $dropLessonProgressQuery) or die("Ошибка " .
        mysqli_error($link));

        $dropScheduleQuery = "DELETE FROM Courses_schedule WHERE ID_organizedCourse = '$org_course_id'";
        $resultDropSchedule = mysqli_query($link, $dropScheduleQuery) or die("Ошибка " .
        mysqli_error($link));

        $dropOrgCourse = "DELETE FROM Organized_course WHERE ID = '$org_course_id'";
        $resultDropOrgCourse = mysqli_query($link, $dropOrgCourse) or die("Ошибка " .
        mysqli_error($link));
    } 

    $query2 = "SELECT Course_registration.ID, Organized_course.startDate, Organized_course.ID as id_org_course, User.name, Course.ID as course_id, Course.title, Course.price, Course.photo, Status.status, Status.ID as id_status,Group_type.groupType, Group_type.priceCoefficient FROM Course_registration JOIN Organized_course ON Course_registration.ID_organizedCourse=Organized_course.ID JOIN Status ON Status.ID=Course_registration.ID_status JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Course_registration.ID_user='$user_id' AND Status.ID BETWEEN 1 AND 3 ORDER BY Organized_course.startDate DESC";

    require '../../modules/page_elements/user_courses_cards.php';

    if($resultDrop) {

    	$body="<h2>Ваша заявка на ".$course_title." отменена</h2><br><br>
	    
	    Связаться с нами можно по почте Flowress_beauty_school@gmail.com и по номеру телефона +375 (29) 632-14-22 <br>
	    <br><br>

	    Благодарим, что выбрали нас!";

	    send_mail($settings['mail_settings_prod'], [$user_email], 'Письмо с сайта Flowress', $body);
    }
}


?>
 