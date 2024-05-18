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
	<link rel="stylesheet" href="css/course_schedule_style.css" type="text/css">
	<link rel="stylesheet" href="css/course_item_style.css" type="text/css">
	<link rel="stylesheet" href="css/course_style.css" type="text/css">	

</head>

<body>
	<?php 
	require 'modules/page_elements/header.php';
	$today = date('Y-m-d');
	?>

	<div class="page-content">

	<div class="container">
		<div class="align-content-two-columns"> 

			<!--------- ALL FILTERS --------->
			<div class="filters-column"> 
				<div class="filters">

					<!-- SORT BY COURSE -->
					<div id="course_filter" class="filter">
						<div class="filter-title">Выберите курс:</div>
						<div>
							<?php

							$courseQuery = "SELECT * FROM Course";
							$courseResult = mysqli_query($link, $courseQuery) or die("Ошибка".mysqli_error($link));

							if($courseResult)
							{
								$rows = mysqli_num_rows($courseResult);
								for($i = 0; $i < $rows; ++$i)
								{
									$row = mysqli_fetch_assoc($courseResult); 
									echo "<div class='filter-item'>";
									echo "<input type='checkbox' class='all-checkboxes courses-ckbx' name='courses' value='".$row['ID']."'>";
									echo "<label for='courses'>".$row['title']."</label>";
									echo "</div>";
								}
							}
							?>
						</div> 
					</div>
					<!-- /SORT BY MASTER -->
					
					<!-- SORT BY MASTER -->
					<div id="master_filter" class="filter">
						<div class="filter-title">Выберите мастера:</div>
						<div>
							<?php

							$masterQuery = "SELECT Master.ID, User.name FROM Master JOIN User ON Master.ID_user=User.ID";
							$masterResult = mysqli_query($link, $masterQuery) or die("Ошибка".mysqli_error($link));

							if($masterResult)
							{
								$rows = mysqli_num_rows($masterResult);
								for($i = 0; $i < $rows; ++$i)
								{
									$row = mysqli_fetch_assoc($masterResult); 
									echo "<div class='filter-item'>";
									echo "<input type='checkbox' class='all-checkboxes masters-ckbx' name='masters' value='".$row['ID']."'>";
									echo "<label for='masters'>".$row['name']."</label>";
									echo "</div>";
								}
							}
							?>
						</div> 
					</div>
					<!-- /SORT BY MASTER -->

					<!-- SORT BY GROUP TYPE -->
					<div id="group_filter" class="filter">
						<div class="filter-title">Выберите группу:</div>
						<div>
							<?php

							$groupQuery = "SELECT * FROM Group_type";
							$groupResult = mysqli_query($link, $groupQuery) or die("Ошибка".mysqli_error($link));

							if($groupResult)
							{
								$rows2 = mysqli_num_rows($groupResult);
								for($j = 0; $j < $rows2; ++$j)
								{
									$row2 = mysqli_fetch_assoc($groupResult); 
									echo "<div class='filter-item'>";
									echo "<input type='checkbox' class='all-checkboxes groups-ckbx' name='group' value='".$row2['ID']."'>";
									echo "<label for='masters'>".$row2['groupType']."</label>";
									echo "</div>";
								}
							}
							?>
						</div> 
					</div>

				<!-- SORT BY GROUP TYPE -->
				</div>
			</div>
			<!--------- /ALL FILTERS --------->

			<!--------- CATALOG COURSES --------->
			<div class="courses-column">
 
				<?php
				//$query = "SELECT * FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID WHERE Organized_course.startDate>'$today'";
				//include 'modules/page_elements/courses_cards.php';
				?>
 
				
			<?php
				//при открытии страницы
				$organizedCourseQuery = "SELECT Organized_course.ID, Organized_course.startDate, User.name, Course.title, Course.price, Group_type.groupType, Group_type.priceCoefficient, Group_type.groupSize FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Courses_schedule ON Courses_schedule.ID_organizedCourse=Organized_course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID  WHERE Organized_course.startDate>'$today' GROUP BY Organized_course.ID";
				include 'modules/page_elements/courses_cards.php';
			?>
			</div>

			
			
			<!--------- /CATALOG COURSES --------->
		</div>
	</div>
</div>

<?php require 'modules/page_elements/footer.php';?>

</body>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/main.js"></script>
</html>

