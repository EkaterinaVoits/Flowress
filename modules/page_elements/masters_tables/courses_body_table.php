					<div class="admin-title-group">
						<div class="admin-panel-title">Активные курсы</div>
						<a class="add-entry-button" href="add_new_course.php">
							Создать новый курс
						</a>
					</div>

					<div class="master-panel-table courses-table col-12">
						<div class="table-border">

							<div class="title-table row"> 
								<div class="col-2">Название курса</div>
								<div class="col-4">Уроки</div>
								<div class="col-2">Стоимость</div>
								<div class="col-4">Управление</div>
							</div>
							<div class='lesson-body-table'>

								<?php
								$courseQuery = "SELECT Course.ID, Course.title, Course.price FROM Course JOIN User ON Course.ID_user=User.ID WHERE User.userType IN ('master', 'admin') AND isActive=1";								
								$courseResult = mysqli_query($link, $courseQuery) or die("Ошибка " . mysqli_error($link));

								if($courseResult) {
									$rows = mysqli_num_rows($courseResult);
									if($rows>0) {
										for($i = 0; $i < $rows; ++$i)
										{
											$course = mysqli_fetch_assoc($courseResult); 
											$course_id= $course['ID'];
											echo "<div class='row row-margin'>
											<div class='col-2'>".$course['title']."</div>
											<div class='col-4'>";

											$courseLessonsQuery = "SELECT Lesson.title FROM Course_lessons JOIN Course ON Course_lessons.ID_course=Course.ID JOIN Lesson ON Course_lessons.ID_lesson=Lesson.ID WHERE Course.ID=$course_id";								
											$courseLessonsResult = mysqli_query($link, $courseLessonsQuery) or die("Ошибка " . mysqli_error($link));

											if($courseLessonsResult) {
												$rows2 = mysqli_num_rows($courseLessonsResult);


												if($rows2>0) {
													echo "<ul type='circle' class='course-lesson-item'>";
													for($j = 0; $j < $rows2; ++$j)
													{
														$courseLessonItem = mysqli_fetch_assoc($courseLessonsResult); 
														echo "<li style='display: list-item;'>".$courseLessonItem['title']."</li>";
													}
													echo "</ul>";
												}

											}

											echo "
											</div>
											<div class='col-2'>".$course['price']." BYN</div>
											<div class='col-4'>
											<button class='edit-lesson-btn admin-btn' onclick='editCourse(this.id)' id='".$course_id."'>Изменить</button>
											<button class='edit-lesson-btn admin-btn-2' onclick='archiveLesson(this.id)' id='".$course_id."'>Архивировать</button>
											</div>
											</div>";


										}

									}
								}

								?>
							</div>



						</div>
					</div>

					<div class="admin-title-group" style='margin-top: 20px;'>
						<div class="admin-panel-title">Архивированные курсы</div>
					</div>

					<div class="master-panel-table courses-table col-12">
						<div class="table-border">

							<div class="title-table row"> 
								<div class="col-2">Название курса</div>
								<div class="col-4">Уроки</div>
								<div class="col-2">Стоимость</div>
								<div class="col-4">Управление</div>
							</div>
							<div class='lesson-body-table'>

								<?php
								$courseQuery = "SELECT Course.ID, Course.title, Course.price FROM Course JOIN User ON Course.ID_user=User.ID WHERE User.userType IN ('master', 'admin') AND isActive=0";								
								$courseResult = mysqli_query($link, $courseQuery) or die("Ошибка " . mysqli_error($link));

								if($courseResult) {
									$rows = mysqli_num_rows($courseResult);
									if($rows>0) {
										for($i = 0; $i < $rows; ++$i)
										{
											$course = mysqli_fetch_assoc($courseResult); 
											$course_id= $course['ID'];
											echo "<div class='row row-margin'>
											<div class='col-2'>".$course['title']."</div>
											<div class='col-4'>";
											
											$courseLessonsQuery = "SELECT Lesson.title FROM Course_lessons JOIN Course ON Course_lessons.ID_course=Course.ID JOIN Lesson ON Course_lessons.ID_lesson=Lesson.ID WHERE Course.ID=$course_id";								
											$courseLessonsResult = mysqli_query($link, $courseLessonsQuery) or die("Ошибка " . mysqli_error($link));

											if($courseLessonsResult) {
												$rows2 = mysqli_num_rows($courseLessonsResult);

												
												if($rows2>0) {
													echo "<ul type='circle' class='course-lesson-item'>";
													for($j = 0; $j < $rows2; ++$j)
													{
														$courseLessonItem = mysqli_fetch_assoc($courseLessonsResult); 
														echo "<li style='display: list-item;'>".$courseLessonItem['title']."</li>";
													}
													echo "</ul>";
												}
												
											}

											echo "
											</div>
											<div class='col-2'>".$course['price']." BYN</div>
											<div class='col-4'>
											<button class='edit-lesson-btn admin-btn' onclick='editCourse(this.id)' id='".$course_id."'>Изменить</button>
											<button class='edit-lesson-btn admin-btn-2' onclick='activeLesson(this.id)' id='".$course_id."'>Активировать</button>
											</div>
											</div>";

											
										}
										
									}
								}
								
								?>
							</div>
							


						</div>
					</div>