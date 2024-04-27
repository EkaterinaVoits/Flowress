<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\connect\connect_database.php';

$user_id=$_POST["user_id"];

$query3 = "SELECT * FROM Master JOIN User ON Master.ID_user=User.ID WHERE User.ID='$user_id'";
$result3 = mysqli_query($link, $query3) or die("Ошибка " . mysqli_error($link));

if($result3) {
	$master = mysqli_fetch_assoc($result3); 
	echo "
		<div class='title'>".$master['name']."</div>
		<div>".$master['info']."</div>
	";
	
} 

?>
