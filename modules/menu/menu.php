<?php 

if(session_status()!=PHP_SESSION_ACTIVE) session_start();
/*require_once 'C:\OSPanel\domains\flowress\connect\connect_database.php';*/

require_once $_SERVER['DOCUMENT_ROOT'].'/connect/connect_database.php';

?>
<li>
	<?php

	$query = "SELECT * FROM Menu";
	$result = mysqli_query($link, $query) or die("Ошибка выполнения запроса".
			mysqli_error($link));

	if (empty($_SESSION['user']['name'])){


		for ($i=0; $i<mysqli_num_rows($result); $i++) {
			$menu = mysqli_fetch_assoc($result);
			echo "<li><a class='header-link' href=".$menu['path'].">".$menu['title']."</a></li>";	
		}

		echo "<li><a class='header-link header-link-delimiter' href='modules/authorization/authorization.php'>Вход</a></li>";
	} else {
		if($_SESSION['userType']=="user") {

			for ($j=0; $j<mysqli_num_rows($result); $j++) {
				$menu = mysqli_fetch_assoc($result);
				echo "<li><a class='header-link' href=".$menu['path'].">".$menu['title']."</a></li>";	
			}

			echo "<li><a class='header-link' href='profile_page.php'>Личный кабинет</a></li>";
		} else if ($_SESSION['userType']=="master") {
			echo "<a class='header-link' href='master_panel.php'>Управление</a>";
		} else {
			echo "<a class='header-link'  href='admin_panel.php'>Панель администрирования</a>";
		}
	}
	?>
</li>

<li>
	<?php
	if (empty($_SESSION['user']['name'])){
		echo "<a class='header-link' href='/modules/registration/registration.php'>Регитрация</a>";
	} else {						
		echo "<a class='header-link' href='..\modules\authorization\authorization_out.php'>Выход</a>";
	}						
	?>	
</li>


