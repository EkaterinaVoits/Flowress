<!DOCTYPE html>
<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include 'connect\connect_database.php';
?>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Flowress</title>
	<link rel="shortcut icon" href="images/icons/F.svg" />
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" href="css/masters_style.css" type="text/css">	

</head>

<body>
	<?php 
	require 'modules/page_elements/header.php';

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
		$user_telephone="";
	} 

	?>
 
<div class="page-content margin-top-block">
	<img src="images/splatters_2.png" class="splatters splatters_8">
	<div class="container">

		<p class="title">Наши преподаватели</p>

			<div class="masrers-block">

				<?php

				$mastersQuery = "SELECT User.name, User.ID, User.photo FROM Master JOIN User ON Master.ID_user=User.ID WHERE User.userType='master'";
				$mastersResult = mysqli_query($link, $mastersQuery) or die("Ошибка".mysqli_error($link));

				if($mastersResult) {
					$rows = mysqli_num_rows($mastersResult);
					for($i = 0; $i < $rows; ++$i)
					{
						$master = mysqli_fetch_assoc($mastersResult); 
						$master_id=$master['ID'];

						echo "
						<div class='card master-card'>
							<div class='master-card-content'>

								<img src='images/users_photos/".$master['photo']."' class='card-img'>
								<div>
									<p class='master-name'>".$master['name']."</p>
									<p class='show-masters-info-form' id='".$master_id."'>Подробнее о преподавателе</p>
								</div>
							</div>
							<div class='two-lines'></div>
						</div>
						";
					}
				}
				?>
				
			</div>

	</div>


</div>

		<!-- SPLATTERS -->
	


<!------------ MASTERS INFO FORM -------------->
	<div class="masters-info-form" id="masters-info-form">

		<div class="white-form-2">
			<div class="close-form">
				<img src="images/close.png" class="close-btn">
			</div>

			<div class="master-content-wrapper">

				<div class="form-content-2" id="masters-info">

					<div class='title'>
					</div>
					
				</div>
			</div>
			<div class="two-lines"></div>
		</div>
	</div>
<!------------ /FORM -------------->

<!-- ADD MASTER REVIEW BLOCK -->

<div class='add-comment-block block-margin'>
	<div class='container'>

		<div class='title-group'>
			<p class='title first-title'>Стать преподавателем</p>
			<p class='title second-title'>школы flowress</p>
		</div>
<?php

	if($id_user!=null) {
	
		echo "
			<img src='images/splatters_1.png' class='splatters splatters_9'>

					<div class='white-form-wrapper'>
						<div class='white-form'>
						<div class='plant-wrapper'>
							<div class='form-content'>

								<div style='display: flex;flex-direction: column;'>
									<p>Номер телефона</p>
									<input type='text' name='user_telephone' size='30' value='$user_telephone' class='border-style' id='user_telephone' placeholder='+375 (__) ___-__-__'>
									<span class='error-span none' name='telephone-error-span'></span>
								</div>

								<div style='display: flex;flex-direction: column;'>
									<p>Прикрепите Ваше портфолио</p>
									<input type='file' name='portfolio' class='border-style' id='portfolio'>
									<span class='error-span none' name='portfolio-error-span'></span>
								</div>

								<button class='form-btn add-master-request-btn'>
									<p>Отправить</p>
									<img src='images/arrow.png' class='arrow'>
								</button>
						
							</div>
							 <img src='images/plant_10.png' class='form-plant'>
							</div>
							<div class='two-lines'></div>
						</div>
					</div>

	
						
				";
		
	} else {
		echo "<div class='log-in'><a href='../modules/authorization/authorization.php'>Войдите</a> или <a href='../modules/registration/registration.php'>зарегистрируйтесь</a>, чтобы подать заявку на преподавателя</div>"; 
	}
	?>

	</div>
</div>
<!-- /ADD MASTER REVIEW BLOCK -->



<?php require 'modules/page_elements/footer.php';?>
</body>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://unpkg.com/imask"></script> 
<script src="js/mastersInfo.js"></script>
<script src="js/masterRequestForm.js"></script>
</html>