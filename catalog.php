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
	<link rel="stylesheet" href="css/course_item_style.css" type="text/css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/main.js"></script>
</head>

<body>
	<?php require 'modules/page_elements/header.php';?>

	<!-- COURSES CATALOG BLOCK -->
	<div class="block block-9">
		<div class="container">

			<p class="title">Наши курсы</p>

			<div class="courses-catalog-content">

				<?php

				$courseQuery = "SELECT * FROM Course";
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
								<img src='images/arrow.png' class='arrow'>
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

	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>