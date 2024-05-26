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
	<title>Master panel</title>
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
				<a href="master_panel.php" >
					<img src='images/arrow.png' class='arrow'>
					<div>ВЕРНУТЬСЯ НАЗАД</div>
				</a>
			</div>
			<!-- /GO-BACK BUTTON -->

			<div class="admin-form-wrapper">
				<div class="white-form">
					<div class="form-content">

						<div class="title">Добавление курса в расписание</div>
						<div class="form-inputs margin-top">

							<div class="form-input-block">
								<p>Выберите курс</p>
								<select name="course-select" id="course_select" class="select-style">
									<?php
									$query = "SELECT * FROM Course";
									$result = mysqli_query($link, $query) or die("Ошибка".mysqli_error($link));

									if($result)
									{
										$rows = mysqli_num_rows($result);
										for($i = 0; $i < $rows; ++$i)
										{
											$row = mysqli_fetch_assoc($result); 
											echo "<option value='".$row['ID']."'>".$row['title']." (ID курса = ".$row['ID'].")</option>";
										}
									}
									?>
								</select>
							</div>					
							<div class="form-input-block"> 
								<p>Выберите дату начала курса</p>
								<input name="course-startDate-select" id="course_startDate_select" type="date" min="<?php echo date('Y-m-d'); ?>" class="select-style" required>
								<span class='error-span none' id='course-start-date-error-span'>Добавьте дату начала курса</span>
							</div>
							
							<div class="form-input-block">
								<p>Введите тип группы</p>
								<select name="course-groupType-select" id="course_groupType_select" class="select-style">
									<?php
									$query = "SELECT * FROM Group_type";
									$result = mysqli_query($link, $query) or die("Ошибка".mysqli_error($link));

									if($result)
									{
										$rows = mysqli_num_rows($result);
										for($i = 0; $i < $rows; ++$i)
										{
											$row = mysqli_fetch_assoc($result); 
											echo "<option value='".$row['ID']."'>".$row['groupType']."</option>";
										}
									}
									?>
								</select>
							</div>
							<!-- <div class="box-input-2">
								<p>Введите график</p>
								
							</div> -->

						</div>
						<button class="form-btn" id="add_org_course_btn">
							<p>Добавить</p>
						</button>

					</div>
					<div class="two-lines"></div>
				</div>
			</div>



		</div>
	</div>

	<?php require 'modules/page_elements/footer.php';?>
</body>


<script src="../../../js/masterProfilePage.js"></script>
</html>