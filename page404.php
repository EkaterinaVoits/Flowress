<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Flowress</title>
	<link rel="shortcut icon" href="images/icons/F.svg" />
	<link rel="stylesheet" type="text/css" href="css/styleHeader.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="js/jquery.maskedinput.min.js"></script>
</head>

<body>

	<?php require 'modules/page_elements/header.php';

	if(isset($_SESSION['user']['id'])) {
		$id_user=$_SESSION['user']['id'];
	} else {
		$id_user=null;
	}
	?>


	<div class="page-content">

		<!-- LEFT PLANT -->
		<img src="images/plant_3.png" class="plant plant_17">

		<div class="block block-12">
			<div class="container">
				<div class="block-404">

					<p class="title">Страница не найдена</p>
					<p class="number-404">404</p>
					<a href="index.php" class="btn"><p>Вернуться на главную</p></a>
				</div>
			</div>
		</div>

		<!-- RIGHT PLANT -->
		<img src="images/plant_5.png" class="plant plant_18">

	</div>
	

	<?php require 'modules/page_elements/footer.php';?> 



</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="js/main.js"></script>

</html>