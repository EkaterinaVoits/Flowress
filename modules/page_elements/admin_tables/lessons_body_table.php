<div class="admin-title-group">
					<div class="admin-panel-title">Активные уроки</div>
				</div>

				<div class="admin-panel-table col-12">
					<div class="table-border">

						<div class="title-table row"> 
							<div class="col-2">Название</div>
							<div class="col-4">Описание</div>
							<div class="col-2">Методичка к уроку</div>
							<div class="col-2">Домашнее задание</div>
							<div class="col-2">Управление</div>
						</div>
						<div class='masters-body-table'>

							<?php 
							$lessonQuery = "SELECT * FROM Lesson WHERE isActive=1";								
							$lessonResult = mysqli_query($link, $lessonQuery) or die("Ошибка " . mysqli_error($link));

							if($lessonResult) {
								$rows = mysqli_num_rows($lessonResult);
								if($rows>0) {
									for($i = 0; $i < $rows; ++$i)
									{
										$lesson = mysqli_fetch_assoc($lessonResult); 
										echo "<div class='row row-margin'>
										<div class='col-2'>".$lesson['title']."</div>
										<div class='col-4'>".$lesson['description']."</div>";

										if ($lesson['lessonMaterial']!=null) {
											echo "
											<div class='col-2' id='lessonMaterial".$lesson['ID']."'>
												<a href='lessons_materials/lesson_guides/".$lesson['lessonMaterial']."' target='_blank'>".$lesson['lessonMaterial']."</a>
											</div>";
										} else {
											echo "<div class='col-2' id='lessonMaterial".$lesson['ID']."'>Не добавлено</div>";
										}
										if ($lesson['homeworkTask']!=null) {
											echo "
											<div class='col-2' id='homeworkTask".$lesson['ID']."'>
												<a href='lessons_materials/homework_tasks/".$lesson['homeworkTask']."' target='_blank'>".$lesson['homeworkTask']."</a>
											</div>";
										} else {
											echo "<div class='col-2' id='homeworkTask".$lesson['ID']."'>Не добавлено</div>";
										}
										echo "
											<div class='col-2'><button class='archive-lesson-btn admin-btn' style='width:150px;margin-left:0px;' id='".$lesson['ID']."' onclick='archiveLesson(this.id)'>Архивировать</button>
										</div>
										</div>";
									}
								}
							}
							?>
						</div>
					</div>
				</div>

				<div class="admin-title-group">
					<div class="admin-panel-title">Архив уроков</div>
				</div>

				<div class="admin-panel-table col-12">
					<div class="table-border">

						<div class="title-table row"> 
							<div class="col-2">Название</div>
							<div class="col-4">Описание</div>
							<div class="col-2">Методичка к уроку</div>
							<div class="col-2">Домашнее задание</div>
							<div class="col-2">Управление</div>
						</div>
						<div class='masters-body-table'>

							<?php 
							$lessonQuery = "SELECT * FROM Lesson WHERE isActive=0";								
							$lessonResult = mysqli_query($link, $lessonQuery) or die("Ошибка " . mysqli_error($link));

							if($lessonResult) {
								$rows = mysqli_num_rows($lessonResult);
								if($rows>0) {
									for($i = 0; $i < $rows; ++$i)
									{
										$lesson = mysqli_fetch_assoc($lessonResult); 
										echo "<div class='row row-margin'>
										<div class='col-2'>".$lesson['title']."</div>
										<div class='col-4'>".$lesson['description']."</div>";

										if ($lesson['lessonMaterial']!=null) {
											echo "
											<div class='col-2' id='lessonMaterial".$lesson['ID']."'>
												<a href='lessons_materials/lesson_guides/".$lesson['lessonMaterial']."' target='_blank'>".$lesson['lessonMaterial']."</a>
											</div>";
										} else {
											echo "<div class='col-2' id='lessonMaterial".$lesson['ID']."'>Не добавлено</div>";
										}
										if ($lesson['homeworkTask']!=null) {
											echo "
											<div class='col-2' id='homeworkTask".$lesson['ID']."'>
												<a href='lessons_materials/homework_tasks/".$lesson['homeworkTask']."' target='_blank'>".$lesson['homeworkTask']."</a>
											</div>";
										} else {
											echo "<div class='col-2' id='homeworkTask".$lesson['ID']."'>Не добавлено</div>";
										}
										echo "
											<div class='col-2'><button class='aсtivate-lesson-btn admin-btn' style='width:150px;margin-left:0px;' id='".$lesson['ID']."' onclick='activateLesson(this.id)'>Активировать</button>
										</div>
										</div>";
									}
								}
							}
							?>
						</div>
					</div>
				</div>