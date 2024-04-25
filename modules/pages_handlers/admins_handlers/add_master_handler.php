<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';

$master_email = $_POST["master_email"];	
	
$existenceUserQuery="SELECT id FROM User WHERE User.email='$master_email'";
$existenceUserResult = mysqli_query($link, $existenceUserQuery) or die("Ошибка".mysqli_error($link));

//если пользователь с такой почтой существует
if($existenceUserResult) {
	$rows = mysqli_num_rows($existenceUserResult);
	if($rows>0) {

		$row = mysqli_fetch_row($existenceUserResult); 
		$user_id=$row[0];

		//если пользователь с такой почтой уже назначен мастером
		$existenceMasterQuery="SELECT * FROM Master JOIN User ON Master.ID_user=User.ID WHERE User.email='$master_email'";
		$existenceMasterResult = mysqli_query($link, $existenceMasterQuery) or die("Ошибка".mysqli_error($link));

		if($existenceMasterResult) {
			$rows1 = mysqli_num_rows($existenceMasterResult);

			if($rows1==0) {
				$addMasterQuery = "INSERT INTO Master(ID_user) VALUES ('$user_id')";
				$addMasterResult = mysqli_query($link, $addMasterQuery) or die("Ошибка".mysqli_error($link));
			} else {
				echo "<div class='error-admin-msg'>Ошибка! Пользователь с такой почтой уже назначен мастером</div>";
			}
		}
	} else {
		echo "<div class='error-admin-msg'>Ошибка! Мастер не был назначен, так как зарегистрированного пользователя с такой почтой не существует</div>";
	}
}

?>