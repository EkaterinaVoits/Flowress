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
		$id_org_course=$_GET['id'];
	?>


	<?php require 'modules/page_elements/header.php';?>

	<div class="page-content margin-top">

		<!-------- BODY -------->
		<div class="container">

			<!-- GO-BACK BUTTON -->
			<div class="go-back">
				<?php
					if($_SESSION['userType']=="master") {
						echo "<a href='master_panel.php' >
							<img src='images/arrow.png' class='arrow'>
							<div>ВЕРНУТЬСЯ НАЗАД</div>
						</a>";
					} /*else {
						echo "<a href='admin_panel.php' >
							<img src='images/arrow.png' class='arrow'>
							<div>ВЕРНУТЬСЯ НАЗАД</div>
						</a>";
					}*/
				?>

				
			</div>
			<!-- /GO-BACK BUTTON -->
			
			<!-- ERROR MESSAGE -->
			<div class="error_master"></div>
			<!-- /ERROR MESSAGE -->
				
			</div>
			<div class="admin-form-wrapper">
				<div class="white-form">
					<div class="form-content">

						<div class="title">Редактировать курс <?php echo "$id_org_course"; ?></div>
						<div class="form-inputs">

							<?php
								$query = "SELECT * FROM Organized_course JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Organized_course.ID='$id_org_course'";
								$result = mysqli_query($link, $query) or die("Ошибка".mysqli_error($link));

								if($result) {
									$org_course = mysqli_fetch_assoc($result);
									} 
								?>

							<div> 
								<p>Дата начала курса</p>
								<input name="course-startDate-select" id="course_startDate_select" value="<?= $org_course['startDate'] ?>" type="date" class="select-style" required>
							</div>

							<div> 
								<p>Тип группы</p>
								<select name="course-groupType-select" id="course_groupType_select" class="select-style">
									<?php
									$query2 = "SELECT * FROM Group_type";
									$result2 = mysqli_query($link, $query2) or die("Ошибка".mysqli_error($link));

									if($result2)
									{
										$rows = mysqli_num_rows($result2);
										for($i = 0; $i < $rows; ++$i)
										{
											$row2 = mysqli_fetch_assoc($result2); 
											$selected = ($row2['ID'] == $org_course['ID_groupType']) ? 'selected' : '';
											echo "<option value='".$row2['ID']."'$selected>".$row2['groupType']."</option>";
										}
									}

									?>
								</select>
							</div>

							<div> 
								<p>График</p>
								<input name="course-startDate-select" id="course_startDate_select" value="<?= $org_course['startDate'] ?>" type="date" class="select-style" required>
							</div>

							
						</div>
						<button class="form-btn save_edit_org_course_btn" id="<?= $org_course['ID'] ?>">
							<p>Сохранить</p>
						</button>

					</div>
					<div class="two-lines"></div>
				</div>
			</div>
	


		</div>
	</div>
</body>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="../../../js/masterProfilePage.js"></script>
</html>