				<div class="admin-title-group">
					<div class="admin-panel-title">Активные курсы</div>
				</div>

				<div class="admin-panel-table col-12">
					<div class="table-border">

						<div class="title-table row"> 
							<div class="col-1">ID</div>
							<div class="col-2">Название</div>
							<div class="col-2">Описание</div>
							<div class="col-4">Полное описание</div>
							<div class="col-1">Стоимость</div>
							<div class="col-2">Управление</div>
						</div>
						<div class='masters-body-table'>

							<?php 
							$courseQuery = "SELECT Course.ID, Course.title,Course.description, Course.fullDescription, Course.price FROM Course JOIN User ON Course.ID_user=User.ID WHERE User.userType IN ('master', 'admin') AND isActive=1";								
							$courseResult = mysqli_query($link, $courseQuery) or die("Ошибка " . mysqli_error($link));

							if($courseResult) {
								$rows = mysqli_num_rows($courseResult);
								if($rows>0) {
									for($i = 0; $i < $rows; ++$i)
									{
										$course = mysqli_fetch_assoc($courseResult); 
										echo "<div class='row row-margin'>
										<div class='col-1'>".$course['ID']."</div>
										<div class='col-2'>".$course['title']."</div>
										<div class='col-2'>".$course['description']."</div>
										<div class='col-4'>".$course['fullDescription']."</div>
										<div class='col-1'>".$course['price']." BYN</div>
										<div class='col-2'><button class='archive-course-btn admin-btn' style='width:150px; margin-left:0px;' id='".$course['ID']."' onclick='archiveCourse(this.id)'>Архивировать</button>
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
					<div class="admin-panel-title">Архив курсов</div>
				</div>

				<div class="admin-panel-table col-12">
					<div class="table-border">

						<div class="title-table row"> 
							<div class="col-1">ID</div>
							<div class="col-2">Название</div>
							<div class="col-2">Описание</div>
							<div class="col-4">Полное описание</div>
							<div class="col-1">Стоимость</div>
							<div class="col-2">Управление</div>
						</div>
						<div class='masters-body-table'>

							<?php 
							$courseQuery = "SELECT Course.ID, Course.title,Course.description, Course.fullDescription, Course.price FROM Course JOIN User ON Course.ID_user=User.ID WHERE User.userType IN ('master', 'admin') AND isActive=0";								
							$courseResult = mysqli_query($link, $courseQuery) or die("Ошибка " . mysqli_error($link));

							if($courseResult) {
								$rows = mysqli_num_rows($courseResult);
								if($rows>0) {
									for($i = 0; $i < $rows; ++$i)
									{
										$course = mysqli_fetch_assoc($courseResult); 
										echo "<div class='row row-margin'>
										<div class='col-1'>".$course['ID']."</div>
										<div class='col-2'>".$course['title']."</div>
										<div class='col-2'>".$course['description']."</div>
										<div class='col-4'>".$course['fullDescription']."</div>
										<div class='col-1'>".$course['price']." BYN</div>
										<div class='col-2'><button class='activate-course-btn admin-btn' style='width:150px; margin-left:0px;' id='".$course['ID']."' onclick='activateCourse(this.id)'>Активировать</button>
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
					<div class="admin-panel-title">Пользовательские курсы</div>
				</div>

				<div class="admin-panel-table col-12">
					<div class="table-border">

						<div class="title-table row"> 
							<div class="col-1">ID</div>
							<div class="col-6">Описание</div>
							<div class="col-3">Пожелания к курсу</div>
							<div class="col-2">Стоимость</div>
						</div>
						<div class='masters-body-table'>

							<?php 
							$courseQuery = "SELECT Course.ID, Course.title,Course.description, Course.fullDescription, Course.price FROM Course JOIN User ON Course.ID_user=User.ID WHERE User.userType IN ('user')";								
							$courseResult = mysqli_query($link, $courseQuery) or die("Ошибка " . mysqli_error($link));

							if($courseResult) {
								$rows = mysqli_num_rows($courseResult);
								if($rows>0) {
									for($i = 0; $i < $rows; ++$i)
									{
										$course = mysqli_fetch_assoc($courseResult); 
										echo "<div class='row row-margin'>
										<div class='col-1'>".$course['ID']."</div>
										<div class='col-6'>".$course['fullDescription']."</div>
										<div class='col-3'>".$course['description']."</div>
										<div class='col-2'>".$course['price']." BYN</div>
										</div>";
									}
								}
							}
							?>
						</div>
					</div>
				</div>