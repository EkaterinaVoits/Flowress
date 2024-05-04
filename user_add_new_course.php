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
	<title>User course</title>
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
				<a href="catalog.php" >
					<img src='images/arrow.png' class='arrow'>
					<div>ВЕРНУТЬСЯ НАЗАД</div>
				</a>
			</div>
			<!-- /GO-BACK BUTTON -->

			<!-- ERROR MESSAGE -->
			<div class="error_add_new_course"></div>
			<!-- /ERROR MESSAGE -->

			<div class="admin-form-wrapper">
				<div class="white-form">
					<div class="form-content">

						<div class="title">Ваш индивидуальный курс</div>
						<div class="form-inputs margin-top">

							<div> 
								<p>Выберите желаемую дату начала курса</p>
								<input name="user-course-startDate" type="date" class="select-style" required>
							</div>
							<div>
								<p>Выберите уроки</p>
								<?php

								$lessonsQuery = "SELECT * FROM Lesson";
								$lessonsResult = mysqli_query($link, $lessonsQuery) or die("Ошибка".mysqli_error($link));

								if($lessonsResult)
								{
									$rows = mysqli_num_rows($lessonsResult);
									for($i = 0; $i < $rows; ++$i)
									{
										$row = mysqli_fetch_assoc($lessonsResult); 
										echo "<div class='lesson-item'>
												<input type='checkbox' class='lessons-checkboxes lessons-ckbx' name='lessons-ckbx' value='".$row['ID']."'>
												<label for='lesson'>".$row['title']."</label>
											</div>";
									}
								}
								?>
							</div>

							<div>
								<p>Ваши пожелания к курсу</p>
								<textarea type='text' class='new-course-description-textarea border-style' name='course_full_description' ></textarea>
							</div>
							
						</div>
						
						<div class='title user-course-price' data-tooltip='Cкидка 5% от 3 уроков. Скидка 10% от 7 уроков'>Стоимость: 0 BYN*
						</div>

						<button class="form-btn" id="user_add_new_course_btn">
							<p>Отправить завку</p>
						</button>

					</div>
					<div class="two-lines"></div>
				</div>
			</div>
	


		</div>
	</div>
</body>


<script src="../../../js/userAddNewCourse.js"></script>
</html>