<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';


if($_POST['consult_id']) {
    $consult_id=$_POST['consult_id'];

    $dropQuery = "DELETE FROM Consultation WHERE ID = $consult_id";
    $resultDrop = mysqli_query($link, $dropQuery) or die("Ошибка " .
    mysqli_error($link));

    if($resultDrop) {
        require '..\..\page_elements\admin_tables\consult_body_table.php';
    }
}

                               
?>
