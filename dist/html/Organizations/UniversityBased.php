<?php

    include_once '../connection.php';
    session_start();

    if(!isset($_SESSION["userid"])) {
      header("Location: ../LoginPage.php");
      die;
    }
    
    $msg = "";

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
    
    // if upload button is pressed TO ADD UNIVERSITY ORGANIZATION
    if(isset($_POST['upload'])) {
        // the path to store the uploaded image
        $target1 = "./images/University-based/logo/".basename($_FILES['organization_logo']['name']);
        $target2 = "./images/University-based/featured_image/".basename($_FILES['featured_image']['name']);

        // get all the submitted data from the form
        $organization_name = $_POST['organization_name'];
        $organization_number = random_num(11);
        $organization_category = 'university-based';
        $organization_logo = $_FILES['organization_logo']['name'];
        $featured_image = $_FILES['featured_image']['name'];
        $organization_description = $_POST['organization_description'];
        $organization_adviser = $_POST['organization_adviser'];
        $organization_fb = $_POST['organization_fb'];
        $organization_status = $_POST['organization_status'];
        $organization_ig = $_POST['organization_ig'];
        $organization_email = $_POST['organization_email'];
        $organization_twt = $_POST['organization_twt'];
        $organization_college = $_POST['organization_college'];
        $organization_cpno = $_POST['organization_cpno'];
        $organization_added_date = date('F j, Y, g:i a');
        
        
        $sql = "INSERT INTO organizations (organization_name, organization_number, organization_category, organization_logo, featured_image, organization_description, organization_adviser, organization_fb, organization_status, organization_ig, organization_email, organization_twt, organization_college, organization_cpno, Added_date) VALUES ('$organization_name', '$organization_number', '$organization_category', '$organization_logo', '$featured_image', '$organization_description', '$organization_adviser', '$organization_fb', '$organization_status', '$organization_ig', '$organization_email', '$organization_twt', '$organization_college', '$organization_cpno', '$organization_added_date')";
        mysqli_query($conn, $sql); // stores the submitted data into the db table - images

        // Move the uploaded image into the folder - images/University-based/logo/
        if(move_uploaded_file($_FILES['organization_logo']['tmp_name'], $target1)) {
            $msg = "Image uploaded successfully";
        } else {
            $msg = "There was a problem uploading the image";
        }

        // Move the uploaded image into the folder - images/University-based/featured_image/
        if(move_uploaded_file($_FILES['featured_image']['tmp_name'], $target2)) {
            $msg = "Image uploaded successfully";
        } else {
            $msg = "There was a problem uploading the image";
        }
    }

    // if delete button is pressed TO DELETE UNIVERSITY ORGANIZATION
    if(isset($_POST['delete_organization'])) {
      $organization_number = mysqli_real_escape_string($conn, $_POST['delete_organization']);
      // echo $organization_number; //check organization number if match
      $query = "DELETE FROM organizations WHERE organization_number='$organization_number'";
      $query_run = mysqli_query($conn, $query);

    }

      //if the admin chooses to edit
    if(isset($_POST['edit-organization'])) {
      // // the path to store the uploaded image
      // $target1 = "./images/University-based/logo/".basename($_FILES['organization_logo']['name']);
      // $target2 = "./images/University-based/featured_image/".basename($_FILES['featured_image']['name']);

      // // connect to the database
      // // $db = mysqli_connect("localhost", "root", "", "uscbackend_db");
      // $organization_number = $_POST['organization_number'];
      // $old_organization_logo = $_POST['old_organization_logo'];
      // $old_featured_image = $_POST['old_featured_image'];

      // // get all the submitted data from the form
      // $organization_name = $_POST['organization_name'];
      // $organization_category = 'university-based';
      // $organization_logo = $_FILES['organization_logo']['name'];
      // $featured_image = $_FILES['featured_image']['name'];
      // $organization_description = $_POST['organization_description'];
      // $organization_adviser = $_POST['organization_adviser'];
      // $organization_fb = $_POST['organization_fb'];
      // $organization_status = $_POST['organization_status'];
      // $organization_ig = $_POST['organization_ig'];
      // $organization_email = $_POST['organization_email'];
      // $organization_twt = $_POST['organization_twt'];
      // $organization_college = $_POST['organization_college'];
      // $organization_cpno = $_POST['organization_cpno'];

      // if (empty($organization_logo) or empty($featured_image)) { //IF EMPTY LOGO OR FEATURED, THEN DON'T INCLUDE THEM IN UPDATE
      //     $sql = "UPDATE organizations SET organization_name='$organization_name',
      //  organization_description='$organization_description', 
      //  organization_adviser='$organization_adviser', organization_fb='$organization_fb',
      //  organization_fb='$organization_fb', organization_status='$organization_status',
      //  organization_ig='$organization_ig', organization_email='$organization_email',
      //  organization_email='$organization_email', organization_twt='$organization_twt',
      //  organization_college='$organization_college', organization_cpno='$organization_cpno'
      //  WHERE organization_number='$organization_number'";
      // } else { //IF NOT EMPTY THEN SET THEM USING UPDATE 
      //     $sql = "UPDATE organizations SET organization_name='$organization_name', organization_logo='$organization_logo', 
      //  featured_image='$featured_image', organization_description='$organization_description', 
      //  organization_adviser='$organization_adviser', organization_fb='$organization_fb',
      //  organization_fb='$organization_fb', organization_status='$organization_status',
      //  organization_ig='$organization_ig', organization_email='$organization_email',
      //  organization_email='$organization_email', organization_twt='$organization_twt',
      //  organization_college='$organization_college', organization_cpno='$organization_cpno'
      //  WHERE organization_number='$organization_number'";

      //     // Move the uploaded image into the folder - images
      //     if(move_uploaded_file($_FILES['organization_logo']['tmp_name'], $target1)) {
      //         $msg = "Image uploaded successfully";
      //     } else {
      //         $msg = "There was a problem uploading the image";
      //     }

      //     // Move the uploaded image into the folder - images
      //     if(move_uploaded_file($_FILES['featured_image']['tmp_name'], $target2)) {
      //         $msg = "Image uploaded successfully";
      //     } else {
      //         $msg = "There was a problem uploading the image";
      //     }

      //     //MOVE TO /del FOLDER OLD IMAGES
      //     rename('./images/University-based/logo/'.$old_organization_logo, './images/University-based/logo/del/'.$old_organization_logo.'-deleted.jpg');
      //     rename('./images/University-based/featured_image/'.$old_featured_image, './images/University-based/featured_image/del/'.$old_featured_image.'-deleted.jpg');
      // }
      
      
      // mysqli_query($conn, $sql); // stores the submitted data into the db table - images
      $organization_number = $_GET['edit_organization'];
      if($organization_number ){
        // echo $organization_number;
        die;
      } else {
        echo 'none';
      }
      

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
    <title>USC Organizations Section - University-based</title>

    <script src="../../js/organizations.js" defer></script>
  </head>
  <body>

    <!-- Pop-up new organization options -->
    <section id="new-org-screen">
      <div class="cover-screen"></div>

      <form id="org-form-container" method="post" action="./UniversityBased.php" enctype="multipart/form-data">
        <div class="org-form-header" id="neworg-close-form-btn">
          <span class="material-symbols-outlined"> close </span>
        </div>

        <div class="org-form-content">
          <div class="left-col">
            <div class="name-desc">
              <div class="org-name-pair">
                <label for="org-name">Name</label>
                <input
                  type="text"
                  name="organization_name"
                  id="org-name"
                  placeholder="Include its abbreviation e.g. University Student Council (USC)"
                />
              </div>
              <label for="org-desc">Description</label>
              <textarea
                name="organization_description"
                id="org-desc"
                placeholder="Enter description..."
              ></textarea>
            </div>

            <div class="org-action-btns">
              <button id="reset-org">Reset</button>
              <!-- <input id="upload-org" type="submit" name="upload" value="Upload"> -->
              <button id="upload-org" type="submit" name="upload">
                <span class="material-symbols-outlined"> upload </span>Upload
              </button>
            </div>
          </div>

          <div class="right-col">
            <div class="org-images">
              <div class="image-items org-logo-item">
                <label for="org-logo"><strong>Logo</strong></label>
                <input
                  type="file"
                  name="organization_logo"
                  id="org-logo"
                  accept="image/jpeg, image/png"
                  required 
                />
                <div id="org-logo-preview"></div>
                <button id="add-org-logo" class="add-image-btn">
                  <span class="material-symbols-outlined add-image-icon">
                    add_photo_alternate
                  </span>
                  <span>Add image</span>
                </button>
              </div>
              <div class="image-items featured-item">
                <label for="org-featured"
                  ><strong>Featured Image</strong></label
                >
                <input
                  type="file"
                  name="featured_image"
                  id="org-featured"
                  accept="image/jpeg, image/png"
                  required 
                />
                <div id="org-featured-preview"></div>
                <button id="add-org-highlight" class="add-image-btn">
                  <span class="material-symbols-outlined add-image-icon">
                    add_photo_alternate
                  </span>
                  <span>Add image</span>
                </button>
              </div>
            </div>
            <div class="org-fields">
              <div class="left-fields">
                <label for="org-adviser"><strong>Adviser</strong></label>
                <input
                  type="text"
                  name="organization_adviser"
                  id="org-adviser"
                  placeholder="Enter adviser/s"
                />
                <label for="org-status"><strong>Status</strong></label>
                <input
                  type="text"
                  name="organization_status"
                  id="org-status"
                  placeholder="Enter Status (e.g. Full Accredited, etc.)"
                />
                <label for="org-email"><strong>E-mail</strong></label>
                <input
                  type="text"
                  name="organization_email"
                  id="org-email"
                  placeholder="Enter e-mail"
                />
                <label for="org-college"><strong>College</strong></label>
                <input
                  type="text"
                  name="organization_college"
                  id="org-college"
                  placeholder="Enter college (e.g. College of Nursing)"
                />
              </div>
              <div class="right-fields">
                <label for="org-fb">Facebook</label>
                <input
                  type="text"
                  name="organization_fb"
                  id="org-facebook"
                  placeholder="Leave blank if none"
                />
                <label for="org-instagram">Instagram</label>
                <input
                  type="text"
                  name="organization_ig"
                  id="org-instagram"
                  placeholder="Leave blank if none"
                />
                <label for="org-twitter">Twitter</label>
                <input
                  type="text"
                  name="organization_twt"
                  id="org-twitter"
                  placeholder="Leave blank if none"
                />
                <label for="org-contactno">Contact Number</label>
                <input
                  type="text"
                  name="organization_cpno"
                  id="org-contactno"
                  placeholder="Enter number"
                />
              </div>
            </div>
          </div>
        </div>
      </form>
    </section>

    <!-- Pop-up edit organizations screen -->
    <section id="edit-org-screen">
      <div class="cover-screen"></div>

      <form id="org-form-container" action="">
        <div class="org-form-header" id="editorg-close-form-btn">
          <span class="material-symbols-outlined"> close </span>
        </div>
        
        <!-- HIDDEN INPUT TO STORE THE VALUE OF ORGANIZATION NUMBER -->
        <!-- <input type="text" id="org-number" value="" /> -->

        <div class="org-form-content">
          <div class="left-col">
            <div class="name-desc">
              <div class="org-name-pair">
                <label for="org-name">Name</label>
                <input
                  type="text"
                  name="org-name"
                  id="org-name"
                  placeholder="Include its abbreviation e.g. University Student Council (USC)"
                />
              </div>
              <label for="org-desc">Description</label>
              <textarea
                name="org-desc"
                id="org-desc"
                placeholder="Enter description..."
              ></textarea>
            </div>

            <div class="org-action-btns">
              <button id="reset-org">Reset</button>
              <input id="save-org" type="submit" name="edit" value="Save">
              <!-- <button id="save-org">
                <span class="material-symbols-outlined"> save </span>Save
              </button> -->
            </div>
          </div>

          <div class="right-col">
            <div class="org-images">
              <div class="image-items org-logo-item">
                <label for="org-logo"><strong>Logo</strong></label>
                <input
                  type="file"
                  name="org-logo"
                  id="org-logo"
                  accept="image/*"
                />
                <div id="org-logo-preview"></div>
                <button id="add-org-logo" class="add-image-btn">
                  <span class="material-symbols-outlined add-image-icon">
                    add_photo_alternate
                  </span>
                  <span>Add image</span>
                </button>
              </div>
              <div class="image-items featured-item">
                <label for="org-featured"
                  ><strong>Featured Image</strong></label
                >
                <input
                  type="file"
                  name="org-featured"
                  id="org-featured"
                  accept="image/*"
                />
                <div id="org-featured-preview"></div>
                <button id="add-org-highlight" class="add-image-btn">
                  <span class="material-symbols-outlined add-image-icon">
                    add_photo_alternate
                  </span>
                  <span>Add image</span>
                </button>
              </div>
            </div>
            <div class="org-fields">
              <div class="left-fields">
                <label for="org-adviser"><strong>Adviser</strong></label>
                <input
                  type="text"
                  name="org-adviser"
                  id="org-adviser"
                  placeholder="Enter adviser/s"
                />
                <label for="org-status"><strong>Status</strong></label>
                <input
                  type="text"
                  name="org-status"
                  id="org-status"
                  placeholder="Enter Status (e.g. Full Accredited, etc.)"
                />
                <label for="org-email"><strong>E-mail</strong></label>
                <input
                  type="text"
                  name="org-email"
                  id="org-email"
                  placeholder="Enter e-mail"
                />
                <label for="org-college"><strong>College</strong></label>
                <input
                  type="text"
                  name="org-college"
                  id="org-college"
                  placeholder="Enter college (e.g. College of Nursing)"
                />
              </div>
              <div class="right-fields">
                <label for="org-fb">Facebook</label>
                <input
                  type="text"
                  name="org-facebook"
                  id="org-facebook"
                  placeholder="Leave blank if none"
                />
                <label for="org-instagram">Instagram</label>
                <input
                  type="text"
                  name="org-instagram"
                  id="org-instagram"
                  placeholder="Leave blank if none"
                />
                <label for="org-twitter">Twitter</label>
                <input
                  type="text"
                  name="org-twitter"
                  id="org-twitter"
                  placeholder="Leave blank if none"
                />
                <label for="org-contactno">Contact Number</label>
                <input
                  type="text"
                  name="org-contactno"
                  id="org-contactno"
                  placeholder="Enter number"
                />
              </div>
            </div>
          </div>
        </div>
      </form>
    </section>

    <!-- Start of page -->
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
        <li><a href="" class="active">Organizations</a></li>
        <li>
          <a href="../Transparency Reports/AccomplishmentReport.php"
            >Transparency Reports</a
          >
        </li>
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
        <a class="sidebar-items active"><span>University-Based</span></a>
        <a class="sidebar-items" href="./CollegeBased.php">
          <span>College Based</span>
        </a>
        <div class="sidebar-empty-space"></div>
      </aside>

      <section id="news-list">
        <div class="news-list-header">
          <div class="layout-selector">
            <button>
              <span class="material-symbols-outlined selected">
                grid_view
              </span>
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

        <!-- Add new article -->

        <section class="articles">
          <article class="new-article" id="new-org-btn">
            <div class="new-article-placeholder">
              <img
                src="../../assets/new-article-placeholder.png"
                alt="placeholderimg"
              />
            </div>

            <div class="new-article-content">
              <div class="new-article-text">
                <span>Add new organization</span>
              </div>
              <span class="material-symbols-outlined new-article-plus">
                add
              </span>
            </div>
          </article>

          <!-- Start of actual articles -->
          <?php
                    // $db = mysqli_connect("localhost", "root", "", "uscbackend_db");
                    $sql = "SELECT * FROM organizations WHERE organization_category='university-based'";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_array($result)) {
          ?>

          <article class="article-items" href="">
            <span class="article-title"
              ><strong><?= $row['organization_name'] ?></strong></span
            >
            <img src="./images/University-based/logo/<?= $row['organization_logo'] ?>" class="article-img" />
            <div class="article-info">
              <div class="dates">
                <div class="date-created">
                  <!-- date('d M. Y', strtotime($row['Added_date'])) -->
                </div>
                <div class="last-modified">Modified <?= 
                round((strtotime(date('M d, Y h:i:sa')) - strtotime(date('M d, Y h:i:sa', strtotime($row["Added_date"])))) / 86400)
                //date('d M. Y', strtotime($row['Added_date'])) ?> days ago</div>
              </div>
              <div class="article-actions">
                <!-- <form action="UniversityBased.php" method="get"> -->
                  <button
                    class="edit-highlight"
                    type="submit"
                    formmethod="post"
                    name="edit_organization"
                    value="<?= $row["organization_number"] ?>"
                  >
                    <span class="material-symbols-outlined"> edit  </span>
                  </button>
                <!-- </form> -->
                <!-- <button class="edit-highlight">
                  <span class="material-symbols-outlined"> edit </span>
                </button> -->
                
                <!-- pop up successfully saved button -->
                  <section id="success-save-org-screen">
                    <div class="cover-screen"></div>
                    <div class="success-save-container">
                      <div class="success-save-header">
                        <span>Success</span>
                        <span class="material-symbols-outlined green-text">
                          check_circle
                        </span>
                      </div>
                      <div class="success-save-content">
                        <p>Successfully saved!</p>
                        <button id="success-save-ok-btn" class="success-save">OK</button>
                      </div>
                    </div>
                  </section>

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
                          <form style="display: inline;" action="./UniversityBased.php" method="POST">
                            <button id="confirm-delete-btn" type="submit" name="delete_organization" value="<?= $row["organization_number"] ?>">Yes</button>
                          </form>
                          <button id="cancel-delete-btn">No</button>
                        </div>
                      </div>
                    </div>
                  </section>
                  <button
                    id="delete-article-btn"
                    type="submit"
                    name="delete_organization"
                  >
                    <span class="material-symbols-outlined"> delete </span>
                  </button>
                

                <button class="highlight-profile">
                  <span class="material-symbols-outlined"> person </span>
                </button>
              </div>
            </div>
          </article>

          <?php
                    }
          ?>

          <!-- <article class="article-items" href="">
            <span class="article-title"
              ><strong>ang lero ni leroy ay rolex </strong></span
            >
            <img
              src="../InfoSite/dist/assets/testimg.jpg"
              alt="article image"
              class="article-img"
            />
            <div class="article-info">
              <div class="dates">
                <div class="status-text">26 Jan 2023</div>
                <div class="org-status">Modified 1 day ago</div>
              </div>
              <div class="article-actions">
                <button id="edit-org">
                  <span class="material-symbols-outlined"> edit </span>
                </button>
                <button id="delete-org">
                  <span class="material-symbols-outlined"> delete </span>
                </button>
                <button id="highlight-profile">
                  <span class="material-symbols-outlined"> person </span>
                </button>
              </div>
            </div>
          </article> -->

          <!-- End of actual articles -->
        </section>
      </section>
    </main>

    <!-- <script src="../../js/organizations.js"></script> -->
  </body>
</html>
