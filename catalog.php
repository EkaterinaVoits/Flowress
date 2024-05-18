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
	<link rel="stylesheet" href="css/catalog_style.css" type="text/css">
	<link rel="stylesheet" href="css/course_item_style.css" type="text/css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/main.js"></script>
</head>

<body>
	<?php require 'modules/page_elements/header.php';

	if(isset($_SESSION['user']['id'])) {
		$id_user=$_SESSION['user']['id'];
	} else {
		$id_user=null;
	}
	?>

	<div class="page-content margin-top-block">
		<div class="container">

			<p class="title">Наши курсы</p>

			<div class="courses-catalog-content">

				<?php

				$courseQuery = "SELECT Course.ID, Course.photo, Course.title, Course.description FROM Course JOIN User ON Course.ID_user=User.ID WHERE User.userType IN ('admin', 'master')";
				$courseResult = mysqli_query($link, $courseQuery) or die("Ошибка".mysqli_error($link));

				if($courseResult)
				{
					$rows = mysqli_num_rows($courseResult);
					for($i = 0; $i < $rows; ++$i)
					{
						$row = mysqli_fetch_assoc($courseResult); 
						$id_course=$row['ID'];
						echo "
						<div class='course-item'>

						<img src='images/courses_images/".$row['photo']."' class='course-item-img'>

						<div class='course-white-rect'>
							<div class='course-item-content'>

							<div class='rating-block'>";
								

								$courseRatingQuery = "SELECT ROUND(AVG(rating), 1) FROM Course_rating WHERE ID_course=$id_course";

								$courseRatingResult = mysqli_query($link, $courseRatingQuery) or die("Ошибка".mysqli_error($link));

								if($courseRatingResult)
								{
									$rating = mysqli_fetch_row($courseRatingResult); 
									if($rating[0]==null){
										echo "
											<p>нет оценок</p>
										";
									} else {
										
										echo "Рейтинг: 
											<img src='images/rating/rating.png' class='rating-img'>
											<p class='rating-text'>".$rating[0]."/5</p>
										";
									}
								}

								echo "
							</div>

							<img src='images/courses_images/".$row['photo']."' class='course-item-img-2'>

							<div class='course-item-content-wrapper-2'>

							<div class='title'>".$row['title']."</div>

							<div>".$row['description']."</div>
							<div class='course-item-lessons'>";

							$lessonQuery = "SELECT * FROM Course JOIN Course_lessons ON Course.ID=Course_lessons.ID_course JOIN Lesson ON Course_lessons.ID_lesson=Lesson.ID WHERE Course.ID=$id_course";

							$lessonResult = mysqli_query($link, $lessonQuery) or die("Ошибка".mysqli_error($link));
								if($lessonResult)
								{
									$rows2 = mysqli_num_rows($lessonResult);
									for($j = 0; $j < $rows2; ++$j)
									{
										$row2 = mysqli_fetch_assoc($lessonResult); 
										
										echo "
											<span class='item-lesson'>
													<img src='images/mark.png' class='mark-img'>
													<span>".$row2['title']."</span>
											</span> ";

										//echo "<div>".$row2['title']."</div>";

									}
								
								}
								mysqli_free_result($lessonResult); 
							echo "

							</div>

							<button class='btn' onclick='showCourse(this.id) ' id=".$row['ID'].">
								<p>Узнать больше</p>
								<img src='images/arrow.png'>
							</button>	
							</div>
							</div>

							<div class='two-lines'></div>
						</div>
						</div>
						";
					}
					
				}
				mysqli_free_result($courseResult); 
				?>

			</div>
		</div>
	</div>

	<div class="block margin-top-block">
		<div class="container">

			<div class="title-group">
				<p class="title first-title">Хотите составить</p>
				<p class="title second-title">индивидуальный курс?</p>
			</div>

			<!-- <a href="user_add_new_course.php" class='btn'>Создать свой курс</a> -->

			<?php

			if($id_user!=null) {
				echo "

				<div class='form-wrapper'>
				<div class='white-form'>
					<div class='form-content'>

						<div class='form-inputs'>

							<div> 
								<p>Выберите желаемую дату начала курса</p>
								<input name='user-course-startDate' type='date' class='select-style' required>
							</div>

							<div>
								<p>Выберите мастера</p>
								<select name='master-select' id='master_select' class='select-style'>";
									
									$query = "SELECT Master.ID, User.name, User.email FROM Master JOIN User ON Master.ID_user=User.ID";
									$result = mysqli_query($link, $query) or die("Ошибка".mysqli_error($link));

									if($result)
									{
										$rows = mysqli_num_rows($result);
										for($i = 0; $i < $rows; ++$i)
										{
											$row = mysqli_fetch_assoc($result); 
											echo "<option value='".$row['ID']."'>".$row['name']." (".$row['email'].")</option>";
										}
									}
									
									echo "
								</select>
							</div>	

							<div>
								<p>Выберите уроки</p>";

								$lessonsQuery = "SELECT * FROM Lesson";
								$lessonsResult = mysqli_query($link, $lessonsQuery) or die("Ошибка".mysqli_error($link));

								if($lessonsResult)
								{
									$rows = mysqli_num_rows($lessonsResult);
									for($i = 0; $i < $rows; ++$i)
									{
										$row = mysqli_fetch_assoc($lessonsResult); 
										echo "<p class='lesson-item'>
												<input type='checkbox' class='lessons-checkboxes lessons-ckbx' name='lessons-ckbx' value='".$row['ID']."'>
												<label for='lesson'>".$row['title']."</label>
											</p>";
									}
								}

								echo "

								</div>

							<div>
								<p>Ваши пожелания к курсу</p>
								<textarea type='text' class='course-wishes-textarea border-style' name='course-wishes-description' ></textarea>
							</div>
							
						</div>
						
						<div class='title user-course-price'>
							<div data-tooltip='Чем больше уроков, тем больше скидка!'>Стоимость: 0 BYN*</div>
						</div>


						<button class='btn' id='user_add_new_course_btn'>
							<p>Отправить завку</p>
							<img src='images/arrow.png' class='arrow'>
						</button>

					</div>
					<div class='two-lines'></div>
				</div>
			</div>";
			} else {
				echo "<div class='log-in'><a href='../modules/authorization/authorization.php'>Войдите</a> или <a href='../modules/registration/registration.php'>зарегистрируйтесь</a>, чтобы создать курс</div>"; 
			}


			?>

	</div>
</div>
<?php require 'modules/page_elements/footer.php';?>

	<script src="../../../js/userAddNewCourse.js"></script>
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>