<?php

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "uscbackend_db";

    if(!$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){
        die("Failed to connect!");
    };

?>