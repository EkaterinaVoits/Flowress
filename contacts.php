<!DOCTYPE html>
<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include 'connect\connect_database.php';
?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Your Beauty</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/styleHeader.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="js/jquery.maskedinput.min.js"></script>
</head>

<body>

	<?php 
	require 'modules/page_elements/header.php';
	?>
 
	<div class="page-content">

		<!-- LEFT PLANT -->
		<img src="images/plant_3.png" class="plant plant_15">

		<!-- RIGHT PLANT -->
		<img src="images/plant_2.png" class="plant plant_16">

		<div class="block block-12">
			<div class="container">
				<div class="contacts-block">

					<p class="title">Контакты</p>

					<div class="contact-content">
						<div class="contacts-items">
							<p>Адрес: г.Минск, ул.Долгобродская, 12, каб 217</p>
							<p>Телефоны для связи:</p>
							<p>Администратор: +375 29 632-14-22</p>
							<p>Эл.почта: Flowress_beauty_school@gmail.com</p>
							<p>График работы студии:</p>
							<p>ежедневно с 09:00 до 22:00</p>
							<p>Приём заявок на сайте: круглосуточно</p>
						</div>
						<div class="map">
							<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A109011ced34bf9ba68d58a016ee6840d33fa19098aa6dac7dba3a4aa153b1412&amp;width=500&amp;height=467&amp;lang=ru_RU&amp;scroll=true"></script>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>


<?php require 'modules/page_elements/footer.php';?>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="js/main.js"></script>

</html>