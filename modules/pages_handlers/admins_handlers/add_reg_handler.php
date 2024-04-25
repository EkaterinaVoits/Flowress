<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';

$users_email = $_POST["users_email"];	
$id_orgCourse = $_POST["id_orgCourse"];

$existenceUserQuery="SELECT id FROM User WHERE User.email='$users_email'";
$existenceUserResult = mysqli_query($link, $existenceUserQuery) or die("Ошибка".mysqli_error($link));

//если пользователь с такой почтой существует
if($existenceUserResult) {
	$rows = mysqli_num_rows($existenceUserResult);
	
	if($rows>0) {

		$row = mysqli_fetch_row($existenceUserResult); 
		$user_id=$row[0];

		//если пользователь с такой почтой уже зарегистрирован на данном курсе
		$existenceRegQuery="SELECT id FROM Course_registration WHERE Course_registration.ID_user='$user_id' AND Course_registration.ID_organizedCourse='$id_orgCourse'";
		$existenceRegResult = mysqli_query($link, $existenceRegQuery) or die("Ошибка".mysqli_error($link));

		if($existenceRegResult) {
			$rows1 = mysqli_num_rows($existenceRegResult);

			if($rows1==0) {
				$addRegQuery = "INSERT INTO Course_registration(ID_user, ID_organizedCourse, ID_status) VALUES ('$user_id','$id_orgCourse', 1)";
				$addRegResult = mysqli_query($link, $addRegQuery) or die("Ошибка".mysqli_error($link));
			} else {
				echo "<div class='error-admin-msg'>Ошибка! Запись не была добавлена, так как пользователь с такой почтой уже зарегистрирован на данном курсe</div>";
			}
		}

	} else {
		echo "<div class='error-admin-msg'>Ошибка! Запись не была добавлена, так как пользователя с такой почтой не существует</div>";
	}
}


?>
