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
	<title>Profile page</title>
	<link rel="stylesheet" href="../../css/style.css" type="text/css">
	<link rel="stylesheet" href="../../css/profile_page_style.css" type="text/css">
	<link rel="stylesheet" href="../../css/master_profile_style.css" type="text/css">
	<link rel="stylesheet" href="../../css/course_item_style.css" type="text/css">
	<link rel="stylesheet" href="../../css/course_style.css" type="text/css">
	<!-- Bootstrap CSS (jsDelivr CDN) -->	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/main.js"></script>
</head>

<body>

	<?php require 'modules/page_elements/header.php';?>

	<!-------- BODY -------->
	<div class="page-content">

		<div class="container"> 
			<div class="align-content-two-columns"> 

				<?php
				$user_id=$_SESSION['user']['id'];

				$userQuery="SELECT * FROM User WHERE ID='$user_id'";
				$user_result = mysqli_query($link, $userQuery);

				$user = mysqli_fetch_assoc($user_result);

				$user_name=$user['name'];
				$user_telephone=$user['telephone'];
				$user_email=$user['email'];
				$user_photo=$user['photo'];
				?>

				<!--------- PANEL --------->
				<div class="panel-bgr">	
					<div class="panel">
						<ul class="tabs">
							<li class="tab" id='profile-tab'>
								<img src="images/icons/profile.png" class="tab-icon">
								Мой профиль
							</li>
							<li class="tab" id='user-courses-tab'>
								<img src="images/icons/list.png" class="tab-icon">
								Мои курсы
							</li>
							<li class="tab" id='user-archive-courses-tab'>
								<img src="images/icons/archive.png" class="tab-icon">
								Архив курсов
							</li>
							<li class="tab" id='school-courses-tab'>
								<img src="images/icons/add.png" class="tab-icon">
								<a href="add_new_course.php">Создать курс</a>
							</li>
							<li class="tab" id='education-tab'>
								<img src="images/icons/learning.png" class="tab-icon">
								Обучение
							</li>
						</ul>
					</div>
				</div>
				<!--------- /PANEL --------->

				<!--------- PROFILE BLOCK --------->			
				<div class="block profile-body" style="display: block;" id="profile-block">
					<div class="profile_border">
						
						<div id="profile_content">
							<div class="align-profile-content">
								<div class="profile-info-block">

									<img src="images/users_photos/<?= $user_photo ?>" class="profile-img" id="profile-img" alt="Фото профиля">

									<div class='profile-info'>
										<div class="profile-name" id="profile-name1"><?= $user_name ?></div>
										<div class="profile-telephone" id="profile-telephone1"><?= $user_telephone ?></div>
										<div class="profile-email" id="profile-email1"><?= $user_email ?></div>
									</div>
								</div>
								<div class="edit-profile-btn">
									<img src="images/edit_icon.png" class="edit-icon">
								</div>
							</div>
						</div>

						<div class="master-info-block" id="profile-info1">
							<p class="profile-name">Описание</p>
							<?php
								$masterInfoQuery = "SELECT Master.info, Master.ID FROM Master JOIN User ON User.ID=Master.ID_user WHERE User.ID=$user_id";
								$masterInfoResult = mysqli_query($link, $masterInfoQuery) or die("Ошибка".mysqli_error($link));

								if($masterInfoResult) 
								{	
									$masterInfo = mysqli_fetch_row($masterInfoResult); 
									$master_id=$masterInfo[1];

									if ($masterInfo[0]!=null) {
										echo "<p id='master-info' class='master-info'>$masterInfo[0]</p>

										<button class='change-btn' id='change-master-info-btn'>Изменить описание</button>

										";

									} else {
										echo "Заполните описание о себе.<br>
										<button class='change-btn' id='change-master-info-btn'>Добавить описание</button>
										";

									}
								}

							?>
						</div>

						<div class="edit-info-block" id="edit-info-block">	
								<p class='profile-name'>Описание</p>
								<textarea type='text' class='master-info-textarea' name='master-info-textarea' id='master-info-textarea-1'><?= $masterInfo[0] ?></textarea>
								<button class='change-btn' id='save-master-info-btn'>Сохранить</button>
						</div>

						<div class="change_profile_content" id="change_profile_content">
							<div class="align-profile-content-2" >

								<div class="edit-img-div">
									<img src="images/users_photos/<?= $user_photo ?>" class="profile-img" id="profile-img2" alt="Фото профиля">
								</div>

								<div class="inputs-margin">
									<div class="box-input">
										<p>Ваше имя</p>
										<input class="input" name="profile_name" type="text" value="<?= $user_name ?>" required>
										<span class="error-span none" name="profile_name-error-span"></span>
									</div>
									<div class="box-input">
										<label>Номер телефона</label>
										<input class="input" name="profile_telephone" type="text" value="<?= $user_telephone ?>" required>
										<span class="error-span none" name="profile_telephone-error-span"></span>
									</div>
									<div class="box-input">
										<label>Почта</label>
										<input class="input" name="profile_email" type="text" value="<?= $user_email ?>" required>
										<span class="error-span none" name="profile_email-error-span"></span>
									</div>
								</div>

								<div class="inputs-margin">
									<div class="box-input">
										<label>Старый пароль</label>
										<input class="input" name="old_password" id="old_password" type="password">
										<span class="error-span none" name="old_password-error-span"></span>
									</div>
									<div class="box-input">
										<label>Новый пароль</label>
										<input class="input" name="new_password" id="new_password" type="password" >
										<span class="error-span none" name="new_password-error-span"></span>
									</div>
									<div class="box-input">
										<label>Повторите новый пароль</label>
										<input class="input" name="new_password_confirm" id="new_password_confirm" type="password" >
										<span class="error-span none" name="new_password_confirm-error-span"></span>
									</div>

								</div>
							</div>

							<div class="edit-buttons">
								<div>
									<button class="change-btn" id="change-profile-img-btn">Изменить фотографию</button>
									<div class="box-input" id="load_new_photo" style="display: none;">
										<input class="input" name="new_profile_photo" id="new_profile_photo_input" type="file" >
										<span class="error-span none" name="photo-error-span"></span>
									</div>
								</div>

								<!-- onclick='saveEditChanges()' -->
								<button class="button save_edit_changes" id="<?= $user_email ?>">Сохранить изменения</button>
							</div>
							<div style="display: flex; justify-content: flex-end;">
								<button class="go-back-toProfile-btn">Назад</button>
							</div>
						</div>

								


					</div>
				</div>
				<!--------- /PROFILE BLOCK --------->

				<!--------- COURSES BLOCK --------->
				<div class="block" id="user-courses-block">
					<div class="admin-title-group">
						<div class="admin-panel-title">Ваши курсы</div>
						<a class="add-entry-button" href="master_add_organized_course.php">
							Добавить курс в расписание
						</a>
					</div>
					  
					<?php
					
					$query2 = "SELECT Course.ID, Organized_course.startDate, Organized_course.ID as id_org_course, User.name, Course.title, Course.price, Course.photo, Group_type.groupType, Group_type.priceCoefficient FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Organized_course.ID_master='$master_id' AND Organized_course.isEnded='0' ORDER BY Organized_course.startDate DESC";

					require 'modules/page_elements/master_courses_cards.php'; 

					if($rows==0) {
						echo "<div>На данный момент вы не проводите ни один курс. </div>";
					}
					?>

				</div>
				<!--------- /COURSES BLOCK --------->  


				<!--------- ARCHIVE COURSES BLOCK --------->
				<div class="block" id="user-archive-courses-block">
					<div class="admin-title-group">
						<div class="admin-panel-title">Архив курсов</div>
					</div>
					  
					<?php

					$query2 = "SELECT Course.ID, Organized_course.startDate, Organized_course.ID as id_org_course, User.name, Course.title, Course.price, Course.photo, Group_type.groupType, Group_type.priceCoefficient FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Organized_course.ID_master='$master_id' AND Organized_course.isEnded='1' ORDER BY Organized_course.startDate DESC";

					require 'modules/page_elements/master_courses_cards.php'; 

					if($rows==0) {
						echo "<div>На данный момент у вас нет проведённых курсов. </div>";
					}
					?>

				</div>
				<!--------- /ARCHIVE COURSES BLOCK --------->  


				<!--------- SCHOOL COURSES BLOCK --------->
				<div class="block" id="school-courses-block">
					<div class="admin-title-group">
						<div class="admin-panel-title">Курсы школы</div>
						<a class="add-entry-button" href="add_new_course.php">
							Создать новый курс
						</a>
					</div>
					vvvvv
				</div>
				<!--------- /SCHOOL COURSES BLOCK --------->  

				<!--------- EDUCATION BLOCK --------->
				<div class="block"  id="user-education-block">
					<div class="admin-title-group">
						<div class="admin-panel-title">Уроки школы</div>
						<a class="add-entry-button" href="add_lesson.php">
							Добавить урок
						</a>
					</div>

					<div class="master-panel-table lesson-table col-12">
					<div class="table-border">

						<div class="title-table row"> 
							<div class="col-1">ID</div>
							<div class="col-3">Название урока</div>
							<div class="col-3">Методичка к уроку</div>
							<div class="col-3">Домашнее задание</div>
							<div class="col-2">Управление</div>
						</div>
						<div class='lesson-body-table'>

						<?php
						$lessonQuery = "SELECT * FROM Lesson";
						$lessonResult = mysqli_query($link, $lessonQuery) or die("Ошибка".mysqli_error($link));
						if($lessonResult) {
							$rows = mysqli_num_rows($lessonResult);
							if($rows>0) {
								for($i = 0; $i < $rows; ++$i)
								{
									$lesson = mysqli_fetch_assoc($lessonResult); 
									echo "<div class='row row-margin' id='row".$lesson['ID']."'>
										<div class='col-1' id='lesson-id".$lesson['ID']."'>".$lesson['ID']."</div>
										<div class='col-3' id='lesson-title".$lesson['ID']."'>".$lesson['title']."</div>";

										if ($lesson['lessonMaterial']!=null) {
											echo "
											<div class='col-3' id='lessonMaterial".$lesson['ID']."'>
												<a href='lessons_materials/lesson_guides/".$lesson['lessonMaterial']."' target='_blank'>".$lesson['lessonMaterial']."</a>
											</div>";
										} else {
											echo "<div class='col-3' id='lessonMaterial".$lesson['ID']."'>Не добавлено</div>";
										}
										if ($lesson['homeworkTask']!=null) {
											echo "
											<div class='col-3' id='homeworkTask".$lesson['ID']."'>
												<a href='lessons_materials/homework_tasks/".$lesson['homeworkTask']."' target='_blank'>".$lesson['homeworkTask']."</a>
											</div>";
										} else {
											echo "<div class='col-3' id='homeworkTask".$lesson['ID']."'>Не добавлено</div>";
										}
										echo "
										<button class='edit-lesson-btn admin-btn col-2' onclick='editLesson(this.id)' id='".$lesson['ID']."'>Изменить</button>
										</div>";

									
								}
								
							}
						}
						
						?>

				</div>
				<!--------- /EDUCATION BLOCK --------->  


				</div>
				</div>

			</div>
		</div>
	</div>

	<?php require 'modules/page_elements/footer.php';?>
</body>



<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/masterProfilePage.js"></script>
<!-- <script src="js/profilePage.js"></script> -->


</html>