<?php
    $logout=$_POST['log-out'];
    if(!empty($logout)){
        header('location: login.php');
    }
?>