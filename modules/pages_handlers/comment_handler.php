
<link rel="stylesheet" href="../../css/slider_style.css" type="text/css">	

<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\connect\connect_database.php';

if(isset($_POST["review"])) {

	$id_user=$_SESSION['user']['id'];
	$id_course=$_SESSION['id_course'];
	$review = $_POST["review"];	
	$date_review=date("Y-m-d H:i:s"); 
	$rating=$_POST['lips_rating_id'];

	$addReviewQuery = "INSERT INTO Course_review(ID_user, ID_course, reviewText, reviewDateTime) VALUES ('$id_user','$id_course', '$review','$date_review')";
	$result = mysqli_query($link, $addReviewQuery) or die("Ошибка".mysqli_error($link));

	$addCourseRatingQuery = "INSERT INTO Course_rating(ID_user, ID_course, rating) VALUES ('$id_user', '$id_course', '$rating')";
	$addCourseRatingResult = mysqli_query($link, $addCourseRatingQuery) or die("Ошибка".mysqli_error($link));

	require '../page_elements/reviews_slider.php';
	
	/*$reviewQuery = "SELECT * FROM Course_review WHERE ID_course='$id_course'";
	$result_review = mysqli_query($link, $reviewQuery) or die("Ошибка".mysqli_error($link));
	$reviews = mysqli_num_rows($result_review);*/

/*	if($result_review) {
		if($reviews) {
			for($i = 0; $i < $reviews; ++$i) 
			{
				$review = mysqli_fetch_row($result_review); 

				$revier_id=$review[1];
				$revierQuery = "SELECT * FROM User WHERE id='$revier_id'";
				$result_revier = mysqli_query($link, $revierQuery) or die("Ошибка".mysqli_error($link));
				$revier = mysqli_fetch_row($result_revier); 

				echo "<div class='review-item'>";
				echo "<div class='revier'>";
				echo "<img src='img/".$revier[2]."' class='revier-img'>";
				echo "<div>";
				echo "<div class='revier-name'>".$revier[1]."</div>";
				echo "<div class='review-date'>".$review[5]."</div>";
				echo "</div>";
				echo "</div>";
				echo "<div class='review-text'>".$review[4]."</div>";
				echo "</div>";
			}
		} else {
			echo "<div class='no-reviews'>Комментариев пока нет. Оставьте отзыв первым!!!</div>";
		}
		mysqli_free_result($result_review);
		
	}*/
}

?>