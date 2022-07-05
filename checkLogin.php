<?php
    session_start();
    if(!isset($_SESSION['logged']) || !isset($_SESSION['email'])){
        header('location: main.php');
    }
?>