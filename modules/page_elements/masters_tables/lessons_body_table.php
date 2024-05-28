					<div class="admin-title-group">
						<div class="admin-panel-title">Активные уроки</div>
						<a class="add-entry-button" href="add_lesson.php">
							Добавить урок
						</a>
					</div>

					<div class="master-panel-table lesson-table col-12">
					<div class="table-border">

						<div class="title-table row"> 
							<div class="col-2">Название урока</div>
							<div class="col-3">Методичка к уроку</div>
							<div class="col-3">Домашнее задание</div>
							<div class="col-4">Управление</div>
						</div>
						<div class='lesson-body-table'>

						<?php
						$lessonQuery = "SELECT * FROM Lesson WHERE isActive=1";
						$lessonResult = mysqli_query($link, $lessonQuery) or die("Ошибка".mysqli_error($link));
						if($lessonResult) {
							$rows = mysqli_num_rows($lessonResult);
							if($rows>0) {
								for($i = 0; $i < $rows; ++$i)
								{
									$lesson = mysqli_fetch_assoc($lessonResult); 
									echo "<div class='row row-margin' id='row".$lesson['ID']."'>
	
										<div class='col-2' id='lesson-title".$lesson['ID']."'>".$lesson['title']."</div>";

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
										<div class='col-4'>
										<button class='edit-lesson-btn admin-btn' onclick='editLesson(this.id)' id='".$lesson['ID']."'>Изменить</button>
										<button class='edit-lesson-btn admin-btn-2' onclick='activateLesson(this.id)' id='".$lesson['ID']."'>Архивировать</button>
										</div>
										</div>";

									
								}
								
							}
						}
						
						?>
				</div>
				


				</div>
				</div>


				<div class="admin-title-group " style='margin-top: 20px;'>
						<div class="admin-panel-title" >Архивированные уроки</div>
					</div>

					<div class="master-panel-table lesson-table col-12">
					<div class="table-border">

						<div class="title-table row"> 
							<div class="col-2">Название урока</div>
							<div class="col-3">Методичка к уроку</div>
							<div class="col-3">Домашнее задание</div>
							<div class="col-4">Управление</div>
						</div>
						<div class='lesson-body-table'>

						<?php
						$lessonQuery = "SELECT * FROM Lesson WHERE isActive=0";
						$lessonResult = mysqli_query($link, $lessonQuery) or die("Ошибка".mysqli_error($link));
						if($lessonResult) {
							$rows = mysqli_num_rows($lessonResult);
							if($rows>0) {
								for($i = 0; $i < $rows; ++$i)
								{
									$lesson = mysqli_fetch_assoc($lessonResult); 
									echo "<div class='row row-margin' id='row".$lesson['ID']."'>
	
										<div class='col-2' id='lesson-title".$lesson['ID']."'>".$lesson['title']."</div>";

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
										<div class='col-4'>
										<button class='edit-lesson-btn admin-btn' onclick='editLesson(this.id)' id='".$lesson['ID']."'>Изменить</button>
										<button class='edit-lesson-btn admin-btn-2' onclick='activateLesson(this.id)' id='".$lesson['ID']."'>Активировать</button>
										</div>
										</div>";

									
								}
								
							}
						}
						
						?>
				</div>

				</div>
				</div>