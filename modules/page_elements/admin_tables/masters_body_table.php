			
<link rel="stylesheet" href="../../css/style.css" type="text/css">
	<link rel="stylesheet" href="../../css/admin_panel_style.css" type="text/css">
	<!-- Bootstrap CSS (jsDelivr CDN) -->	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


				<div class="admin-title-group">
					<div class="admin-panel-title">Преподаватели</div>
					<!-- <a class="add-entry-button" href="admin_add_master.php">
						Назначить преподавателя
					</a> -->
				</div>

				<div class="admin-panel-table col-12">
					<div class="table-border">

						<div class="title-table row"> 
							<div class="col-1">ID</div>
							<div class="col-1">Имя</div>
							<div class="col-2">email</div>
							<div class="col-2">Телефон</div>
							<div class="col-4">Доп.инфо</div>
							<div class="col-2">Управление</div>
						</div>
						<div class='masters-body-table'>

							<?php 
							$masterQuery = "SELECT Master.ID, User.telephone, Master.info, User.name, User.email FROM Master JOIN User ON Master.ID_user=User.ID WHERE User.userType='master'";								
							$masterResult = mysqli_query($link, $masterQuery) or die("Ошибка " . mysqli_error($link));

							if($masterResult) {
								$rows = mysqli_num_rows($masterResult);
								if($rows>0) {
									for($i = 0; $i < $rows; ++$i)
									{
										$master = mysqli_fetch_assoc($masterResult); 
										echo "<div class='row row-margin'>
										<div class='col-1'>".$master['ID']."</div>
										<div class='col-1'>".$master['name']."</div>
										<div class='col-2'>".$master['email']."</div>
										<div class='col-2'>".$master['telephone']."</div>
										<div class='col-4'>".$master['info']."</div>
										<div class='col-2'><button class='admin-btn' id='".$master['ID']."' onclick='deleteMaster(this.id)'>Удалить</button>
										</div></div>";
									}
								}
							}
							?>
							
						</div>
					</div>
				</div>


				<div class="admin-title-group">
					<div class="admin-panel-title">Заявки на преподавателя</div>
				</div>

				<div class="admin-panel-table col-12">
					<div class="table-border">

						<div class="title-table row"> 
							<div class="col-2">Имя</div>
							<div class="col-2">email</div>
							<div class="col-2">Телефон</div>
							<div class="col-3">Портфолио</div>
							<div class="col-3">Управление</div>
						</div>
						<div class='masters-requests-body-table'>

							<?php 
							$masterRequestQuery = "SELECT * FROM Master_request JOIN User ON Master_request.ID_user=User.ID";								
							$masterRequestResult = mysqli_query($link, $masterRequestQuery) or die("Ошибка " . mysqli_error($link));

							if($masterRequestResult) {
								$rows = mysqli_num_rows($masterRequestResult);
								if($rows>0) {
									for($i = 0; $i < $rows; ++$i)
									{
										$master2 = mysqli_fetch_assoc($masterRequestResult); 
										echo "<div class='row row-margin'>
										<div class='col-2'>".$master2['name']."</div>
										<div class='col-2'>".$master2['email']."</div>
										<div class='col-2'>".$master2['telephone']."</div>
										<div class='col-3'>".$master2['portfolio']."</div>
										<div class='col-3'><button class='admin-btn' id='".$master2['ID_user']."' onclick='addMaster(this.id)'>Добавить</button>
										</div></div>";
									}
								}
							}
							?> 

						</div>
					</div>
				</div>

				<script src="../../../js/jquery-3.4.1.min.js"></script>
				<script src="../../../js/main.js"></script>
				<script src="../../../js/adminPanel.js"></script>