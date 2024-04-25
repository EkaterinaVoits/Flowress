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
	<title>Admin panel</title>
	<link rel="stylesheet" href="../../css/style.css" type="text/css">
	<link rel="stylesheet" href="../../css/admin_panel_style.css" type="text/css">
</head>

<body>

	<?php require 'modules/page_elements/header.php';?>

	<div class="page-content margin-top">

		<!-------- BODY -------->
		<div class="container">

			<!-- GO-BACK BUTTON -->
			<div class="go-back">
				<a href="admin_panel.php" >
					<img src='images/arrow.png' class='arrow'>
					<div>ВЕРНУТЬСЯ НАЗАД</div>
				</a>
			</div>
			<!-- /GO-BACK BUTTON -->
			
			<!-- ERROR MESSAGE -->
			<div class="error_master"></div>
			<!-- /ERROR MESSAGE -->
				
			</div>
			<div class="admin-form-wrapper">
				<div class="white-form">
					<div class="form-content">

						<div class="title">Назначить преподавателя</div>
						<div class="form-inputs margin-top">
							<div>
								<p>Введите email пользователя</p>
								<input name="users-email" id="users_email" class="border-style" type="email" size="30" required>
							</div>
							
						</div>
						<button class="form-btn" id="add_master_btn">
							<p>Добавить</p>
						</button>

					</div>
					<div class="two-lines"></div>
				</div>
			</div>
	


		</div>
	</div>
</body>


<script src="../../../js/adminPanel.js"></script>
</html>