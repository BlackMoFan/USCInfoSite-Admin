<?php
    // session_destroy();
    // session_start();
    include("./connection.php");
    // require_once './create-table.php';
    // include("./utilities/functions.php");

    // include('./includes/functions.inc.php');

    // if(!isset($_SESSION["userid"])) {
    //     header("Location: ./LoginPage.php");
    //     die;
    // }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style/adminstyles.css" />

    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"
    />
    <title>Admin Log-in</title>
  </head>
  <body>
    <header>
      <div class="logo">
        <img src="../assets/student-council-logo.png" alt="USC logo" />
        <div class="logo-text">
          <span class="wvsuname">West Visayas State University</span>
          <span class="scname">University Student Council</span>
        </div>
      </div>
      <span class="title-text">INFOSITE ADMIN PAGE</span>
      <img src="../assets/person-icon.png" alt="person" id="person-icon" />
    </header>

    <section class="login-card">
      <span class="login-text"><strong>Log-in</strong></span>

      <form method="POST" action="./includes/login.inc.php" id="login-form">
        <div class="label-input-pair">
          <label for="username" class="login-labels">Username</label>
          <input type="text" class="login-textbox" placeholder="" name="username" />
        </div>
        <div class="label-input-pair">
          <label for="password" class="login-labels">Password</label>
          <input type="password" class="login-textbox" placeholder="" name="password" />
        </div>

        <div class="login-buttons">
          <button id="reset-btn">
            <span class="material-symbols-outlined">restart_alt</span
            ><span class="button-text">Reset</span>
          </button>
          <!-- <input type="submit" name="submit" value="Login" /> -->
          <button type="submit" name="submit">
            <span class="material-symbols-outlined">login</span
            ><span class="button-text">Login</span>
          </button>
        </div>
      </form>
    </section>
  </body>
</html>
