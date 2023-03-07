<?php

    include_once '../connection.php';
    session_start();

    if(!isset($_SESSION["userid"])) {
      header("Location: ../LoginPage.php");
      die;
    }

    $msg = "";
    
    // if upload button is pressed
    if(isset($_POST['upload'])) {
        // the path to store the uploaded image
        $target1 = "./images/SSG/".basename($_FILES['officer_portrait']['name']);
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
        $officer_name = $_POST['officer_name'];
        $officer_organization = 'SSG';
        $officer_number = random_num(11);
        $officer_portrait = $_FILES['officer_portrait']['name'];
        $officer_position = $_POST['officer_position'];
        $officer_facebook = $_POST['officer_facebook'];
        $officer_email = $_POST['officer_email'];

        
        
        $sql = "INSERT INTO officer (officer_number, officer_name, officer_organization, officer_portrait, officer_position, officer_facebook, officer_email) VALUES ('$officer_number', '$officer_name', '$officer_organization', '$officer_portrait', '$officer_position', '$officer_facebook', '$officer_email')";
        mysqli_query($conn, $sql); // stores the submitted data into the db table - images

        // Move the uploaded image into the folder - images/officers/USC/
        if(move_uploaded_file($_FILES['officer_portrait']['tmp_name'], $target1)) {
            $msg = "Image uploaded successfully";
        } else {
            $msg = "There was a problem uploading the image";
        }
    }

    if(isset($_POST['delete_officer'])) {
      $officer_number = mysqli_real_escape_string($conn, $_POST['delete_officer']);
      // echo $officer_number;
      $query = "DELETE FROM officer WHERE officer_number='$officer_number'";
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
    <title>USC About Section - SSG</title>

    <script src="../../js/about.js" defer></script>
  </head>
</html>
<body>
  <!-- Pop-up new officer screen -->
  <section id="new-usc-officer-screen">
    <div class="cover-screen"></div>

    <form class="form-container" id="newusc-form-container" method="post" action="./SSG.php" enctype="multipart/form-data">
      <div class="form-header" id="newusc-close-form-btn">
        <span class="material-symbols-outlined"> close </span>
      </div>

      <div class="form-content">
        <div class="left-col">
          <div class="officer-details">
            <label for="full-name">Full Name</label>
            <input
              type="text"
              name="officer_name"
              id="usc-fullname"
              placeholder="First name, Middle Initial, Surname  (e.g. Jose P. Rizal)"
            />
            <label for="position">Position</label>
            <input
              type="text"
              name="officer_position"
              id="usc-position"
              placeholder="Enter position"
            />
            <label for="facebook">Facebook</label>
            <input
              type="text"
              name="officer_facebook"
              id="usc-facebook"
              placeholder="Enter facebook link"
            />
            <label for="email">E-mail</label>
            <input
              type="text"
              name="officer_email"
              id="usc-email"
              placeholder="Enter e-mail address"
            />
          </div>
        </div>

        <div class="right-col">
          <div class="officer-image">
            <label for="new-officer-image">Image</label> <br />
            <input
              type="file"
              name="officer_portrait"
              id="new-officer-image"
              accept="image/jpeg, image/png"
              required 
              
            />
            <div id="new-officer-image-preview"></div>

            <button id="add-image">
              <span class="material-symbols-outlined" id="add-image-icon">
                add_photo_alternate </span
              ><span>Add image</span>
            </button>
          </div>
          <div class="action-buttons">
            <button id="reset-uscofficer">Reset</button>
            <!-- <input id="upload-org" type="submit" name="upload" value="Upload"> -->
            <button id="upload-uscofficer" type="submit" name="upload" >
              <span class="material-symbols-outlined" id="upload-article-icon">
                publish
              </span>
              <span>Upload</span>
            </button>
          </div>
        </div>
      </div>
    </form>
  </section>

  <!-- Pop-up edit officer screen -->
  <section id="edit-usc-officer-screen">
    <div class="cover-screen"></div>

    <form class="form-container" id="editusc-form-container" action="">
      <div class="form-header" id="editusc-close-form-btn">
        <span class="material-symbols-outlined"> close </span>
      </div>

      <div class="form-content">
        <div class="left-col">
          <div class="officer-details">
            <label for="full-name">Full Name</label>
            <input
              type="text"
              name="usc-fullname"
              id="usc-fullname"
              placeholder="First name, Middle Initial, Surname  (e.g. Jose P. Rizal)"
            />
            <label for="position">Position</label>
            <input
              type="text"
              name="usc-position"
              id="usc-position"
              placeholder="Enter position"
            />
            <label for="facebook">Facebook</label>
            <input
              type="text"
              name="usc-facebook"
              id="usc-facebook"
              placeholder="Enter facebook link"
            />
            <label for="email">E-mail</label>
            <input
              type="text"
              name="usc-email"
              id="usc-email"
              placeholder="Enter e-mail address"
            />
          </div>
        </div>

        <div class="right-col">
          <div class="officer-image">
            <label for="officer-image">Image</label> <br />
            <input
              type="file"
              name="edit-officer-image"
              id="edit-officer-image"
              accept="image/*"
            />
            <div id="edit-officer-image-preview"></div>

            <button id="add-image">
              <span class="material-symbols-outlined" id="add-image-icon">
                add_photo_alternate </span
              ><span>Add image</span>
            </button>
          </div>
          <div class="action-buttons">
            <button id="reset-uscofficer">Reset</button>
            <button id="save-uscofficer">
              <span class="material-symbols-outlined" id="upload-article-icon">
                save
              </span>
              <span>Save</span>
            </button>
          </div>
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
      <a href="../includes/logout.php"><span>Log-out</span></a>
    </div>
  </header>
  <nav class="main-navigation">
    <ul>
      <li><a href="../USC News/Highlights.php">USC News</a></li>
      <li>
        <a href="../Organizations/UniversityBased.php">Organizations</a>
      </li>
      <li>
        <a href="../Transparency Reports/AccomplishmentReport.php"
          >Transparency Reports</a
        >
      </li>
      <li><a href="" class="active">About</a></li>
      <?php
        if($_SESSION['username'] === "SuperAdmin") {
          echo '<li><a href="../AddNewAdmin.php">Add New Admin Account</a></li>';
        }
      ?>
    </ul>
  </nav>
  <main>
    <aside>
      <a class="sidebar-items" href="./USC.php"><span>USC</span></a>
      <a class="sidebar-items active">
        <span>SSG</span>
      </a>
      <a class="sidebar-items" href="./Developers.php">
        <span>Developers</span>
      </a>
      <div class="sidebar-empty-space"></div>
    </aside>

    <section id="usc-list">
      <div class="news-list-header">
        <div class="layout-selector">
          <button>
            <span class="material-symbols-outlined selected"> grid_view </span>
          </button>
          <button>
            <span class="material-symbols-outlined"> view_list </span>
          </button>
        </div>
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

      <section class="articles">
        <article class="new-article" id="new-usc-btn">
          <div class="new-article-placeholder">
            <img
              src="../../assets/new-article-placeholder.png"
              alt="placeholderimg"
            />
          </div>

          <div class="new-article-content">
            <div class="new-article-text">
              <span>Add new SSG Officer</span>
            </div>
            <span class="material-symbols-outlined new-article-plus">
              add
            </span>
          </div>
        </article>

        <!-- Start of actual articles -->
        <?php
                    // $db = mysqli_connect("localhost", "root", "", "uscbackend_db");
                    $sql = "SELECT * FROM officer WHERE officer_organization='SSG'";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_array($result)) {
        ?>

        <article class="article-items" href="">
          <span class="article-title"><strong><?= $row['officer_name'] ?></strong></span>
          <img src="./images/SSG/<?= $row['officer_portrait'] ?>" class="article-img" />
          <div class="article-info">
            <div class="dates">
              <div class="date-created"><?= $row['officer_position'] ?></div>
              <div class="last-modified"></div>
            </div>
            <div class="article-actions">
              <button class="edit-highlight">
                <span class="material-symbols-outlined"> edit </span>
              </button>
              <!-- <form style="display: inline;" action="./SSG.php" method="POST">
                  <button
                    id="delete-highlight"
                    type="submit"
                    name="delete_officer"
                    value="<?= $row["officer_number"] ?>"
                    onclick="confirm('Are you sure you want to delete the item <?= $row['officer_name'] ?>?')"
                  >
                    <span class="material-symbols-outlined"> delete </span>
                  </button>
              </form> -->
              <!-- Pop up successfully deleted button -->
              <section id="success-delete-org-screen">
                  <div class="cover-screen"></div>
                  <div class="success-delete-container">
                    <div class="success-delete-header">
                      <span>Success</span>
                      <span class="material-symbols-outlined green-text">
                        check_circle
                      </span>
                    </div>
                    <div class="success-delete-content">
                      <p>Successfully deleted!</p>
                      <button id="success-delete-ok-btn" class="success-delete">OK</button>
                    </div>
                  </div>
                </section>

                <!-- Pop up confirm delete button -->
                <section id="confirm-delete-org-screen">
                  <div class="cover-screen"></div>
                  <div class="confirm-delete-container">
                    <div class="confirm-delete-header">
                      <span>Confirm Delete</span>
                      <span class="material-symbols-outlined red-text"> warning </span>
                    </div>
                    <div class="confirm-delete-content">
                      <p>Are you sure you want to delete this?</p>
                      <div class="confirm-delete-btns">
                        <form style="display: inline;" action="./SSG.php" method="POST">
                          <button id="confirm-delete-btn" type="submit" name="delete_officer" value="<?= $row["officer_number"] ?>">Yes</button>
                        </form>
                        <button id="cancel-delete-btn">No</button>
                      </div>
                    </div>
                  </div>
                </section>
                <button
                  id="delete-article-btn"
                  type="submit"
                  name="delete_officer"
                >
                  <span class="material-symbols-outlined"> delete </span>
                </button>
            </div>
          </div>
        </article>
        <?php
                    }
        ?>

        <!-- <article class="article-items" href="">
          <span class="article-title"><strong>John Doe</strong></span>
          <img src="../../assets/testimg.jpg" class="article-img" />
          <div class="article-info">
            <div class="dates">
              <div class="date-created">Vice-president</div>
              <div class="last-modified"></div>
            </div>
            <div class="article-actions">
              <button class="edit-highlight">
                <span class="material-symbols-outlined"> edit </span>
              </button>
              <button
                id="delete-highlight"
                onclick="confirm('Are you sure you want to delete this highlight?')"
              >
                <span class="material-symbols-outlined"> delete </span>
              </button>
            </div>
          </div>
        </article> -->

        <!-- End of actual articles -->
      </section>
    </section>
  </main>
  <!-- <script src="../../js/about.js"></script> -->
</body>
