<?php 

//check if the username already exists in the db
function uidExists($conn, $user_name) {
    //create sql query
    $sql = "SELECT * FROM accounts WHERE username = ?;";
    //declare php statement for secure storing of user data
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../AddNewAdmin.php?error=stmtfailed");
        exit();
    }
    //bind the variables to the statement
    mysqli_stmt_bind_param($stmt, "s", $user_name);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

//check if any field is empty -> then throw error
function emptyInputLogin($user_name, $password) {
    $result;
    if(empty($user_name) || empty($password)) {
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

//log user
function logUser($conn, $username, $password) {
    $uidExists = uidExists($conn, $username);

    // if username or email does not exist
    if($uidExists === false) {
        header("Location: ../LoginPage.php?error=wronglogin");
        exit();
    }

    //check password
    $checkPwd = ($uidExists["admin_password"] === $password);
    // //check hashed password
    // $pwdHashed = $uidExists["password"];
    // //unhash the hashed password
    // $checkPwd = password_verify($password, $pwdHashed);

    // if not match
    if($checkPwd === false) {
        //send back to login page with error of wronglogin
        header("Location: ../LoginPage.php?error=wronglogin");
        exit();
    } else if($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["account_id"];
        $_SESSION["username"] = $uidExists["username"];
        
        header("Location: ../USC News/Highlights.php");
        // header("Location: ../Organizations/UniversityBased.php");
        exit();
    }
}

?>