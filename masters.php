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
	<title>Masters page</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" href="css/masters_style.css" type="text/css">	

</head>

<body>
	<?php 
	require 'modules/page_elements/header.php';
	?>

<div class="page-content margin-top-block">
	<div class="container">

		<p class="title">Наши преподаватели</p>

			<div class="masrers-block">

				<?php

				$mastersQuery = "SELECT User.name, User.ID, User.photo FROM Master JOIN User ON Master.ID_user=User.ID";
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

								<div class='rating-block'>";
								$masterRatingQuery = "SELECT ROUND(AVG(rating), 1) FROM Master_rating JOIN Master ON Master_rating.ID_master=Master.ID JOIN User ON Master.ID_user=User.ID WHERE User.ID=$master_id";

								$masterRatingResult = mysqli_query($link, $masterRatingQuery) or die("Ошибка".mysqli_error($link));

								if($masterRatingResult)
								{
									$rating = mysqli_fetch_row($masterRatingResult); 
									if($rating[0]==null){
										echo "
											<p>нет оценок</p>
										";
									} else {
										
										echo "Рейтинг: 
											<img src='images/rating/rating.png' class='rating-img'>
											<p class='rating-text'>".$rating[0]."/5</p>
										";
									}
								}

								echo "
								</div>
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


<!------------ MASTERS INFO FORM -------------->
	<div class="masters-info-form" id="masters-info-form">

		<div class="white-form-2">
			<div class="close-form">
				<img src="images/close.png" class="close-btn">
			</div>

			<div class="form-content-wrapper">

				<div class="form-content-2" id="masters-info">

					<div class='title'>
					</div>
					<div>
					</div>
					<div><div>
					
				</div>
			</div>
			<div class="two-lines"></div>
		</div>
	</div>
<!------------ /FORM -------------->


</body>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/mastersInfo.js"></script>
</html>