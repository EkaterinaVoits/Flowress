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
	<title>Beauty courses catalog</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" href="css/course_style.css" type="text/css">	
	<link rel="stylesheet" href="css/slider_style.css" type="text/css">	
</head>

<body>
	<?php require 'modules/page_elements/header.php';?>

	<div class="page-content">

	<!------------ SHORT COURSE DESCRIPTION BLOCK -------------->
	<div class="block block-9">
		<div class="container">

			<!-- GO-BACK BUTTON -->
			<div class="go-back">
				<a href="catalog.php" >
					<img src='images/arrow.png' class='arrow'>
					<div>КАТАЛОГ</div>
				</a>
			</div>
			<!-- /GO-BACK BUTTON -->


			<!-- COURSE DESCRIPTION SECTION -->
			<div class='course'>

				<?php

				$today = date('Y-m-d');

				$id_course=$_GET['id'];
				if(isset($_SESSION['user']['id'])) {
					$id_user=$_SESSION['user']['id'];
				} else {
					$id_user=null;
				}
				
				$query = "SELECT * FROM Course WHERE id='$id_course'";
				$result = mysqli_query($link, $query) or die("Ошибка".mysqli_error($link));

				if($result) {
					$row = mysqli_fetch_assoc($result); 
				echo "

				<div class='image-rect course-img-rect'>
					<img src='images/courses_images/".$row['photo']."' class='course-img'>
				</div>	

				<div class='course-description'>

					<div class='title course-title'>".$row['title']."</div>

					<div class='course-short-description'>".$row['description']."</div>

					<div class='course-item-advantages'>
						<ul type='disc' class='course-advantages'>
							<li>практика на каждом занятии</li>
							<li>сертификат по окончании курса</li>
							<li>самые трендовые техники макияжа</li>
						</ul>
					</div>

					<p class='title course-price'>стоимость: ".$row['price']." byn</p>

					<button class='btn' >
						<a href='#reserve-form'>
							<p>Записаться</p>
							<img src='images/arrow.png' class='arrow'>
						</a>
					</button>
					";
				}
					?>
				</div>

				<!-- /COURSE DESCRIPTION SECTION -->
			</div>
		</div>

		<!------------ RIGHT PLANT -------------->
		<img src="images/plant_2.png" class="plant_10">

		<!-- COURSE DESCRIPTION BLOCK -->
		<div class="block block-2">
			<div class="brown-rect">
				<div class="white-line">
					<div class="container">
						<div class="full-course-description">
							<?php echo $row['fullDescription'];?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /COURSE DESCRIPTION BLOCK -->

		<!------------ LEFT PLANT -------------->
		<img src="images/plant_8.png" class="plant plant_11">

		<!-- COURSE PROGRAM BLOCK -->
		<div class="block block-6">
			<div class="container">

				<div class="title-group">
					<p class="title first-title">ПРОГРАММА</p>
					<p class="title second-title">КУРСА</p>
				</div>

				<div class='lessons'>

					<?php
						$lessonQuery = "SELECT * FROM Course JOIN Course_lessons ON Course.ID=Course_lessons.ID_course JOIN Lesson ON Course_lessons.ID_lesson=Lesson.ID WHERE Course.ID=$id_course";

							$lessonResult = mysqli_query($link, $lessonQuery) or die("Ошибка".mysqli_error($link));
								if($lessonResult)
								{
									$rows2 = mysqli_num_rows($lessonResult);
									$lesson_number=1;
									for($j = 0; $j < $rows2; ++$j)
									{

										$row2 = mysqli_fetch_assoc($lessonResult); 
										
										echo "
										<div>
											<div class='lesson-item'>
												<div class='lesson-title'>
													Занятие ".$lesson_number.". ".$row2['title']."
												</div>
												<div class='show-block'>
													<span></span>
												</div>
											</div>

											<div class='lesson-program'>
												<div class='lesson-wrapper'>

													<img src='images/splatters_5.png' class='splatters splatters_5'>

													<div class='image-rect lesson-img'>
														<img src='images/lessons_images/".$row2['photo']."'>
													</div>

													<div class='lesson-program-text'>
														<ul type='disc' class='course-advantages'>
															<li>".$row2['description']."</li>
														</ul>
													</div>
												</div>
											</div>
										</div>";
										$lesson_number++;
									}
								}
						?>
				</div>
			</div>
		</div>
	<!-- /COURSE PROGRAM BLOCK -->

	<!-- REVIEWS SLIDER BLOCK -->
	<?php

	$reviewQuery = "SELECT * FROM Course_review WHERE ID_course='$id_course'";
	$reviewResult = mysqli_query($link, $reviewQuery) or die("Ошибка".mysqli_error($link));
	$reviews = mysqli_num_rows($reviewResult);

	if($reviews!=0) {
		echo "

		<div class='block block-11'>
		<div class='container'>

			<div class='title-group'>
				<p class='title first-title'>отзывы НАШИХ</p>
				<p class='title second-title'>УЧЕНИКОВ О КУРСЕ</p>
			</div>
			<div id='slider-reload' class='slider-reload'>
			";

			require 'modules/page_elements/reviews_slider.php';

		echo "</div></div>
	</div>";
	}

		?>
	<!-- /REVIEWS SLIDER BLOCK -->

	<!-- ADD REVIEW BLOCK -->
	<?php

	if($id_user!=null) {
	$courseQuery = "SELECT * FROM Course_registration JOIN Organized_course ON Course_registration.ID_organizedCourse=Organized_course.ID WHERE Course_registration.ID_user=$id_user AND Organized_course.ID_course=$id_course AND Course_registration.ID_status IN (5,6)";
	$courseResult = mysqli_query($link, $courseQuery) or die("Ошибка".mysqli_error($link));

	if ($courseResult) {
		$rows = mysqli_num_rows($courseResult);
		if ($rows!=0) {
			echo "
				<div class='add-comment-block block-margin'>
					<div class='container'>

						<div class='title-group'>
							<p class='title first-title'>Добавить </p>
							<p class='title second-title'>отзыв о курсе</p>
						</div>

						<div class='white-form-wrapper'>
							<div class='review-form'>
								<div class='add-review-content'>
								<div class='rating'>Рейтинг: ";
									require 'modules/page_elements/lips.php';
								echo "
								</div>
									<textarea type='text' class='review-textarea' name='review-textarea' id='review-textarea' required=''></textarea>
									<button class='btn add-review-btn'>
										<p>Отправить</p>
										<img src='images/arrow.png' class='arrow'>
									</button>
								</div>
								<div class='two-lines'></div>
							</div>
						</div>
							
					</div>
				</div>";
			}
		}
	}
	?>
	<!-- /ADD REVIEW BLOCK -->


	<!-- ORGANIZED COURSE SECTION  -->
	<div class="block block-5">
		<div class="container">

			<div class="title-group">
				<p class="title first-title">Успейте </p>
				<p class="title second-title">записаться</p>
			</div>

			<div class="organized-сourses-items-container">

				<?php
				
				$organizedCourseQuery = "SELECT Organized_course.ID, Organized_course.startDate,  User.name, Course.title, Course.price, Group_type.groupType, Group_type.priceCoefficient FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Courses_schedule ON Courses_schedule.ID_organizedCourse=Organized_course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Course.ID='$id_course' AND Organized_course.startDate>'$today' GROUP BY Organized_course.ID";

				$organizedCourseResult = mysqli_query($link, $organizedCourseQuery) or die("Ошибка".mysqli_error($link));

				if($organizedCourseResult)
				{
					$rows = mysqli_num_rows($organizedCourseResult);
					for($c = 0; $c < $rows; ++$c) 
					{ 
						$organizedCourse = mysqli_fetch_assoc($organizedCourseResult);

						$id_organizedCourse=$organizedCourse['ID'];

						echo "
						<div class='organized-course-item'>
							<div class='course-item-content'>
								<div class='course-item-description'>
									<div><span>Начало: </span>".$organizedCourse['startDate']."</div>
									<div><span>Группа: </span>".$organizedCourse['groupType']."</div>
									<div><span>График: </span> </div>";


									$scheduleQuery = "SELECT * FROM Courses_schedule JOIN DateTime_class ON Courses_schedule.ID_dateTimeClass=DateTime_class.ID  WHERE Courses_schedule.ID_organizedCourse=$id_organizedCourse";
									$scheduleResult = mysqli_query($link, $scheduleQuery) or die("Ошибка".mysqli_error($link));

									if($scheduleResult) 
									{	
										$rows3 = mysqli_num_rows($scheduleResult);
										for($s = 0; $s < $rows3; ++$s) 
										{
											$schedule = mysqli_fetch_assoc($scheduleResult); 
											echo "<div>".$schedule['day']." ".$schedule['time']." </div>
											";

										}
										mysqli_free_result($scheduleResult);
									}

									echo "
									
									<div><span>Преподаватель: </span><a href='index.php'>
									".$organizedCourse['name']."</a></div>
									<div><span>Стоимость:</span> ".$organizedCourse['price']*$organizedCourse['priceCoefficient']." byn</div>
								</div>
								<div class='course-item-reserve'>
									<a href='/authorization.php'>Войдите</a>, чтобы подать заявку
								</div>
							</div>
							<div class='two-lines'>
							</div>
						</div>
						";
					}
					if($rows==0) {
						echo "<div>Ожидайте появления курса в <a href='course_schedule.php'> расписании</a></div>";
					}
				}
				?>

			</div>
		</div>
	</div>
	<!-- /POPULAR COURSES -->

</div>
<?php require 'modules/page_elements/footer.php';?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="js/showLessonProgram.js"></script>
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/review.js"></script>


</body>
</html>

