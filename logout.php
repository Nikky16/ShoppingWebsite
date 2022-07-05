<?php
    session_start();
    session_unset();
    session_destroy();

    if(!isset($_SESSION['logged']) || !isset($_SESSION['email'])){
        header('location: main.php');
    }
?>