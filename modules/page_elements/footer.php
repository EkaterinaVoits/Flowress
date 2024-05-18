<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include 'connect\connect_database.php';
?>
<link rel="stylesheet" href="../../css/style.css" type="text/css">
<link rel="stylesheet" href="../../css/header_style.css" type="text/css">
<link rel="stylesheet" href="../../css/footer_style.css" type="text/css">
<script src="js/jquery-3.4.1.min.js"></script>

<footer class="footer">
	<hr class="border-style">
	<div class="container">
		<div class="footer-body">

			<a href="index.php">
				<img src="images/logo_vertical.png" class="footer-logo">
			</a>


			<nav class="footer-menu">
				<ul class="footer-list">
					<?php 

					if(session_status()!=PHP_SESSION_ACTIVE) session_start();
					require_once'C:\OSPanel\domains\flowress\connect\connect_database.php';

					$query = "SELECT * FROM Menu";
					$result = mysqli_query($link, $query) or die("Ошибка выполнения запроса".
						mysqli_error($link));

					for ($i=0; $i<mysqli_num_rows($result); $i++) {
						$menu = mysqli_fetch_assoc($result);
						echo "<li><a class='header-link' href=".$menu['path'].">".$menu['title']."</a></li>";	
					}


					?>
				</ul>
			</nav>

			<div class="social-networks">
				<img src="images/inst.png">
				<img src="images/vk.png">
				<img src="images/viber.png">
			</div>

		</div>
	</div>

</footer>
