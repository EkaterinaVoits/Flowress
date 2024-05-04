<?php 

$count_lessons=$_POST["count_lessons"];

if($count_lessons) {

	$course_price=$count_lessons*150;

	if($count_lessons>=3 && $count_lessons<4){
		echo "<div class='title user-course-price' data-tooltip='Cкидка 5% от 3 уроков. Скидка 10% от 7 уроков'>Стоимость: ".($course_price*0.95)." BYN* <br>Ваша скидка: 5%
				</div>";
	} else if($count_lessons>=4) {
		echo "<div class='title user-course-price' data-tooltip='Cкидка 5% от 3 уроков. Скидка 10% от 7 уроков'>Стоимость: ".($course_price*0.9)." BYN* <br>Ваша скидка: 10%
				</div>";
	}
	else {
		echo "<div class='title user-course-price' data-tooltip='Cкидка 5% от 3 уроков. Скидка 10% от 7 уроков'>Стоимость: ".$course_price." BYN*
				</div>";
	}
}

?>