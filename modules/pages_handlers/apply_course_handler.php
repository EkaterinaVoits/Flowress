<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\connect\connect_database.php';

require_once __DIR__ .'../../../mail/vendor/autoload.php';
$settings = require_once __DIR__ .'../../../mail/settings.php';
require_once __DIR__ .'../../../mail/functions.php';


if(isset($_SESSION['user']['id'])) {

	$id_orgCourse=$_POST["id_org_course"];
	$id_user=$_SESSION['user']['id'];
    $email_user=$_SESSION['user']['email'];

	$query = "SELECT * FROM Course_registration WHERE ID_user='$id_user' AND ID_organizedCourse='$id_orgCourse'";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

    if($result) {
    	$reserve = mysqli_fetch_assoc($result);

    	//Такой записи нет
    	if (mysqli_num_rows($result) == 0) {
    		
    		$query = "INSERT INTO Course_registration (ID_user, ID_organizedCourse, ID_status) VALUES ($id_user, $id_orgCourse, 1)";
        	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

            $findQuery = "SELECT Organized_course.startDate, User.name, Course.title, Course.price, Group_type.groupType, Group_type.priceCoefficient FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID JOIN Master ON Organized_course.ID_master=Master.ID JOIN User ON User.ID=Master.ID_user JOIN Group_type ON Organized_course.ID_groupType=Group_type.ID WHERE Organized_course.ID='$id_orgCourse'";
            $findResult = mysqli_query($link, $findQuery) or die("Ошибка " . mysqli_error($link));

            if($findResult){
                $org_course = mysqli_fetch_assoc($findResult);

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

                $body="<h2>Ваша заявка на ".$org_course['title']." отправлена</h2>\n
                <b>Начало курса: </b>".date('d.m.Y', strtotime($org_course['startDate']))."<br>
                <b>График: </b>".$course_shedule."\n
                <b>Преподаватель: </b>".$org_course['name']."<br>
                <b>Группа: </b>".$org_course['groupType']."<br>
                <b>Стоимость: </b>".($org_course['price']*$org_course['priceCoefficient'])." BYN.<br><br>
                
                Отменить заявку можно в Вашем личном кабинете.<br>
                Посмотреть подробности о курсе можно на сайте Flowress.by<br>
                Связаться с нами можно по почте Flowress_beauty_school@gmail.com и по номеру телефона +375 (29) 632-14-22 <br>
                <br><br>

                Благодарим, что выбрали нас!";

                send_mail($settings['mail_settings_prod'], [$email_user], 'Письмо с сайта Flowress', $body);
            }

        	$status_id="заявка отправлена";
    	} 

        echo "<div class='status'>".$status_id."</div>";

    }
} 
?>