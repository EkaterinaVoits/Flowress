 <?php 
 $consultQuery = "SELECT Consultation.ID, Consultation.user_name, Consultation.user_telephone,Status_consultation.status  FROM Consultation JOIN Status_consultation ON Consultation.ID_status=Status_consultation.ID";
 $consultResult = mysqli_query($link, $consultQuery) or die("Ошибка " . mysqli_error($link));			

 if($consultResult) {
 	$rows = mysqli_num_rows($consultResult);
 	if($rows>0) {
 		for($i = 0; $i < $rows; ++$i)
 		{
 			$consult = mysqli_fetch_assoc($consultResult); 
 			echo "<div class='row row-margin'>
 			<div class='col-1'>".$consult['ID']."</div>
 			<div class='col-1'>".$consult['user_name']."</div>
 			<div class='col-2'>".$consult['user_telephone']."</div>
 			<div class='col-3' id='consult_status".$consult['ID']."'><p>".$consult['status']."<p></div>";


 			$query2 = "SELECT * FROM Status_consultation";
 			$result2 = mysqli_query($link, $query2) or die("Ошибка".mysqli_error($link));
 			echo "<select name='status-select' id='".$consult['ID']."' class='col-3 select-style consult_status_select value='no_status' >";

 			if($result2)
 			{
 				$rows2 = mysqli_num_rows($result2);
 				echo "<option value='no_status'></option>";
 				for($j = 0; $j < $rows2; ++$j)
 				{
 					$row2 = mysqli_fetch_row($result2); 
 					echo "<option value='".$row2[0]."'>".$row2[1]."</option>";
 				}
 			}

 			echo "</select>
 			<div class='col-2'>
 			<button class=' admin-btn del-consult-btn' id='".$consult['ID']."'>Удалить</button>
 			</div>
 			</div>";
 		}
 	}
 }
 ?> 


 <script src="../../../js/jquery-3.4.1.min.js"></script>
<script src="../../../js/main.js"></script>
<script src="../../../js/adminPanel.js"></script>