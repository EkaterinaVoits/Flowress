<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';

require_once __DIR__ .'../../../../mail/vendor/autoload.php';
$settings = require_once __DIR__ .'../../../../mail/settings.php';
require_once __DIR__ .'../../../../mail/functions.php';

$reg_status_id=$_POST['reg_status'];
$id_status_select=$_POST['id_status_select'];

$query = "UPDATE Course_registration SET ID_status = $reg_status_id WHERE Course_registration.ID = $id_status_select";
$result = mysqli_query($link, $query) or die("Ошибка " .
    mysqli_error($link));

if ($result) {
    $query2 = "SELECT * FROM Status WHERE Status.ID=$reg_status_id";
    $result2 = mysqli_query($link, $query2) or die("Ошибка".mysqli_error($link));

    $row = mysqli_fetch_row($result2); 
    $status=$row[1];

    $findQuery = "SELECT Organized_course.ID as id_orgCourse, Organized_course.startDate, User.name, Course.title, Course.price, Group_type.groupType, Group_type.priceCoefficient, Course_registration.ID_user as user_id FROM Course_registration JOIN Organized_course ON Course_registration.ID_organizedCourse=Organized_course.ID JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Course_registration.ID='$id_status_select'";
    $findResult = mysqli_query($link, $findQuery) or die("Ошибка " . mysqli_error($link));

    if($findResult){
        $org_course = mysqli_fetch_assoc($findResult);
        $id_orgCourse = $org_course['id_orgCourse'];
        $user_id = $org_course['user_id'];

        $query2 = "SELECT email FROM User WHERE ID='$user_id'";
		$result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));

		if($result2){
			$user=mysqli_fetch_row($result2);
			$email_user=$user[0];
		}

        $scheduleQuery = "SELECT * FROM Courses_schedule JOIN DateTime_class ON Courses_schedule.ID_dateTimeClass=DateTime_class.ID  WHERE Courses_schedule.ID_organizedCourse=$id_orgCourse";
        $scheduleResult = mysqli_query($link, $scheduleQuery) or die("Ошибка".mysqli_error($link));

        $course_shedule= "";
        if($scheduleResult) 
        {   
            $rows3 = mysqli_num_rows($scheduleResult);
            for($s = 0; $s < $rows3; ++$s) 
            {
                $schedule = mysqli_fetch_assoc($scheduleResult); 
                $course_shedule.=" ".$schedule['day']."-".date('H:i', strtotime($schedule['time']))."\n ";
            }
            mysqli_free_result($scheduleResult);
        }

        $body="<h2>Статус заявки на ".$org_course['title']." изменён на «‎".$status."»</h2>\n
	    <b>Начало курса: </b>".date('d.m.Y', strtotime($org_course['startDate']))."<br>
	    <b>График: </b>".$course_shedule."\n
	    <b>Преподаватель: </b>".$org_course['name']."<br>
	    <b>Группа: </b>".$org_course['groupType']."<br>
	    <b>Стоимость: </b>".($org_course['price']*$org_course['priceCoefficient'])." BYN.<br><br>
	    
	    Посмотреть подробности о курсе можно на сайте Flowress.by<br>
	    Связаться с нами можно по почте Flowress_beauty_school@gmail.com и по номеру телефона +375 (29) 632-14-22 <br>
	    <br><br>

	    Благодарим, что выбрали нас!";

	    send_mail($settings['mail_settings_prod'], [$email_user], 'Письмо с сайта Flowress', $body);
    } 
}

echo "<div class='course_status col-2' id='course_status".$id_status_select."'>".$status."</div>";

?>

 