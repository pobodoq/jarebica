<?php
    
    $dbname = "kdrvsk";
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    
    $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die(mysqli_error());
    $con->set_charset("utf8");
    
?>