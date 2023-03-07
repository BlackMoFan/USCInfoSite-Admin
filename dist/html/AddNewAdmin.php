<?php

// if(($_SESSION["username"] == "SuperAdmin") === false) {
//   header("Location: ./USC News/Highlights.php");
// }
  include("./connection.php");

  session_start();

  if(!isset($_SESSION["userid"]) && ($_SESSION["username"] != "SuperAdmin")) {
    header("Location: ./LoginPage.php");
    die;
  }

  // if upload button is pressed
  if(isset($_POST['upload'])) {
    // the path to store the uploaded image
    // $target1 = "./images/SSG/".basename($_FILES['officer_portrait']['name']);
    // $target2 = "images/featured_image/".basename($_FILES['featured_image']['name']);

    // connect to the database
    // $db = mysqli_connect("localhost", "root", "", "uscbackend_db");

    //create officer ID
    function random_num($length){
        $text = "";
        if($length < 5){
            $length = 5;
        }

        $len = rand(4, $length);

        for($i = 0; $i < $len; $i++){
            $text .= rand(0, 9);
        }

        return $text;
    }

    // get all the submitted data from the form
    $account_id = random_num(11);
    $account_type = 'RegularAdmin';
    $username = $_POST['username'];
    $new_admin_password = $_POST['password'];
    $added_date = date('F j, Y, g:i a');

    
    
    $sql = "INSERT INTO `accounts` (`id`, `account_id`, `account_type`, `username`, `admin_password`, `added_date`) VALUES ('$account_id', '$account_type', '$username', '$new_admin_password', '$added_date')";
    mysqli_query($conn, $sql); // stores the submitted data into the db table - accounts

    header("./USC News/Highlights.php");
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style/adminstyles.css" />
    <link rel="stylesheet" href="../style/index.css" />

    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"
    />
    <title>Add new Admin</title>
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
      <div class="profile">
        <?php
          echo $_SESSION["username"];
        ?>
        <img src="../assets/person-icon.png" alt="person" id="person-icon" />
        <a href="./includes/logout.php"><span>Log-out</span></a>
      </div>
    </header>
    <nav class="main-navigation">
      <ul>
        <li><a href="./USC News/Highlights.php">USC News</a></li>
        <li>
          <a href="./Organizations/UniversityBased.php">Organizations</a>
        </li>
        <li>
          <a href="./Transparency Reports/AccomplishmentReport.php"
            >Transparency Reports</a
          >
        </li>
        <li><a href="./About/USC.php">About</a></li>
        <?php
        if($_SESSION['username'] === "SuperAdmin") {
          echo '<li><a href="" class="active">Add New Admin Account</a></li>';
        }
        ?>
      </ul>
    </nav>

    <section class="login-card">
      <span class="login-text"><strong>New Admin</strong></span>  

      <form method="POST" action="./AddNewAdmin.php" id="login-form">
        <div class="label-input-pair">
          <label for="username" class="login-labels">Username</label>
          <input type="text" class="login-textbox" placeholder="" name="username" />
        </div>
        <div class="label-input-pair">
          <label for="password" class="login-labels">Password</label>
          <input type="password" class="login-textbox" placeholder="" name="password"/>
        </div>

        <div class="login-buttons">
          <button id="reset-btn">
            <span class="material-symbols-outlined">restart_alt</span
            ><span class="button-text">Reset</span>
          </button>
          <!-- <input type="submit" name="upload" value="Submit" /> -->
          <button id="login-btn" type="submit" name="upload">
            <span class="material-symbols-outlined">login</span
            ><span class="button-text">Submit</span>
          </button>
        </div>
      </form>
    </section>
  </body>
</html>
