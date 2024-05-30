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
		$id_course=$_GET['id'];
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
			<div class="massage_add_new_course"></div>
			<!-- /ERROR MESSAGE -->

			<div class="admin-form-wrapper">
				<div class="white-form">
					<div class="form-content">

						<div class="title">Редактировать курс</div>
						<div class="form-inputs">

							<?php
								$query = "SELECT * FROM Course WHERE id='$id_course'";
								$result = mysqli_query($link, $query) or die("Ошибка".mysqli_error($link));

								if($result) {
									$course = mysqli_fetch_assoc($result); 
								}
							?>

							<div class='form-input-block'>
								<p>Название курса</p>
								<input name='course-title' class='border-style' type="email" size="30" value="<?= $course['title'] ?>" required>
								<span class='error-span none' name='course-title-error-span'></span>
							</div>
							<div class="form-input-block">
								<p>Описание курса</p>
								<input type='text' class='course-description border-style' name='course-description' value="<?= $course['description'] ?>"></input>
								<span class='error-span none' name='course-description-error-span'></span>
							</div>
							<div class="form-input-block">
								<p>Полное описание курса</p>
								<input type='text' class='course-full-description border-style' name='course-full-description' value="<?= $course['fullDescription'] ?>"></input>
								<span class='error-span none' name='course-full-description-error-span'></span>
							</div>

							<div>

								<p>Уроки</p>
								<?php

								$lessonsQuery = "SELECT * FROM Lesson";
								$lessonsResult = mysqli_query($link, $lessonsQuery) or die("Ошибка".mysqli_error($link));

								if($lessonsResult)
								{
									$rows = mysqli_num_rows($lessonsResult);

									for($i = 0; $i < $rows; ++$i)
									{
										$row = mysqli_fetch_assoc($lessonsResult); 
										$id_lesson=$row['ID'];
										$checked = "";

										$courseLessonsQuery = "SELECT * FROM Course_lessons WHERE ID_course='$id_course' AND id_lesson='$id_lesson' ";
										$courseLessonsResult = mysqli_query($link, $courseLessonsQuery) or die("Ошибка".mysqli_error($link));

										if(mysqli_num_rows($courseLessonsResult) > 0){
											$checked = "checked";
										}

										echo "<div class='lesson-item'>
												<input type='checkbox' class='lessons-checkboxes lessons-ckbx' name='lesson' value='".$row['ID']."'  $checked>
												<label for='lesson'>".$row['title']."</label>
											</div>";
									}
								}
								?>
								<span class='error-span none' name='course-lessons-error-span'></span>
							</div>

							<div class="form-input-block">
								<p>Стоимость курса</p>
								<input name="course-price" class="border-style" type="number"  value="<?= $course['price'] ?>" required>
								<span class='error-span none' name='course-price-error-span'></span>
							</div>
						</div>
	

						<button class="form-btn save_edit_course_btn" id="<?= $course['ID'] ?>">
							<p>Сохранить</p>
						</button>

					</div>
					<div class="two-lines"></div>
				</div>
			</div>
	


		</div>
	</div>
</body>


<script src="../../../js/editCourse.js"></script>
</html>