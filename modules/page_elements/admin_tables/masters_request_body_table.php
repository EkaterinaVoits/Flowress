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

 <script src="../../../js/jquery-3.4.1.min.js"></script>
 <script src="../../../js/main.js"></script>
 <script src="../../../js/adminPanel.js"></script>