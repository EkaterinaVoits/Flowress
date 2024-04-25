<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\connect\connect_database.php';

$user_id=$_SESSION['user']['id'];
$master_info=$_POST["master_info"];

$query = "SELECT * FROM Master JOIN User ON Master.ID_user=User.ID WHERE User.ID='$user_id'";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

if($result) {
	
	$query = "UPDATE Master SET info = '$master_info' WHERE Master.ID_user = '$user_id'";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
} 

echo "<p id='master-info'>".$master_info."</p>";


?>
