<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include 'connect\connect_database.php';
?>
<link rel="stylesheet" href="../../css/style.css" type="text/css">
<link rel="stylesheet" href="../../css/header_style.css" type="text/css">
<script src="js/jquery-3.4.1.min.js"></script>

<header class="header">
	<div class="container">
		<div class="header-body">

			<a href="index.php">
				Flowress
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