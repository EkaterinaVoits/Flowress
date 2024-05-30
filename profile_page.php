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
							<li class="tab" id='user-requests-tab'>
								<img src="images/icons/request.svg" class="tab-icon">
								Мои заявки
							</li>
							<li class="tab" id='user-courses-tab'>
								<img src="images/icons/schedule.svg" class="tab-icon">
								Активные курсы
							</li>
							<li class="tab" id='education-tab'>
								<img src="images/icons/learning.svg" class="tab-icon">
								Обучение
							</li>
							<li class="tab" id='user-archive-tab'>
								<img src="images/icons/archive.svg" class="tab-icon">
								Архив курсов
							</li>
							<li class="tab" id='user-personal-courses-tab'>
								<img src="images/icons/custom.svg" class="tab-icon">
								Персональные курсы
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
										<input class="input" name="profile_telephone" type="text" value="<?= $user_telephone ?>" id="phone" required>
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

				<!--------- REQUESTS BLOCK --------->
				<div class="block" id="user-requests-block">
					<?php 
					$query2 = "SELECT Course_registration.ID, Organized_course.startDate, Organized_course.ID as id_org_course, User.name, Course.ID as course_id, Course.title, Course.price, Course.photo, Status.status, Status.ID as id_status,Group_type.groupType, Group_type.priceCoefficient FROM Course_registration JOIN Organized_course ON Course_registration.ID_organizedCourse=Organized_course.ID JOIN Status ON Status.ID=Course_registration.ID_status JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Course_registration.ID_user='$user_id' AND Status.ID BETWEEN 1 AND 3 ORDER BY Organized_course.startDate DESC";
					require 'modules/page_elements/user_courses_cards.php'; 

					if($rows==0) {
						echo "<div>Вы не оставляли заявок на курсы. <a href='course_schedule.php'>Выберите интересующий вас курс и оставьте заявку!</a></div>";
					}
					?>
				</div>
				<!--------- /REQUESTS BLOCK --------->  

				<!--------- COURSES BLOCK --------->
				<div class="block" id="user-courses-block">
					<?php
					$query2 = "SELECT Course_registration.ID, Organized_course.startDate, Organized_course.ID as id_org_course, User.name, Course.ID as course_id,Course.title, Course.price, Course.photo, Status.status, Status.ID as id_status,Group_type.groupType, Group_type.priceCoefficient FROM Course_registration JOIN Organized_course ON Course_registration.ID_organizedCourse=Organized_course.ID JOIN Status ON Status.ID=Course_registration.ID_status JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Course_registration.ID_user='$user_id' AND Status.ID IN(4,5) ORDER BY Organized_course.startDate DESC";
					 require 'modules/page_elements/user_courses_cards.php'; 

					 if($rows==0) {
						echo "<div>Вы не записаны ни на какой курс. <a href='course_schedule.php'>Успейте записаться!</a></div>";
					}
					 ?>
				</div>
				<!--------- /COURSES BLOCK --------->   

				<!--------- EDUCATION BLOCK --------->
				<div class="block"  id="user-education-block">
				<?php
				$query = "SELECT Course_registration.ID as registration_id, Course.ID as course_id, Organized_course.ID as org_course_id, Course.title FROM Course_registration JOIN Organized_course ON Course_registration.ID_organizedCourse=Organized_course.ID JOIN Course ON Organized_course.ID_course=Course.ID WHERE Course_registration.ID_user='$user_id' AND Course_registration.ID_status=5";
				$courseResult = mysqli_query($link, $query) or die("Ошибка".mysqli_error($link));

				if($result)
				{
					$rows = mysqli_num_rows($courseResult);
					for($t = 0; $t < $rows; ++$t)
					{
						$course = mysqli_fetch_assoc($courseResult); 

						$course_id=$course['course_id'];
						$registration_id=$course['registration_id'];
						$org_course_id=$course['org_course_id'];

						echo "
						<div class='course-white-rect'>
							<div class='course-item-lessons-content'>
						
						<div class='course-item-title'>".$course['title']."</div>
						";
						$lessonQuery = "SELECT * FROM Course JOIN Course_lessons ON Course.ID=Course_lessons.ID_course JOIN Lesson ON Course_lessons.ID_lesson=Lesson.ID JOIN Lesson_progress ON Lesson_progress.ID_courseLesson=Course_lessons.ID WHERE Lesson_progress.ID_organizedCourse=$org_course_id";

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

								if($lesson['isChecked']!=0) {
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
								} else {
									echo "<div>Домашнее задание и материалы появятся после того, как вы пройдёте урок</div>";
								}

								
								echo "</div>";
								$lesson_number++;
							}
						}
						echo "</div>
						<div class='two-lines'></div>
						</div>";
					}
					if($rows==0) {
						echo "<div>В данный момент Вы не проходите обучения.</div>";
					}

				}
				?>

				</div>
				<!--------- /EDUCATION BLOCK --------->  

				<!--------- ARCHIVE BLOCK --------->
				<div class="block" id="user-archive-courses-block">
					<?php
					$query2 = "SELECT Course_registration.ID, Organized_course.startDate, Organized_course.ID as id_org_course, User.name, Course.ID as course_id, Course.title, Course.price, Course.photo, Status.status, Status.ID as id_status,Group_type.groupType, Group_type.priceCoefficient FROM Course_registration JOIN Organized_course ON Course_registration.ID_organizedCourse=Organized_course.ID JOIN Status ON Status.ID=Course_registration.ID_status JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Course_registration.ID_user='$user_id' AND Status.ID=6 ORDER BY Organized_course.startDate DESC";
					require 'modules/page_elements/user_courses_cards.php'; 

					if($rows==0) {
						echo "<div>Вы не прошли ни один курс.</div>";
					}
					

					?>
				</div>
				<!--------- /ARCHIVE BLOCK --------->  

				<!--------- PERSONAL COURSES BLOCK --------->
				<div class="block" id="user-personal-courses-block">
					<?php

						$courseQuery = "SELECT Course.ID, Course.photo, Course.price, Course.title, Course.description, Course.fullDescription FROM Course JOIN User ON Course.ID_user=User.ID WHERE User.ID='$user_id'";
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

								<div class='course-white-rect'>
									<div class='course-item-content'>


									<div class='course-item-content-wrapper-2'>

									<div class='course-item-title'>".$row['title']."</div>

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
									</div>";

									$coursePriceCoefficientQuery = "SELECT priceCoefficient FROM Group_type WHERE groupType='Индивидуальное обучение'";
									$coursePriceCoefficientResult = mysqli_query($link, $coursePriceCoefficientQuery) or die("Ошибка".mysqli_error($link));

									if($coursePriceCoefficientResult){

										$priceCoefficientRow=mysqli_fetch_row($coursePriceCoefficientResult); 
										$priceCoefficient=$priceCoefficientRow[0];
										echo "<div class='course-item-title'>Стоимость: ".($row['price']*$priceCoefficient)." BYN</div>";

									}
									
									echo "

									<div><button class='show-course-reg-form btn' id='".$row['ID']."''>
										<p>Отправить завку</p>
										<img src='images/arrow.png' class='arrow'>
									</button></div>

									</div>

									</div>

									<div class='two-lines'></div>
								</div>
								</div>
								";
							}

							if($rows==0) {
								echo "<div>У вас нет персональных крсов. <a  id='go-to-add-perconal-course'>Составить курс</a></div>";
							}
							
						}
						mysqli_free_result($courseResult); 
						?>
				</div>
				<!--------- /PERSONAL COURSES BLOCK --------->  

				


				</div>
				</div>

			</div>
		</div>
	</div>

	<!------------ ADD REG USER COURSE FORM -------------->
		<div class="add-reg-user-form" id="masters-info-form">

			<div class="white-form-2">
				<div class="close-form">
					<img src="images/close.png" class="close-btn">
				</div>

				<div class="form-content-wrapper">
					<div class='form-inputs'>


							<div> 
								<p>Выберите желаемую дату начала курса</p>
								<input name='user-course-startDate' type='date' class='select-style' min="<?php echo date('Y-m-d'); ?>"  required>
							</div>

							<div>
								<p>Выберите мастера</p>

					<?php

					echo "
					

					
								<select name='master-select' id='master_select' class='select-style'>";
									
									$query = "SELECT Master.ID, User.name, User.email FROM Master JOIN User ON Master.ID_user=User.ID WHERE User.userType='master'";
									$result = mysqli_query($link, $query) or die("Ошибка".mysqli_error($link));

									if($result)
									{
										$rows = mysqli_num_rows($result);
										for($i = 0; $i < $rows; ++$i)
										{
											$row = mysqli_fetch_assoc($result); 
											echo "<option value='".$row['ID']."'>".$row['name']." (".$row['email'].")</option>";
										}
									}
									
									echo "
								</select>
							</div>


						<button class='btn add-reg-user-course-btn'>
							<p>Отправить заявку</p>
							<img src='images/arrow.png' class='arrow'>
						</button>

					</div>";


					?>
				</div>
				<div class="two-lines"></div>
			</div>
		</div>
	<!------------ /ADD REG USER COURSE FORM -------------->

<?php require 'modules/page_elements/footer.php';?>

</body>



<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/profilePage.js"></script>
<script src="js/main.js"></script>

</html>