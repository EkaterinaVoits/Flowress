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
		$id_lesson=$_GET['id'];
	?>


	<?php require 'modules/page_elements/header.php';?>

	<div class="page-content margin-top">

		<!-------- BODY -------->
		<div class="container">

			<!-- GO-BACK BUTTON -->
			<div class="go-back">
				<a href="master_panel.php" >
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

						<div class="title">Редактировать урок</div>
						<div class="form-inputs margin-top">

							<?php
								$query = "SELECT * FROM Lesson WHERE id='$id_lesson'";
								$result = mysqli_query($link, $query) or die("Ошибка".mysqli_error($link));

								if($result) {
									$lesson = mysqli_fetch_assoc($result); 
								echo "
									<div>
										<p>Название урока</p>
										<textarea name='lesson-title' class='textarea-style border-style' type='text' required>".$lesson['title']."</textarea>
									</div>

									<div>
										<p>Описание урока</p>
										<textarea name='lesson-description' class='textarea-style border-style' type='text' required>".$lesson['description']."</textarea>
									</div>

									<div>";
									
										if($lesson['lessonMaterial']==null) {
											echo "Методичка к уроку не добавлена";
										} else {
											echo "
											<p>Методичка к уроку</p>
											<a href='lessons_materials/lesson_guides/".$lesson['lessonMaterial']."' target='_blank'>".$lesson['lessonMaterial']."</a>";
										}
										
										echo "
										<button class='change-lessonMaterial-btn' id='change-lessonMaterial-btn'>Изменить</button>
										<div id='add-new-lesson-material' class='add-new-lesson-material'>
											<input name='lesson-material' id='lesson_material' class='border-style' type='file' required>
										</div>
									</div>

									<div>";
										if($lesson['homeworkTask']==null) {
											echo "Домашнее задание к уроку не добавлено";
										} else {
											echo "
											<p>Домашнее задание к уроку</p>
											<a href='lessons_materials/homework_tasks/".$lesson['homeworkTask']."' target='_blank'>".$lesson['homeworkTask']."</a>";
										}
										
										echo "
										<button class='change-lesson-homeworkTask-btn' id='change-homeworkTask-btn'>Изменить</button>
										<div id='add-new-lesson-homeworkTask' class='add-new-lesson-homeworkTask'>
											<input name='lesson-homeworkTask' id='lesson_homeworkTask' class='border-style' type='file' required>
										</div>
									</div>";
								}


							?>



							
						</div>
						<button class="form-btn save_edit_lesson_btn" id="<?= $lesson['ID'] ?>">
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