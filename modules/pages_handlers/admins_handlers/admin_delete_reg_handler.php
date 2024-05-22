<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';

$reg_id=$_POST['reg_id'];

$dropQuery = "DELETE FROM Course_registration WHERE Course_registration.ID = $reg_id";
$resultDrop = mysqli_query($link, $dropQuery) or die("Ошибка " .
    mysqli_error($link));

$query = "SELECT Course_registration.ID, User.email, Organized_course.ID, Course.title, Status.ID, Status.status FROM Course_registration JOIN User ON Course_registration.ID_user=User.ID JOIN Organized_course ON Course_registration.ID_organizedCourse=Organized_course.ID JOIN Course ON Organized_course.ID_course=Course.ID JOIN Status ON Course_registration.ID_status=Status.ID ORDER BY Course_registration.ID DESC";                                

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

if($result) {
    $rows = mysqli_num_rows($result);
    if($rows>0) {
        for($i = 0; $i < $rows; ++$i)
        {
            $row = mysqli_fetch_row($result); 
            echo "<div class='row row-margin'>
            <div class='reg_id col-1'>".$row[0]."</div>
            <div class='client_email col-2'>".$row[1]."</div>
            <div class='course_id col-1'>".$row[2]."</div>
            <div class='course_name col-2'>".$row[3]."</div>
            <div class='course_status col-2' id='course_status".$row[4]."'>".$row[5]."</div>";

            $statusQuery = "SELECT * FROM Status";
            $statusResult = mysqli_query($link, $statusQuery) or die("Ошибка".mysqli_error($link));
            echo "<select name='status-select' id='".$row[0]."' class='status_select col-2'>";

            if($statusResult)
            {
                $rows2 = mysqli_num_rows($statusResult);
                echo "<option value='no_status'></option>";
                for($j = 0; $j < $rows2; ++$j)
                {
                    $row2 = mysqli_fetch_row($statusResult); 
                    echo "<option value='".$row2[0]."'>".$row2[1]."</option>";
                }
            }

            echo "</select>
            <div class='col-2'><button class='del-reg-btn admin-btn' id='".$row[0]."'>Удалить</button>
            </div></div>";
        }
    }
}
?>
<script src="../../js/jquery-3.4.1.min.js"></script>
<script src="../../js/main.js"></script>
<script src="../../js/adminPanel.js"></script>