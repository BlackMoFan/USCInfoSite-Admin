<?php

    include_once '../connection.php';
    session_start();

    if(!isset($_SESSION["userid"])) {
      header("Location: ../LoginPage.php");
      die;
    }

    //create organization ID
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
    
    // if upload button is pressed TO ADD ACCOMPLISHMENT REPORT
    if(isset($_POST['upload'])) {
        $msg = "";

        // get all the submitted data from the form
        $report_number = random_num(11);
        $report_type = 'AccomplishmentReport';
        $File_Name = $_POST['file-form-filename'];
        $TransparencyFile = $_FILES['new_file']['name'];
        $Date_Posted = date('F j, Y, g:i a');

        // the path to store the uploaded image
        $target = "./documentFiles/AccomplishmentReport/".basename($_FILES['new_file']['name']);
        

        $sql = "INSERT INTO transparency_reports (report_number, report_type, File_Name, TransparencyFile, Date_Posted) VALUES ('$report_number', '$report_type', '$File_Name', '$TransparencyFile', '$Date_Posted')";
        mysqli_query($conn, $sql); // stores the submitted data into the db table - transparency_reports

        // Move the uploaded image into the folder - images/University-based/logo/
        if(move_uploaded_file($_FILES['new_file']['tmp_name'], $target)) {
            $msg = "Image uploaded successfully";
        } else {
            $msg = "There was a problem uploading the image";
        }
        // echo $_FILES['new_file']['tmp_name'];
        // echo $msg;
    }

    // if delete button is pressed TO DELETE UNIVERSITY ORGANIZATION
    if(isset($_POST['delete_report'])) {
      $report_number = mysqli_real_escape_string($conn, $_POST['delete_report']);
      // echo $organization_number; //check organization number if match
      $query = "DELETE FROM transparency_reports WHERE report_number='$report_number'";
      $query_run = mysqli_query($conn, $query);

    }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../style/index.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"
    />
    <title>Transparency Reports</title>
  </head>
</html>

<body>
  <!-- Pop-up new file -->
  <section id="new-file-form">
    <div class="cover-screen"></div>
    <form action="./AccomplishmentReport.php" method="post" id="file-form-container" enctype="multipart/form-data">
      <div class="file-form-header" id="fileformnew-close-form-btn">
        <span class="material-symbols-outlined"> close </span>
      </div>
      <div class="file-form-content">
        <div class="file-form-fileoptions">
          <div class="file-form-input">
            <label for="file-form-filename">Filename</label>
            <input
              type="text"
              name="file-form-filename"
              id="file-form-filename"
            />
          </div>
          <input
              type="file"
              name="new_file"
              id="new-file"
              accept=".pdf"
          />
        </div>
        <div class="file-form-fileactions">
          <button id="reset-file-form">Reset</button>
          <!-- <input id="upload-file-form" type="submit" value="Upload" name="upload"> -->
          <button id="upload-file-form" type="submit" name="upload">
            <span class="material-symbols-outlined"> upload </span>
            Upload
          </button>
        </div>
      </div>
    </form>
  </section>

  <!-- Pop-up edit file -->
  <section id="edit-file-form">
    <div class="cover-screen"></div>
    <form action="" id="file-form-container">
      <div class="file-form-header" id="fileformedit-close-form-btn">
        <span class="material-symbols-outlined"> close </span>
      </div>
      <div class="file-form-content">
        <div class="file-form-fileoptions">
          <div class="file-form-input">
            <label for="file-form-filename">Filename</label>
            <input
              type="text"
              name="file-form-filename"
              id="file-form-filename"
              placeholder="..."
            />
          </div>
          <input
            type="file"
            name="edit-file"
            id="edit-file"
            accept="application/pdf"
          />
        </div>
        <div class="file-form-fileactions">
          <button id="reset-file-form">Reset</button>
          <button id="save-file-form">
            <span class="material-symbols-outlined"> save </span>
            Save
          </button>
        </div>
      </div>
    </form>
  </section>

  <!-- Start of actual page -->

  <header>
    <div class="logo">
      <img src="../../assets/student-council-logo.png" alt="USC logo" />
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
      <img src="../../assets/person-icon.png" alt="person" id="person-icon" />
      <span>Log-out</span>
    </div>
  </header>
  <nav class="main-navigation">
    <ul>
      <li><a href="../USC News/Highlights.php">USC News</a></li>
      <li>
        <a href="../Organizations/UniversityBased.php">Organizations</a>
      </li>
      <li><a href="" class="active">Transparency Reports</a></li>
      <li><a href="../About/USC.php">About</a></li>
      <?php
          if($_SESSION['username'] === "SuperAdmin") {
            echo '<li><a href="../AddNewAdmin.php">Add New Admin Account</a></li>';
          }
        ?>
    </ul>
  </nav>

  <main>
    <aside>
      <a class="sidebar-items active"
        ><span
          >Accomplishment <br />
          Report</span
        ></a
      >
      <a class="sidebar-items" href="./Resolution.php">
        <span>Resolution</span>
      </a>
      <a class="sidebar-items" href="./Memorandum.php">Memorandum</a>
      <a class="sidebar-items" href="./MinutesMeeting.php"
        >Minutes of the <br />
        Meeting</a
      >
      <div class="sidebar-empty-space"></div>
    </aside>

    <section id="news-list">
      <div class="news-list-header">
        <div class="empty-div"></div>
        <div class="sort-selector">
          <button class="dropdown-sort-btn">
            <span>All</span
            ><span class="material-symbols-outlined"> arrow_drop_down </span>
          </button>
          <button>
            <span class="material-symbols-outlined"> search </span>
          </button>
        </div>
      </div>

      <div class="list-and-button-container">
        <div id="list-container">
          <div class="list-header">
            <div class="list-header-name">Name</div>
            <div class="list-header-created">Created</div>
            <div class="list-header-empty"></div>
          </div>
          <div class="list-items">
            <ul>
              <?php
                      // $db = mysqli_connect("localhost", "root", "", "uscbackend_db");
                      $sql = "SELECT * FROM transparency_reports WHERE report_type='AccomplishmentReport'";
                      $result = mysqli_query($conn, $sql);
                      while($row = mysqli_fetch_array($result)) {
              ?>
              <li>
                <span class="list-item-name"><?= $row['File_Name']  ?></span>
                <span class="list-item-created">Created <?= 
                round((strtotime(date('M d, Y h:i:sa')) - strtotime(date('M d, Y h:i:sa', strtotime($row["Date_Posted"])))) / 86400)
                //date('d M. Y', strtotime($row['Added_date'])) ?> days ago</span>
                <span class="list-item-options"
                  ><button id="edit-file-btn">
                    <span class="material-symbols-outlined"> more_horiz </span>
                  </button>
                </span>
              </li>
              <?php
                      }
              ?>

              <!-- <li>
                <span class="list-item-name">Abracadabra</span>
                <span class="list-item-created">Created 2 days ago</span>
                <span class="list-item-options"
                  ><button>
                    <span class="material-symbols-outlined"> more_horiz </span>
                  </button></span
                >
              </li> -->
            </ul>
          </div>
          <div class="empty-div"></div>
        </div>

        <div class="list-add-btn">
          <button id="transparency-new-file">
            <span class="material-symbols-outlined"> add </span>
          </button>
        </div>
      </div>
    </section>
  </main>
  <script src="../../js/transparency.js"></script>
</body>
