<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\connect\connect_database.php';


if(isset($_POST['reg_id'])) {
    $reg_id=$_POST['reg_id'];
    $user_id=$_SESSION['user']['id'];

    $dropQuery = "DELETE FROM Course_registration WHERE Course_registration.ID = $reg_id";
    $resultDrop = mysqli_query($link, $dropQuery) or die("Ошибка " .
        mysqli_error($link));

    $query2 = "SELECT Course_registration.ID, Organized_course.startDate, Organized_course.ID as id_org_course, User.name, Course.ID as course_id, Course.title, Course.price, Course.photo, Status.status, Status.ID as id_status,Group_type.groupType, Group_type.priceCoefficient FROM Course_registration JOIN Organized_course ON Course_registration.ID_organizedCourse=Organized_course.ID JOIN Status ON Status.ID=Course_registration.ID_status JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Course_registration.ID_user='$user_id' AND Status.ID BETWEEN 1 AND 3 ORDER BY Organized_course.startDate DESC";

    require '../../modules/page_elements/user_courses_cards.php';
}


?>
