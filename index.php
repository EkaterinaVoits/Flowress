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
	<title>Flowress</title>
	<link rel="shortcut icon" href="images/icons/F.svg" />
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<body>
	<?php require 'modules/page_elements/header.php';?>
	
	<div class="page-content">

	<!-- HOME SCREEN -->
	<div class="home-screen">

		<div class="bgr-image bgr-paralax home-img" >
		</div>

		<div class="home-block-wrapper">
			<div class="container">
				<div class="about-description">
					<p class="about-description-1 ">
						Курсы визажа для новичков и продвинутых
					</p>

					<hr class="dividing-line">

					<p class="about-description-2">
						школа визажа
					</p>	
				</div>
				
				<div class="home-btn-wrapper">
					<a class="btn" href="courses.html">
						<p>Записаться на курс</p>
						<img src="images/arrow.png" class="arrow">
					</a>	
				</div>	
			</div>

		</div>

	</div>
	<!-- /HOME SCREEN -->

	<!-- WHITE BLOCK -->
	<div class="white-block">
		<div class="container">
			<div class="white-block-wrapper">
				<div class="white-rectangle">
					<div class="white-block-content">
						<div>уже более 10 лет создаём</div>
						<p class="title">ПРОФЕССИОНАЛЬНЫЕ КУРСЫ</p>
						<div>ПО ОБУЧЕНИЮ МАСТЕРОВ ИНДУСТРИИ КРАСОТЫ</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /WHITE BLOCK -->
	

	<!-- LEFT PLANT -->
	<img src="images/plant_1.png" class="plant plant_1">

	<!-- ABOUT BLOCK -->
	<div class="block block-1">
		<div class="container">
			<div class="about-block">

				<div class="image-rect about-block-img">
					<img src="images/about_block_img.png">
				</div>

				<div class="about-block-content">

					<div class="title-group">
						<p class="title first-title">НЕМНОГО</p>
						<p class="title second-title">о школе</p>
					</div>

					<div class="about-content-text">
						Наша авторская система модульного обучения сочетает в себе фундаментальные знания и современные техники макияжа.
						<br><br>
						Благодаря системному подходу и всегда актуальной информации, ученики добиваются высоких результатов, следуя всем рекомендациям преподавателей начинают успешную карьеру в beauty-индустрии!
					</div>

				</div>

			</div>
		</div>
	</div>
	<!-- /ABOUT BLOCK -->

	<!-- RIGHT PLANT -->
	<img src="images/plant_2.png" class="plant plant_2">

	<!-- ADVANTAGE BLOCK -->
	<div class="block block-2">
		<div class="brown-rect">
			<div class="white-line">
				<div class="container">

					<div class="advantages-block-content">
						<div class="advantage">
							<img src="images/advantage_1.png">
							<div>
								Мы предоставляем  качественную  косметику для учеников нашей школы
							</div>
						</div>

						<div class="advantage">
							<img src="images/advantage_2.png">
							<div>
								Удобная локация в центре города, можно добраться на транспорте из любой точки
							</div>
						</div>

						<div class="advantage">
							<img src="images/advantage_3.png">
							<div>
								Мы создали лучшую программу: минимум времени и максимум знаний
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

	</div>
	<!-- /ADVANTAGE BLOCK -->

	<!-- LEFT PLANT -->
	<img src="images/plant_3.png" class="plant plant_3">

	<!-- SPLATTERS -->
	<img src="images/splatters_1.png" class="splatters splatters_1">

	<!-- RIGHT PLANT -->
	<img src="images/plant_4.png" class="plant plant_4">

	<!-- ABOUT FOUNDER BLOCK -->
	<div class="block block-3">
		<div class="container">
			<div class="about-block">

				<div class="about-founder-block">
					<!-- title -->
					<div class="title-group">
						<p class="title first-title">основатель курсов</p>
						<p class="title second-title">АННА НЕКРАСОВА</p>
					</div>

					<div class="about-founder-text">
						Анна является основателем студии красоты и ведущим визажистом международного уровня с опытом работы более 12 лет
						<br><br>
						Действующим преподавателем в собственной школе макияжа непрерывно повышает свою квалификацию, проходит различные стажировки, мастер-классы и семинары, что позволяет всегда оставаться в курсе современных техник и инноваций.
					</div>
				</div>

				<div class="image-rect founder-img">
					<img src="images/founder_img.png">
				</div>

			</div>
		</div>
	</div>
	<!-- /ABOUT FOUNDER BLOCK -->

	<!-- SPLATTERS -->
	<img src="images/splatters_2.png" class="splatters splatters_2">


	<!-- PARRALAX BLOCK -->
	<div class="block block-4">

		<div class="bgr-image bgr-paralax center-paralax">

		</div>

		<div class="text-block-wrapper">
			<div class="container">
				<div class="text-block">
					<p class="text-block-1 ">
						Мы докажем, что красота- 
					</p>
					<p class="text-block-2">
						ваш лучший выбор
					</p>	
				</div>		
			</div>
		</div>
	</div>
	<!-- /PARRALAX BLOCK -->


	<!-- POPULAR COURSES BLOCK -->
	<div class="block block-5">
		<div class="container">

			<div class="title-group">
				<p class="title first-title">ПОПУЛЯРНЫЕ КУРСЫ </p>
				<p class="title second-title">НАШЕЙ ШКОЛЫ</p>
			</div>

			<div class="cards-block">

				<?php
					$courseQuery = "SELECT Course.ID, Course.title, Course.photo,  Course.description, ROUND(AVG(COALESCE(Course_rating.rating, 0)),1) AS average_rating FROM Course LEFT JOIN Course_rating ON Course.ID = Course_rating.ID_course GROUP BY Course.ID, Course.title, Course.description HAVING COUNT(Course_rating.rating) > 0 ORDER BY average_rating DESC LIMIT 3";
					$courseResult = mysqli_query($link, $courseQuery) or die("Ошибка".mysqli_error($link));

					if($courseResult)
					{
						$rows = mysqli_num_rows($courseResult);
						for($i = 0; $i < $rows; ++$i)
						{
							$row = mysqli_fetch_assoc($courseResult); 
							echo "<div class='card'>
									<div class='card-content'>
										<div class='rating-block'>
										Рейтинг: 
											<img src='images/rating/rating.png' class='rating-img'>
											<p class='rating-text' style='margin-top:0px;'>".$row['average_rating']."/5</p>
										</div>
										<img src='images/courses_images/".$row['photo']."' class='card-img'>
										<div class='card-content-wrapper'>
											<p class='title popular-course-title'>".$row['title']."</p>
											<div>".$row['description']."</div>
										</div>
									</div>
									<div class='two-lines'></div>
								</div>";
						}
					}

				?>

				</div>


			<div class="btn-wrapper">
				<a class="btn" href="catalog.php">
					<p>Узнать больше</p>
					<img src="images/arrow.png" class="arrow">
				</a>	
			</div>

		</div>
	</div>
	<!-- /POPULAR COURSES -->

	<!-- RIGHT PLANT -->
	<img src="images/plant_5.png" class="plant plant_5">

	<!-- LEFT PLANT -->
	<img src="images/plant_3.png" class="plant plant_6">

	<!-- STUDENTS WORKS BLOCK -->
	<div class="block block-7">
		<div class="container">

			<div class="title-group">
				<p class="title first-title">РАБОТЫ</p>
				<p class="title second-title">НАШИХ УЧЕНИКОВ</p>
			</div>

			<div class="students_works">
				<img src="images/students_works_img.png">
			</div>
		</div>
	</div>
	<!-- /STUDENTS WORKS BLOCK -->

	<!-- SPLATTERS -->
	<img src="images/splatters_3.png" class="splatters splatters_3">

	<!-- LEFT PLANT -->
	<img src="images/plant_7.png" class="plant plant_8">

	<!-- SPLATTERS -->
	<img src="images/splatters_4.png" class="splatters splatters_4">

	<!-- RIGHT PLANT -->
	<img src="images/plant_2.png" class="plant plant_9">

	<div class="block block-7">
		<div class="container">

		<video width="100%" poster="video/video_preview1.jpg" controls>
			  <source src="video/video.mp4" type="video/mp4" >
			  Ваш браузер не поддерживает данное видео
			</video>
		</div>
	</div>

	<!-- SPLATTERS -->
<!-- 	<img src="images/splatters_4.png" class="splatters splatters_1">
 -->
 <img src="images/splatters_3.png" class="splatters splatters_3">
 <img src="images/splatters_4.png" class="splatters splatters_4">

<!--  <img src="images/plant_2.png" class="plant plant_9"> -->
	<?php require 'modules/page_elements/consult_form.php';?>

	<!-- /CONSULTATION BLOCK -->
	<?php require 'modules/page_elements/footer.php';?>

	</div>
</body>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/main.js"></script>

</html>




