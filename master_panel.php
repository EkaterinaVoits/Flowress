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
	<link rel="stylesheet" href="../../css/style.css" type="text/css">
	<link rel="stylesheet" href="../../css/profile_page_style.css" type="text/css">
	<link rel="stylesheet" href="../../css/master_profile_style.css" type="text/css">
	<link rel="stylesheet" href="../../css/course_item_style.css" type="text/css">
	<link rel="stylesheet" href="../../css/course_style.css" type="text/css">
	<!-- Bootstrap CSS (jsDelivr CDN) -->	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="https://unpkg.com/imask"></script> 
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
								<img src="images/icons/profile.svg" class="tab-icon">
								Мой профиль
							</li>
							<li class="tab" id='user-courses-tab'>
								<img src="images/icons/list.svg" class="tab-icon">
								Мои курсы
							</li>
							<li class="tab" id='user-archive-courses-tab'>
								<img src="images/icons/archive.svg" class="tab-icon">
								Архив курсов
							</li>
							<li class="tab" id='school-courses-tab'>
								<img src="images/icons/course.svg" class="tab-icon">
								<!-- <a href="add_new_course.php">Курсы</a> -->
								Курсы
							</li>
							<li class="tab" id='education-tab'>
								<img src="images/icons/learning.svg" class="tab-icon">
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
									<img src="images/icons/edit_icon.svg" class="edit-icon">
								</div>
							</div>
						</div>

						<div class="master-info-block" id="profile-info1">
							<p class="profile-name" style='margin-top: 15px;'>О себе</p>
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
										<input class="input" name="profile_telephone" type="text" value="<?= $user_telephone ?>"  id="phone" placeholder='+375 (__) ___-__-__' required>
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

			<div id="all-master-courses" style="display: none; width: 100%;">

				<!--------- COURSES BLOCK --------->
				<div class="block" id="user-courses-block">
					<div class="admin-title-group">
						<div class="admin-panel-title">Ваши курсы</div>
						<a class="add-entry-button" href="master_add_organized_course.php">
							Добавить курс в расписание
						</a>
					</div>
					<div class="refresh-page-msg none">Обновите страницу для дальнейшей работы</div>
					 <div class="master-courses-cards">
					 	
					
					<?php
					
					$query2 = "SELECT Course.ID, Organized_course.startDate, Organized_course.ID as id_org_course, Organized_course.isEnded, User.name, Course.title, Course.price, Course.photo, Group_type.ID as id_groupType, Group_type.groupType, Group_type.priceCoefficient FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Organized_course.ID_master='$master_id' AND Organized_course.isEnded='0' ORDER BY Organized_course.startDate DESC";

					require 'modules/page_elements/master_courses_cards.php'; 

					if($rows==0) {
						echo "<div>На данный момент вы не проводите ни один курс. </div>";
					}
					?>
					 </div> 
				</div>
				<!--------- /COURSES BLOCK --------->  


				<!--------- ARCHIVE COURSES BLOCK --------->
				<div class="block" id="user-archive-courses-block">
					<div class="admin-title-group">
						<div class="admin-panel-title">Архив курсов</div>
					</div>
					  
					<?php

					$query2 = "SELECT Course.ID, Organized_course.startDate, Organized_course.ID as id_org_course, Organized_course.isEnded, User.name, Course.title, Course.price, Course.photo, Group_type.ID as id_groupType,Group_type.groupType, Group_type.priceCoefficient FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Organized_course.ID_master='$master_id' AND Organized_course.isEnded='1' ORDER BY Organized_course.startDate DESC";

					require 'modules/page_elements/master_courses_cards.php'; 

					if($rows==0) {
						echo "<div>На данный момент у вас нет проведённых курсов. </div>";
					}
					?>

				</div>
				<!--------- /ARCHIVE COURSES BLOCK --------->  
			</div>


				<!--------- SCHOOL COURSES BLOCK --------->
				<div class="block" id="school-courses-block">
					
					<?php require 'modules/page_elements/masters_tables/courses_body_table.php'; ?>
				</div>
				<!--------- /SCHOOL COURSES BLOCK --------->  

				<!--------- EDUCATION BLOCK --------->
				<div class="block"  id="user-education-block">

					<?php require 'modules/page_elements/masters_tables/lessons_body_table.php'; ?>

			</div>
			<!--------- /EDUCATION BLOCK --------->  
		</div>
	</div>

	<?php require 'modules/page_elements/footer.php';?>
</body>



<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/masterProfilePage.js"></script>
<script src="js/changeProfileInfo.js"></script>
<!-- <script src="js/profilePage.js"></script> -->


</html>