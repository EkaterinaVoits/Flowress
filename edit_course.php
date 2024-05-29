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
							<div class="form-input-block">
								<p>Введите название курса</p>
								<input name="course-title" class="border-style" type="email" size="30" required>
								<span class='error-span none' name='course-title-error-span'></span>
							</div>
							<div class="form-input-block">
								<p>Введите описание курса</p>
								<input type='text' class='course-description border-style' name='course-description'></input>
								<span class='error-span none' name='course-description-error-span'></span>
							</div>
							<div class="form-input-block">
								<p>Введите полное описание курса</p>
								<input type='text' class='course-full-description border-style' name='course-full-description'></input>
								<span class='error-span none' name='course-full-description-error-span'></span>
							</div>

							<div>

								<p>Выберите уроки</p>
								<?php

								$lessonsQuery = "SELECT * FROM Lesson WHERE isActive=1";
								$lessonsResult = mysqli_query($link, $lessonsQuery) or die("Ошибка".mysqli_error($link));

								if($lessonsResult)
								{
									$rows = mysqli_num_rows($lessonsResult);
									for($i = 0; $i < $rows; ++$i)
									{
										$row = mysqli_fetch_assoc($lessonsResult); 
										echo "<div class='lesson-item'>
												<input type='checkbox' class='lessons-checkboxes lessons-ckbx' name='lesson' value='".$row['ID']."'>
												<label for='lesson'>".$row['title']."</label>
											</div>";
									}
								}
								?>
								<span class='error-span none' name='course-lessons-error-span'></span>
							</div>

							<div class="form-input-block">
								<p>Прикрепите фотографию курса</p>
								<input type='file' name='course-photo' class='border-style' id='course_photo'>
								<span class='error-span none' name='course-photo-error-span'></span>
							</div>
							<div class="form-input-block">
								<p>Введите стоимость курса</p>
								<input name="course-price" class="border-style" type="number" srequired>
								<span class='error-span none' name='course-price-error-span'></span>
							</div>
						</div>
	

						<button class="form-btn" id="add_new_course_btn">
							<p>Добавить</p>
						</button>

					</div>
					<div class="two-lines"></div>
				</div>
			</div>
	


		</div>
	</div>
</body>


<script src="../../../js/addNewCourse.js"></script>
</html>