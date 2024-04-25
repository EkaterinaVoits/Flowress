<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include 'connect\connect_database.php';
?>
<link rel="stylesheet" href="../../css/style.css" type="text/css">
<script src="../../js/jquery-3.4.1.min.js"></script>

<?php

//$id_orgCourse=$_GET['id_orgCourse'];
if(isset($_SESSION['user']['id'])) {
	$id_user=$_SESSION['user']['id'];

	$userQuery = "SELECT * FROM  User WHERE User.ID=$id_user";								
	$userResult = mysqli_query($link, $userQuery) or die("Ошибка " . mysqli_error($link));

	if($userResult) {
		$user = mysqli_fetch_assoc($userResult); 
		$user_name=$user["name"];
		$user_telephone=$user["telephone"];
	}
} else {
	$id_user="";
	$user_name="";
	$user_telephone="";
} 


?>

<!-- CONSULTATION BLOCK -->
	<div class="block block-8">
		<div class="container">

			<div class="title-group">
				<p class="title first-title">ДЛЯ КОНСУЛЬТАЦИИ</p>
				<p class="title second-title">ЗАПОЛНИТЕ ФОРМУ</p>
			</div>

			<div class="white-form-wrapper">
				<div class="white-form">
					<div class="form-content">

						<div>
							<p>Ваше имя</p>
							<input type="text" name="user_name_consult" size="30" value="<?= $user_name ?>" class="border-style" id="user_name_consult">
						</div>
						<div>
							<p>Номер телефона</p>
							<input type="text" name="user_telephone_consult" size="30" value="<?= $user_telephone ?>" class="border-style" id="user_telephone_consult">
						</div>

						<button class="form-btn take-consult-btn">
							<p>Отправить</p>
							<img src="images/arrow.png" class="arrow">
						</button>

					</div>
					<div class="two-lines"></div>
				</div>
			</div>
		</div>
	</div>
<!-- /CONSULTATION BLOCK -->

<script src="../../js/consultForm.js"></script>