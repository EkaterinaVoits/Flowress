<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\connect\connect_database.php';


$count_lessons=$_POST["count_lessons"];

if($count_lessons) {

	$discountQuery = "SELECT discountPercent FROM Discount WHERE countLessons>=$count_lessons LIMIT 1";
	$discountResult = mysqli_query($link, $discountQuery) or die("Ошибка".mysqli_error($link));


	$priceCoefficientQuery = "SELECT priceCoefficient FROM Group_type WHERE groupType='Индивидуальное обучение'";
	$priceCoefficientResult = mysqli_query($link, $priceCoefficientQuery) or die("Ошибка".mysqli_error($link));


	if($discountResult && $priceCoefficientResult) {
		$discount_row = mysqli_fetch_row($discountResult);
		$discount=$discount_row[0];

		$price_coefficient_row = mysqli_fetch_row($priceCoefficientResult);
		$price_coefficient=$price_coefficient_row[0];

		//Цена урока=кол-во уроков * цена одного урока (120руб) * ценовой коэф-т (инд-е обуч-е) * скидка 
		$course_price=$count_lessons*120*$price_coefficient*(1-($discount*0.01));
		echo "
		<div class='title user-course-price'>
			<div id='course-price' style='display: none;'>".($course_price/$price_coefficient)."</div>
			<div data-tooltip='Чем больше уроков, тем больше скидка!'>Стоимость: <p id='org-course-price' class='course-price'>".$course_price."</p>BYN* </div>
			<div>Ваша скидка: ".$discount."%</div>
		</div>";
	}
}

?>