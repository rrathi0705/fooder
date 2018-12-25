<?php
   	session_start();
   	include '../includes/dbh.inc.php';
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
?>