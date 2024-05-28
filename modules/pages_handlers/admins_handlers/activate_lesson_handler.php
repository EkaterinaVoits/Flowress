<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';

$lesson_id = $_POST["lesson_id"];

if($lesson_id!=null){
	$query = "UPDATE Lesson SET isActive = '1' WHERE ID = '$lesson_id'";
	$result = mysqli_query($link, $query) or die("Ошибка " .mysqli_error($link));

    require '..\..\page_elements\admin_tables\lessons_body_table.php';

}

?>