<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';

require_once __DIR__ .'../../../../mail/vendor/autoload.php';
$settings = require_once __DIR__ .'../../../../mail/settings.php';
require_once __DIR__ .'../../../../mail/functions.php';

$user_id = $_POST["user_id"];	
	
$existenceUserQuery="SELECT * FROM User WHERE ID='$user_id'";
$existenceUserResult = mysqli_query($link, $existenceUserQuery) or die("Ошибка".mysqli_error($link));

//если пользователь с такой почтой существует
if($existenceUserResult) {
	$rows = mysqli_num_rows($existenceUserResult);
	if($rows>0) {

		$row = mysqli_fetch_assoc($existenceUserResult); 
		$user_id=$row['ID'];
		$user_tel=$row['ID'];

		$query2 = "SELECT email FROM User WHERE ID='$user_id'";
		$result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));

		if($result2){
			$user=mysqli_fetch_row($result2);
			$email_user=$user[0];
		}

		//если пользователь с такой почтой уже назначен мастером
		$existenceMasterQuery="SELECT * FROM Master JOIN User ON Master.ID_user=User.ID WHERE User.ID='$user_id'";
		$existenceMasterResult = mysqli_query($link, $existenceMasterQuery) or die("Ошибка".mysqli_error($link));

		if($existenceMasterResult) {
			$rows1 = mysqli_num_rows($existenceMasterResult);

			if($rows1==0) {
				$addMasterQuery = "INSERT INTO Master(ID_user) VALUES ('$user_id')";
				$addMasterResult = mysqli_query($link, $addMasterQuery) or die("Ошибка".mysqli_error($link));

				$setUserTypeQuery="UPDATE User SET userType = 'master' WHERE ID='$user_id'";
				$setUserTypeResult = mysqli_query($link, $setUserTypeQuery) or die("Ошибка".mysqli_error($link));


				$dropFromMasterRequestQuery="DELETE FROM Master_request WHERE ID_user='$user_id'";
				$dropFromMasterRequestResult = mysqli_query($link, $dropFromMasterRequestQuery) or die("Ошибка " .
    			mysqli_error($link));

    			if($addMasterResult && $setUserTypeResult && $dropFromMasterRequestResult) {
    				require '..\..\page_elements\admin_tables\masters_body_table.php';

    				$body="<h2>Вы назначены преподавателем нашей школы!</h2> <br><br>
				    
				    Авторизируйтесь на сайте Flowress.by, заполните данные о себе и начините работу!<br>
				    Связаться с администратором можно по почте Flowress_beauty_school@gmail.com и по номеру телефона +375 (29) 632-14-22 <br>
				    <br><br>

				    Благодарим, что выбрали нас!";

				    send_mail($settings['mail_settings_prod'], [$email_user], 'Письмо с сайта Flowress', $body);
			    			}

			} else {
				echo "<div class='error-admin-msg'>Ошибка! Пользователь с такой почтой уже назначен мастером</div>";
			}
		}
	} else {
		echo "<div class='error-admin-msg'>Ошибка! Мастер не был назначен, так как зарегистрированного пользователя с такой почтой не существует</div>";
	}
}

?>