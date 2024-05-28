<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';

$course_id = $_POST["course_id"];

if($course_id!=null){
	$query = "UPDATE Course SET isActive = '0' WHERE ID = '$course_id'";
	$result = mysqli_query($link, $query) or die("Ошибка " .mysqli_error($link));

    require '..\..\page_elements\admin_tables\courses_body_table.php';

}

?>