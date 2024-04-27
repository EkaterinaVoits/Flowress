 <?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<link rel="stylesheet" href="../../css/style.css" type="text/css">
<link rel="stylesheet" href="../../css/slider_style.css" type="text/css">	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="../../js/jquery-3.4.1.min.js"></script>
<script src="../../js/slider.js"></script>
<?php

if(isset($_SESSION['user']['id'])) {
	$id_user=$_SESSION['user']['id'];
} else {
	$id_user="";
} 

$reviewQuery = "SELECT * FROM Course_review WHERE ID_course='$id_course'";
	$reviewResult = mysqli_query($link, $reviewQuery) or die("Ошибка".mysqli_error($link));
	$reviews = mysqli_num_rows($reviewResult);

	echo "

	

	<img src='../../images/scroll_arrow_1.png' class='slider-arrow desktop-slider-arrow' onclick='previousSlide()'>
		";

		
			if($reviews) {
				for($i = 0; $i < $reviews; ++$i) 
				{
					$review = mysqli_fetch_assoc($reviewResult);

					$reviewer_id=$review['ID_user'];
					$reviewerQuery = "SELECT * FROM User WHERE id='$reviewer_id'";
					$reviewerResult = mysqli_query($link, $reviewerQuery) or die("Ошибка".mysqli_error($link));
					$reviewer = mysqli_fetch_assoc($reviewerResult); 

					$ratingQuery = "SELECT rating FROM Course_rating WHERE ID_user='$reviewer_id'";
					$ratingResult = mysqli_query($link, $ratingQuery) or die("Ошибка".mysqli_error($link));
					$rating = mysqli_fetch_assoc($ratingResult); 

					echo "
					<div class='slider-item'>
						<div class='slider-item-wrapper'>
							<div class='review-form'>
								<div class='review-content'>
									<div class='review-header'>
										<div class='reviewer'>
											<img src='images/users_photos/".$reviewer['photo']."' class='reviewer-img'>
											<div class='reviewer-wrapper'>
												<div class='reviewer-name'>".$reviewer['name']."
												</div>
												<div class='review-date'>".$review['reviewDateTime']."
												</div>
											</div>
										</div>
										<div class='star-rating'>
											<img src='images/rating/rating_".$rating['rating']."_stars.png'>
										</div>
									</div>
									<div class='review'>".$review['reviewText']."
									</div>
								</div>
								<div class='two-lines'></div>
							</div>
						</div>
					</div>	";	
				}
			}
		
		echo "

		<img src='../../images/scroll_arrow_2.png' class='slider-arrow desktop-slider-arrow' onclick='nextSlide()'>

		</div>

		<div class='arrows-for-mobile-slider'>
			<div class='arrows-wrapper'>
				<img src='images/scroll_arrow_1.png' class='slider-arrow' onclick='previousSlide()'>
				<img src='images/scroll_arrow_2.png' onclick='nextSlide()'>
			</div>
		</div>

	";
	?>



<script src="../../js/slider.js"></script>

