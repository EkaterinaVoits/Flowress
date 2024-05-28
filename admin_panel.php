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
					<li class="tab" id='org-courses-tab'>Текущие курсы</li>
					<li class="tab" id='ended-org-courses-tab'>Завершённые курсы</li>
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
					<!-- <a class="add-entry-button" href="admin_add_registration.php">
						Добавить заявку
					</a> -->
				</div>

				<div class="result_class"></div>

				<div class="admin-panel-table reg-table col-12">
					<div class="table-border">

						<div class="title-table row"> 
							<div class="col-1">ID</div>
							<div class="col-2">email клиента</div>
							<div class="col-3">Название курса</div>
							<div class="col-2">Статус</div>
							<div class="col-4">Управление</div>
						</div>
						<div class='reg-body-table'>

							<?php 
							$regQuery = "SELECT Course_registration.ID, User.email, Organized_course.ID, Course.title, Status.ID, Status.status FROM Course_registration JOIN User ON Course_registration.ID_user=User.ID JOIN Organized_course ON Course_registration.ID_organizedCourse=Organized_course.ID JOIN Course ON Organized_course.ID_course=Course.ID JOIN Status ON Course_registration.ID_status=Status.ID WHERE Status.ID IN (1,2,3) ORDER BY Course_registration.ID DESC";								

							$regResult = mysqli_query($link, $regQuery) or die("Ошибка " . mysqli_error($link));

							if($result) {
								$regRows = mysqli_num_rows($regResult);
								if($regRows>0) {
									for($i = 0; $i < $regRows; ++$i)
									{
										$registration = mysqli_fetch_row($regResult); 
										echo "<div class='row row-margin'>
										<div class='reg_id col-1'>".$registration[0]."</div>
										<div class='client_email col-2'>".$registration[1]."</div>
										<div class='course_name col-3'>Группа ".$registration[2].". ".$registration[3]."</div>
										<div class='course_status col-2' id='course_status".$registration[0]."'>".$registration[5]."</div>";

										$statusQuery = "SELECT * FROM Status";
										$statusResult = mysqli_query($link, $statusQuery) or die("Ошибка".mysqli_error($link));
										echo "<select name='status-select' id='".$registration[0]."' class='status_select select-style col-2'>";

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
										<div class='col-2'><button class='del-reg-btn admin-btn' id='".$registration[0]."'>Удалить</button>
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

			<div class="all-org-courses">

				<!--------- ORGANIZED COURSES BLOCK --------->
				<div class="block" id="admin-organized-courses-block">
					
					<div class="admin-title-group">
						<div class="admin-panel-title">Текущие курсы</div>
						<a class="add-entry-button" href="admin_add_organized_course.php">
							Добавить курс в расписание
						</a>
					</div>

					<?php 

					$query2 = "SELECT Course.ID, Organized_course.startDate,Organized_course.isEnded, Organized_course.ID as id_org_course, User.name, Course.title, Course.price, Course.photo, Group_type.groupType, Group_type.priceCoefficient FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Organized_course.isEnded='0' ORDER BY Organized_course.startDate DESC ";

					require 'modules/page_elements/admin_tables/admin_org_courses_cards.php'; ?>

				</div>
				<!--------- /ORGANIZED COURSES BLOCK --------->

				<!--------- ENDED COURSES BLOCK --------->
				<div class="block" id="admin-ended-organized-courses-block">
					
					<div class="admin-title-group">
						<div class="admin-panel-title">Завершённые курсы</div>
						
					</div>

					<?php 

					$query2 = "SELECT Course.ID, Organized_course.startDate, Organized_course.isEnded, Organized_course.ID as id_org_course, User.name, Course.title, Course.price, Course.photo, Group_type.groupType, Group_type.priceCoefficient FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Organized_course.isEnded='1' ORDER BY Organized_course.startDate DESC ";

					require 'modules/page_elements/admin_tables/admin_org_courses_cards.php'; ?>

				</div>
				<!--------- /ENDED COURSES BLOCK --------->
			</div>


			<!--------- MASTERS BLOCK --------->
			<div class="block" id="admin-masters-block">	
				<?php require 'modules/page_elements/admin_tables/masters_body_table.php'; ?>
			</div>
			<!--------- /MASTERS BLOCK --------->


			


			<!--------- COURSES BLOCK --------->
			<div class="block" id="admin-courses-block">
				<?php require 'modules/page_elements/admin_tables/courses_body_table.php'; ?>
			</div>
			<!--------- /COURSES BLOCK --------->


			<!--------- LESSONS BLOCK --------->
			<div class="block" id="admin-lessons-block">
				<?php require 'modules/page_elements/admin_tables/lessons_body_table.php'; ?>
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
							<div class="col-1">Имя клиента</div>
							<div class="col-2">Номер телефона</div>
							<div class="col-3">Статус</div>
							<div class="col-5">Управление</div>
						</div>

						<div class='consult-body-table'>

							<?php require 'modules/page_elements/admin_tables/consult_body_table.php'; ?>

							
						</div>
					</div>
				</div>
			</div>
			<!--------- /CONSULTATION BLOCK --------->

	</div>
</div>

<?php require 'modules/page_elements/footer.php';?>

</body>

<script src="../../js/jquery-3.4.1.min.js"></script>
<script src="../../js/adminPanel.js"></script>
<script src="../../js/main.js"></script>

</html>