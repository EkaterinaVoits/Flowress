<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include 'connect\connect_database.php';
?>
<link rel="stylesheet" href="../../css/style.css" type="text/css">
<link rel="stylesheet" href="../../css/header_style.css" type="text/css">
<script src="js/jquery-3.4.1.min.js"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz@0,6..96;1,6..96&family=Kanit:wght@600;800&family=Manrope:wght@800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito+Sans:wght@700&family=Open+Sans:wght@800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playfair:ital,opsz,wght@0,5..1200,300..900;1,5..1200,300..900&family=Prompt:wght@600;900&family=Raleway:ital@0;1&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

<header class="header">
	<div class="container">
		<div class="header-body">

			<a href="index.php">
				<img src="images/logo_horizontal.png" class="header-logo">
			</a>

			<div class="header-burger">
				<span>
				</span>
			</div>

			<nav class="header-menu">
				<ul class="header-list">
					<?php include 'modules/menu/menu.php';?>
				</ul>
			</nav>

		</div>
	</div>
	<hr class="border-style">
</header>

<script src="js/menu.js"></script>