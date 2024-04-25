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
	<link rel="stylesheet" href="../../css/course_item_style.css" type="text/css">
	<link rel="stylesheet" href="../../css/course_style.css" type="text/css">
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
							<li class="tab" id='profile-tab'>Мой профиль</li>
							<li class="tab" id='user-courses-tab'>Мои курсы</li>
							<li class="tab" id='education-tab'>Обучение</li>
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
					<?php require 'modules/page_elements/user_courses_cards.php'; ?>
				</div>
				<!--------- /COURSES BLOCK --------->  

				<!--------- EDUCATION BLOCK --------->
				<div class="block"  id="user-education-block">
				<?php
				$query = "SELECT Course_registration.ID as registration_id, Course.ID as course_id, Course.title FROM Course_registration JOIN Organized_course ON Course_registration.ID_organizedCourse=Organized_course.ID JOIN Course ON Organized_course.ID_course=Course.ID  WHERE Course_registration.ID_user='$user_id' AND Course_registration.ID_status IN (5,6)";
				$courseResult = mysqli_query($link, $query) or die("Ошибка".mysqli_error($link));

				if($result)
				{
					$rows = mysqli_num_rows($courseResult);
					for($t = 0; $t < $rows; ++$t)
					{
						$course = mysqli_fetch_assoc($courseResult); 

						$course_id=$course['course_id'];
						$registration_id=$course['registration_id'];

						echo "
						<div class='course-white-rect'>
							<div class='course-item-lessons-content'>
						
						<div class='course-item-title'>".$course['title']."</div>
						";
						$lessonQuery = "SELECT * FROM Course JOIN Course_lessons ON Course.ID=Course_lessons.ID_course JOIN Lesson ON Course_lessons.ID_lesson=Lesson.ID WHERE Course.ID=$course_id";

						$lessonResult = mysqli_query($link, $lessonQuery) or die("Ошибка".mysqli_error($link));
						if($lessonResult)
						{
							$rows2 = mysqli_num_rows($lessonResult);
							$lesson_number=1;
							for($j = 0; $j < $rows2; ++$j)
							{

								$lesson = mysqli_fetch_assoc($lessonResult); 

								echo "
								
								<div class='lesson-item'>
									<div class='lesson-title'>
									Занятие ".$lesson_number.". ".$lesson['title']."
									</div>
								</div>
								<div class='lesson-materials'>";

								/*$checkedLessonQuery = "SELECT Lesson_progress.isChecked FROM Lesson_progress JOIN Organized_course ON Lesson_progress.ID_organizedCourse=Organized_course.ID JOIN Lesson ON Lesson_progress.ID_lesson=Lesson.ID JOIN Course_registration ON Course_registration.ID_organizedCourse=Organized_course.ID WHERE Course_registration.ID_organizedCourse=10";

								$checkedLessonResult = mysqli_query($link, $checkedLessonQuery) or die("Ошибка".mysqli_error($link));*/

								if ($lesson['lessonMaterial']!=null) {
									echo "
									<div>Методичка к уроку:
										<a href='lessons_materials/lesson_guides/".$lesson['lessonMaterial']."' target='_blank'>".$lesson['lessonMaterial']."</a>
									</div>";
								} else echo "<div>Материалы не добавлены</div>";
								if ($lesson['homeworkTask']!=null) {
									echo "
									<div>Домашнее задание
										<a href='lessons_materials/homework_tasks/".$lesson['homeworkTask']."' target='_blank'>".$lesson['homeworkTask']."</a>
									</div>";
								} else echo "<div>Домашнее задание не добавлено</div>";
								echo "</div>";
								$lesson_number++;
							}
						}
						echo "</div>
						<div class='two-lines'></div>
						</div>";
					}
					if($rows==0) {
						echo "<div>Вы не записаны ни на какой курс. Начните проходить обучения!</div>";
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
</body>



<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/profilePage.js"></script>
<script src="js/main.js"></script>

</html>