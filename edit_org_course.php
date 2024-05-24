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
	<?php
		$org_course_id=$_GET['id'];
	?>


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
					} else {
						echo "<a href='admin_panel.php' >
							<img src='images/arrow.png' class='arrow'>
							<div>ВЕРНУТЬСЯ НАЗАД</div>
						</a>";
					}
				?>

				
			</div>
			<!-- /GO-BACK BUTTON -->
			
			<!-- ERROR MESSAGE -->
			<div class="error_master"></div>
			<!-- /ERROR MESSAGE -->
				
			</div>
			<div class="admin-form-wrapper">
				<div class="white-form">
					<div class="form-content">

						<div class="title">Редактировать урок</div>
						<div class="form-inputs margin-top">

							<?php
								$query = "SELECT * FROM Organized_course WHERE id='$org_course_id'";
								$result = mysqli_query($link, $query) or die("Ошибка".mysqli_error($link));

								if($result) {
									$org_course = mysqli_fetch_assoc($result); 
								echo "
									<div>
										<p>Название </p>
										<textarea name='lesson-title' class='textarea-style border-style' type='text' required>кен</textarea>
									</div>

									<div>
										<p>Описание урока</p>
										<textarea name='lesson-description' class='textarea-style border-style' type='text' required>цукенг</textarea>
									</div>

									<div>
									
										
									</div>";
								}


							?>



							
						</div>
						<button class="form-btn save_edit_lesson_btn" id="<?= $org_course['ID'] ?>">
							<p>Сохранить</p>
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