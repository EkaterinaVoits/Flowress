<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '..\..\..\connect\connect_database.php';

$master_id=$_POST['master_id'];

$masterCoursesQuery = "SELECT Course.title, Course.ID, Organized_course.startDate FROM Organized_course JOIN Course ON Organized_course.ID_course=Course.ID WHERE Organized_course.ID_master=$master_id";
$resultMasterCourses = mysqli_query($link, $masterCoursesQuery) or die("Ошибка " . mysqli_error($link));

if($resultMasterCourses) {
    $rows = mysqli_num_rows($resultMasterCourses);
    
    if($rows>0) {
        echo "<div class='cant-del-msg'>Невозможно удалить мастера c ID=".$master_id." , так как он проводит ".mysqli_num_rows($resultMasterCourses)." курс(а): ";

        for($i = 0; $i < $rows; ++$i)
        {
            $row = mysqli_fetch_row($resultMasterCourses); 
            echo "<div style='color:red'> - ".$row[0]." (ID курса: ".$row[1].", дата начала: ".$row[2].")</div>";

        }

        echo "</div>";
        require '..\..\page_elements\admin_tables\masters_body_table.php';

    } else {
        $dropQuery = "DELETE FROM Master WHERE Master.ID = $master_id";
        $resultDrop = mysqli_query($link, $dropQuery) or die("Ошибка " . mysqli_error($link));

        require '..\..\page_elements\admin_tables\masters_body_table.php';
    }

   
}






?>

<script src="../../js/jquery-3.4.1.min.js"></script>
<script src="../../js/main.js"></script>