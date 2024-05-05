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
	<!-- Bootstrap CSS (jsDelivr CDN) -->	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>

	<?php require 'modules/page_elements/header.php';?>

	<div class="page-content">

		<!-------- BODY -------->
		<div class="container">

			<!--------- PANEL --------->
			<div class="panel adm-panel">
				<ul class="tabs">
					<li class="tab" id='registration-admin-tab'>Заявки</li>
					<li class="tab" id='org-courses-tab'>Группы</li>
					<li class="tab" id='masters-admin-tab'>Преподаватели</li>
					<li class="tab" id='courses-admin-tab'>Каталог курсов</li>
					<li class="tab" id='lessons-admin-tab'>Каталог уроков</li>
					<li class="tab" id='consult-admin-tab'>Консультация</li>

				</ul>
			</div>
			<!--------- /PANEL --------->

			<!--------- REGISTRATION BLOCK --------->
			<div class="block" style="display: block;" id="admin-registration-block">
				
				<div class="admin-title-group">
					<div class="admin-panel-title">Заявки на курсы</div>
					<a class="add-entry-button" href="admin_add_registration.php">
						Добавить заявку
					</a>
				</div>

				<div class="result_class"></div>

				<div class="admin-panel-table reg-table col-12">
					<div class="table-border">

						<div class="title-table row"> 
							<div class="col-1">ID</div>
							<div class="col-2">email клиента</div>
							<div class="col-1">ID орг. курса</div>
							<div class="col-2">Название курса</div>
							<!-- <div class="col-3">Статус</div> -->
							<div class="col-2">Статус</div>
							<div class="col-4">Управление</div>
						</div>
						<div class='reg-body-table'>

							<?php 
							$query = "SELECT Course_registration.ID, User.email, Organized_course.ID, Course.title, Status.ID, Status.status FROM Course_registration JOIN User ON Course_registration.ID_user=User.ID JOIN Organized_course ON Course_registration.ID_organizedCourse=Organized_course.ID JOIN Course ON Organized_course.ID_course=Course.ID JOIN Status ON Course_registration.ID_status=Status.ID WHERE Status.ID IN (1,2,3) ORDER BY Course_registration.ID DESC";								

							$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

							if($result) {
								$rows = mysqli_num_rows($result);
								if($rows>0) {
									for($i = 0; $i < $rows; ++$i)
									{
										$row = mysqli_fetch_row($result); 
										echo "<div class='row row-margin'>
										<div class='reg_id col-1'>".$row[0]."</div>
										<div class='client_email col-2'>".$row[1]."</div>
										<div class='course_id col-1'>".$row[2]."</div>
										<div class='course_name col-2'>".$row[3]."</div>
										<div class='course_status col-2' id='course_status".$row[4]."'>".$row[5]."</div>";

										$statusQuery = "SELECT * FROM Status";
										$statusResult = mysqli_query($link, $statusQuery) or die("Ошибка".mysqli_error($link));
										echo "<select name='status-select' id='".$row[0]."' class='status_select select-style col-2'>";

										if($statusResult)
										{
											$rows2 = mysqli_num_rows($statusResult);
											echo "<option value='no_status'></option>";
											for($j = 0; $j < $rows2; ++$j)
											{
												$row2 = mysqli_fetch_row($statusResult); 
												echo "<option value='".$row2[0]."'>".$row2[1]."</option>";
											}
										}

										echo "</select>
										<div class='col-2'><button class='del-reg-btn admin-btn' id='".$row[0]."'>Удалить</button>
										</div></div>";
									}
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<!--------- /REGISTRATION BLOCK --------->


			<!--------- MASTERS BLOCK --------->
			<div class="block" id="admin-masters-block">
				
				<div class="admin-title-group">
					<div class="admin-panel-title">Преподаватели</div>
					<a class="add-entry-button" href="admin_add_master.php">
						Назначить преподавателя
					</a>
				</div>

				<div class="admin-panel-table col-12">
					<div class="table-border">

						<div class="title-table row"> 
							<div class="col-1">ID</div>
							<div class="col-1">Имя</div>
							<div class="col-2">email</div>
							<div class="col-2">Телефон</div>
							<div class="col-4">Доп.инфо</div>
							<div class="col-2">Управление</div>
						</div>
						<div class='masters-body-table'>

							<?php 
							$masterQuery = "SELECT Master.ID, Master.telephone, Master.info, User.name, User.email FROM Master JOIN User ON Master.ID_user=User.ID";								
							$masterResult = mysqli_query($link, $masterQuery) or die("Ошибка " . mysqli_error($link));

							if($masterResult) {
								$rows = mysqli_num_rows($masterResult);
								if($rows>0) {
									for($i = 0; $i < $rows; ++$i)
									{
										$master = mysqli_fetch_assoc($masterResult); 
										echo "<div class='row row-margin'>
										<div class='col-1'>".$master['ID']."</div>
										<div class='col-1'>".$master['name']."</div>
										<div class='col-2'>".$master['email']."</div>
										<div class='col-2'>".$master['telephone']."</div>
										<div class='col-4'>".$master['info']."</div>
										<div class='col-2'><button class='del-master-btn admin-btn' id='".$master['ID']."'>Удалить</button>
										</div></div>";
									}
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<!--------- /MASTERS BLOCK --------->


			<!--------- ORGANIZED COURSES BLOCK --------->
			<div class="block" id="admin-organized-courses-block">
				
				<div class="admin-title-group">
					<div class="admin-panel-title">Расписание курсов</div>
					<a class="add-entry-button" href="admin_add_organized_course.php">
						Добавить курс в расписание
					</a>
				</div>

				<div class="admin-panel-table col-12">
					<div class="table-border">

						<div class="title-table row"> 
							<div class="col-1">ID</div>
							<div class="col-3">Курс</div>
							<div class="col-2">Преподаватель</div>
							<div class="col-2">Начало</div>
							<div class="col-1">Группа</div>
							<!-- <div class="col-2">График</div> -->
							<div class="col-3">Управление</div>
						</div>
						<div class='org-course-body-table'>

							<?php 
							$courseScheduleQuery = "SELECT Organized_course.ID, Course.title, User.name, Organized_course.startDate, Group_type.groupType FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON Master.ID_user=User.ID JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID";								
							$courseScheduleResult = mysqli_query($link, $courseScheduleQuery) or die("Ошибка " . mysqli_error($link));

							if($courseScheduleResult) {
								$rows = mysqli_num_rows($courseScheduleResult);
								if($rows>0) {
									for($i = 0; $i < $rows; ++$i)
									{
										$courseSchedule = mysqli_fetch_assoc($courseScheduleResult); 
										echo "<div class='row row-margin'>
										<div class='col-1'>".$courseSchedule['ID']."</div>
										<div class='col-3'>".$courseSchedule['title']."</div>
										<div class='col-2'>".$courseSchedule['name']."</div>
										<div class='col-2'>".$courseSchedule['startDate']."</div>
										<div class='col-1'>".$courseSchedule['groupType']."</div>";
										

										/*
										echo "<div class='col-2'>";
										$id_organizedCourse=$courseSchedule['ID'];

										$scheduleQuery = "SELECT * FROM Courses_schedule JOIN DateTime_class ON Courses_schedule.ID_dateTimeClass=DateTime_class.ID  WHERE Courses_schedule.ID_organizedCourse=$id_organizedCourse";
										$scheduleResult = mysqli_query($link, $scheduleQuery) or die("Ошибка".mysqli_error($link));

										if($scheduleResult) 
										{	
											$rows3 = mysqli_num_rows($scheduleResult);
											for($s = 0; $s < $rows3; ++$s) 
											{
												$schedule = mysqli_fetch_assoc($scheduleResult); 
												echo "<div>".$schedule['day']."-".$schedule['time']." </div>
												";
											}
											mysqli_free_result($scheduleResult);
										}
										echo "</div>";
										*/

										echo "
										<div class='col-3'>
											<button class='del-course-shedule-btn admin-btn' id='".$courseSchedule['ID']."'>Удалить</button>
											<button class='edit-course-shedule-btn admin-btn' id='".$courseSchedule['ID']."'>Изменить</button>
										</div>
										</div>";
									}
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<!--------- /ORGANIZED COURSES BLOCK --------->


			<!--------- COURSES BLOCK --------->
			<div class="block" id="admin-courses-block">
				
				<div class="admin-title-group">
					<div class="admin-panel-title">Курсы</div>
					<a class="add-entry-button" href="admin_add_course.php">
						Добавить новый курс
					</a>

				</div>

				<div class="admin-panel-table col-12">
					<div class="table-border">

						<div class="title-table row"> 
							<div class="col-1">ID</div>
							<div class="col-1">Название</div>
							<div class="col-2">Описание</div>
							<div class="col-4">Полное описание</div>
							<div class="col-1">Стоимость</div>
							<div class="col-3">Управление</div>
						</div>
						<div class='masters-body-table'>

							<?php 
							$courseQuery = "SELECT * FROM Course";								
							$courseResult = mysqli_query($link, $courseQuery) or die("Ошибка " . mysqli_error($link));

							if($courseResult) {
								$rows = mysqli_num_rows($courseResult);
								if($rows>0) {
									for($i = 0; $i < $rows; ++$i)
									{
										$course = mysqli_fetch_assoc($courseResult); 
										echo "<div class='row row-margin'>
										<div class='col-1'>".$course['ID']."</div>
										<div class='col-1'>".$course['title']."</div>
										<div class='col-2'>".$course['description']."</div>
										<div class='col-4'>".$course['fullDescription']."</div>
										<div class='col-1'>".$course['price']."</div>
										<div class='col-3'><button class='del-course-btn admin-btn' id='".$course['ID']."'>Удалить</button>
										</div></div>";
									}
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<!--------- /COURSES BLOCK --------->


			<!--------- LESSONS BLOCK --------->
			<div class="block" id="admin-lessons-block">
				
				<div class="admin-title-group">
					<div class="admin-panel-title">Уроки</div>
					<a class="add-entry-button" href="admin_add_lesson.php">
						Добавить новый урок
					</a>

				</div>

				<div class="admin-panel-table col-12">
					<div class="table-border">

						<div class="title-table row"> 
							<div class="col-1">ID</div>
							<div class="col-1">Название</div>
							<div class="col-2">Описание</div>
							
							<div class="col-3">Управление</div>
						</div>
						<div class='masters-body-table'>

							<?php 
							$lessonQuery = "SELECT * FROM Lesson";								
							$lessonResult = mysqli_query($link, $lessonQuery) or die("Ошибка " . mysqli_error($link));

							if($lessonResult) {
								$rows = mysqli_num_rows($lessonResult);
								if($rows>0) {
									for($i = 0; $i < $rows; ++$i)
									{
										$lesson = mysqli_fetch_assoc($lessonResult); 
										echo "<div class='row row-margin'>
										<div class='col-1'>".$lesson['ID']."</div>
										<div class='col-1'>".$lesson['title']."</div>
										<div class='col-2'>".$lesson['description']."</div>
										
										<div class='col-3'><button class='del-lesson-btn admin-btn' id='".$lesson['ID']."'>Удалить</button>
										</div></div>";
									}
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<!--------- /LESSONS BLOCK --------->

			<!--------- CONSULTATION BLOCK --------->
			<div class="block" id="admin-consult-block">
				
				<div class="admin-title-group">
					<div class="admin-panel-title">Консультация</div>
				</div>

				<div class="admin-panel-table col-12">
					<div class="table-border">

						<div class="title-table row"> 
							<div class="col-1">ID</div>
							<div class="col-2">Имя клиента</div>
							<div class="col-3">Номер телефона</div>
							<div class="col-3">Статус</div>
							<div class="col-3">Управление</div>
						</div>

						<div class='consult-body-table'>

							<?php 
							$consultQuery = "SELECT Consultation.ID, Consultation.user_name, Consultation.user_telephone,Status_consultation.status  FROM Consultation JOIN Status_consultation ON Consultation.ID_status=Status_consultation.ID";
							$consultResult = mysqli_query($link, $consultQuery) or die("Ошибка " . mysqli_error($link));			

							if($consultResult) {
								$rows = mysqli_num_rows($consultResult);
								if($rows>0) {
									for($i = 0; $i < $rows; ++$i)
									{
										$consult = mysqli_fetch_assoc($consultResult); 
										echo "<div class='row row-margin'>
										<div class='col-1'>".$consult['ID']."</div>
										<div class='col-2'>".$consult['user_name']."</div>
										<div class='col-3'>".$consult['user_telephone']."</div>
										<div class='col-3' id='consult_status".$consult['ID']."'>".$consult['status']."</div>";


										$query2 = "SELECT * FROM Status_consultation";
										$result2 = mysqli_query($link, $query2) or die("Ошибка".mysqli_error($link));
										echo "<select name='status-select' id='".$consult['ID']."' class='consult_status_select select-style col-3'>";

										if($result2)
										{
											$rows2 = mysqli_num_rows($result2);
											echo "<option value='no_status'></option>";
											for($j = 0; $j < $rows2; ++$j)
											{
												$row2 = mysqli_fetch_row($result2); 
												echo "<option value='".$row2[0]."'>".$row2[1]."</option>";
											}
										}

										echo "</select></div>";
									}
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<!--------- /CONSULTATION BLOCK --------->

	</div>
</div>

</body>

<link rel="stylesheet" href="../../css/style.css" type="text/css">
<script src="../../js/jquery-3.4.1.min.js"></script>
<script src="../../js/main.js"></script>
<script src="../../js/adminPanel.js"></script>
</html>