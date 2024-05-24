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
				<?php
					if($_SESSION['userType']=="master") {
						echo "<a href='master_panel.php' >
							<img src='images/arrow.png' class='arrow'>
							<div>ВЕРНУТЬСЯ НАЗАД</div>
						</a>";
					} 
				?>

				
			</div>
			<!-- /GO-BACK BUTTON -->
			
			<!-- ERROR MESSAGE -->
			<div class="error_lesson error-msg" id="error-msg"></div>
			<!-- /ERROR MESSAGE -->
				
			
			<div class="admin-form-wrapper">
				<div class="white-form">
					<div class="form-content">

						<div class="title">Добавить урок</div>
						<div class="form-inputs margin-top">

							<div>
								<p>Введите название урока</p>
								<textarea name='lesson-title' class='textarea-style border-style' type='text' required></textarea>
							</div>

							<div>
								<p>Введите описание урока</p>
								<textarea name='lesson-description' class='textarea-style border-style' type='text' required></textarea>
							</div>

							<div>
								<p>Добавьте фото к уроку</p>
								<input name='new-lesson-photo' id='lesson_material' class='border-style' type='file' required>
							</div>

							<div>
								<p>Добавьте материал к уроку</p>
								<input name='new-lesson-material' id='lesson_material' class='border-style' type='file' required>
							</div>

							<div>
								<p>Добавьте домашнее задание к уроку</p>
								<input name='new-lesson-homeworkTask' id='lesson_material' class='border-style' type='file' required>
							</div>
							
						</div>
						<button class="form-btn add_lesson_btn">
							<p>Добавить</p>
						</button>

					</div>
					<div class="two-lines"></div>
				</div>
			</div>
	


		</div>
	</div>
</body>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="../../../js/masterProfilePage.js"></script>
</html>