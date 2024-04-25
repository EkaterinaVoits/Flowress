<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\connect\connect_database.php';


if(isset($_POST['reg_id'])) {
    $reg_id=$_POST['reg_id'];
    $user_id=$_SESSION['user']['id'];

    $dropQuery = "DELETE FROM Course_registration WHERE Course_registration.ID = $reg_id";
    $resultDrop = mysqli_query($link, $dropQuery) or die("Ошибка " .
        mysqli_error($link));

    require '../../modules/page_elements/user_courses_cards.php';
}


?>
