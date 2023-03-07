<?php

if(isset($_POST["submit"])) {
    $user_name = $_POST["username"];
    $password = $_POST["password"];

    include("../connection.php");

    require_once 'functions.inc.php';

    if(emptyInputLogin($user_name, $password) !== false) {
        header("Location: ../LoginPage.php?error=emptyinput");
        exit();
    }
    
    logUser($conn, $user_name, $password);

} else {
    header("Location: ../LoginPage.php");
    exit();
}

?>