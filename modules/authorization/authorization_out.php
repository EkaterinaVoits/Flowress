<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();

unset($_SESSION['user']);
unset($_SESSION['userType']);
header('Location:/index.php');

?>