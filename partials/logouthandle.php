<?php 
$showAlert=false;

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    include '_dbconnect.php';
    session_start();
    session_unset();
    session_destroy();
    $showAlert="You have successfully logged out";
    header("location:/forum/index.php?showAlert=$showAlert");
    
}



?>

