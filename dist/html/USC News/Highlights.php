<?php

    include_once '../connection.php';
    session_start();

    if(!isset($_SESSION["userid"])) {
      header("Location: ../LoginPage.php");
      die;
    }

    if(isset($_POST['upload'])){

      //create news ID number
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
     
      $news_number = random_num(11);
      $news_type = 'highlights';
      $title = mysqli_real_escape_string($conn, $_POST['news_title']);
      $details = mysqli_real_escape_string($conn, $_POST['news_details']);
      $image = $_FILES['featured_image']['name']; 
      $date = mysqli_real_escape_string($conn, $_POST['publication_date']);
      $author = mysqli_real_escape_string($conn, $_POST['news_author']);

      $msg = '';
      $target = "./images/Highlights/".basename($_FILES['featured_image']['name']); 

      $sql =  "INSERT INTO news_information (news_number, news_type, Title, Details, Featured_Image, News_Date, Authors)
      VALUES ('$news_number', '$news_type', '$title', '$details', '$image', '$date', '$author')";

      mysqli_query($conn, $sql); // stores the submitted data into the db table - images
      // Move the uploaded image into the folder - images/news/
      if(move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
          $msg = "Image uploaded successfully";
      } else {
          $msg = "There was a problem uploading the image";
      }
    }

    if(isset($_POST['delete_news'])) {
      $news_number = mysqli_real_escape_string($conn, $_POST['delete_news']);
      // echo $officer_number;
      $query = "DELETE FROM news_information WHERE news_number='$news_number'";
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
    <title>USC News Section</title>

    <script src="../../js/uscnews.js" defer></script>
  </head>
  <body>
    <!-- Pop-up article options -->
    <section id="new-article-screen">
      <div class="cover-screen"></div>

      <form id="form-container" method="post" action="./Highlights.php" enctype="multipart/form-data">
        <div class="form-header" id="newarticle-close-form-btn">
          <span class="material-symbols-outlined"> close </span>
        </div>

        <div class="form-content">
          <div class="left-col">
            <div class="title-form">
              <label for="highlight-form">Title</label>
              <input type="text" placeholder="Enter title.." name="news_title"/>
            </div>
            <div class="details-form">
              <label for="details-form">Details</label>
              <textarea
                name="news_details"
                placeholder="Enter details.."
              ></textarea>
            </div>
          </div>

          <div class="right-col">
            <div class="featured-image">
              <label for="featured-image">Featured Image</label>
              <input
                type="file"
                name="featured_image"
                id="featured-image"
                accept="image/jpeg, image/png"
                required
              />
              <div id="featured-image-preview"></div>

              <button id="add-image">
                <span class="material-symbols-outlined" id="add-image-icon">
                  add_photo_alternate </span
                ><span>Add image</span>
              </button>

              <div class="article-data">
                <label
                  >Date
                  <input type="datetime-local" name="publication_date" id="article-date"
                /></label>

                <label
                  >Author
                  <input type="text" name="news_author" id="article-author"
                /></label>
              </div>
            </div>
            <div class="action-buttons">
              <button id="reset-article">Reset</button>
              <!-- <input id="upload-org" type="submit" name="upload" value="Upload"> -->
              <button id="upload-article" type="submit" name="upload">
                <span
                  class="material-symbols-outlined"
                  id="upload-article-icon"
                >
                  publish
                </span>
                <span>Upload</span>
              </button>
            </div>
          </div>
        </div>
      </form>
    </section>

    <!-- Edit article screen -->
    <section id="edit-article-screen">
      <div class="cover-screen"></div>

      <form id="form-container" action="">
        <div class="form-header" id="editarticle-close-form-btn">
          <span class="material-symbols-outlined"> close </span>
        </div>

        <div class="form-content">
          <div class="left-col">
            <div class="title-form">
              <label for="highlight-form">Title</label>
              <input type="text" placeholder="Enter title.." />
            </div>
            <div class="details-form">
              <label for="details-form">Details</label>
              <textarea
                name="details-form"
                placeholder="Enter details.."
              ></textarea>
            </div>
          </div>

          <div class="right-col">
            <div class="featured-image">
              <label for="featured-image">Featured Image</label>
              <input
                type="file"
                name="featured-image"
                id="featured-image"
                accept="image/*"
              />
              <div id="featured-image-preview"></div>

              <button id="add-image">
                <span class="material-symbols-outlined" id="add-image-icon">
                  add_photo_alternate </span
                ><span>Update image</span>
              </button>

              <div class="article-data">
                <label
                  >Date
                  <input type="date" name="article-date" id="article-date"
                /></label>

                <label
                  >Author
                  <input type="text" name="article-author" id="article-author"
                /></label>
              </div>
            </div>
            <div class="action-buttons">
              <button id="reset-article">Reset</button>
              <button id="save-article">
                <span class="material-symbols-outlined" id="save-article-icon">
                  save
                </span>
                <span>Save</span>
              </button>
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
        <li><a href="" class="active">USC News</a></li>
        <li>
          <a href="../Organizations/UniversityBased.php">Organizations</a>
        </li>
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
        <a class="sidebar-items active"><span>Highlights</span></a>
        <a class="sidebar-items" href="./News.php">
          <span>News</span>
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
          <article class="new-article" id="new-article-btn">
            <div class="new-article-placeholder">
              <img
                src="../../assets/new-article-placeholder.png"
                alt="placeholderimg"
              />
            </div>

            <div class="new-article-content">
              <div class="new-article-text"><span>Add new highlight</span></div>
              <span class="material-symbols-outlined new-article-plus">
                add
              </span>
            </div>
          </article>

          <!-- Start of actual articles -->
          <?php
                    // $db = mysqli_connect("localhost", "root", "", "uscbackend_db");
                    $sql = "SELECT * FROM news_information WHERE news_type='highlights'";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_array($result)) {

          ?>

          <article class="article-items" href="">
            <span class="article-title"><strong><?= $row['Title'] ?></strong></span>
            <img src="./images/Highlights/<?= $row['Featured_Image'] ?>" class="article-img" />
            <div class="article-info">
              <div class="dates">
                <div class="date-created"><?= date('d M Y', strtotime($row["News_Date"]))?></div>
                <div class="last-modified">Modified 
                <?=
                round((strtotime(date('M d, Y h:i:sa')) - strtotime(date('M d, Y h:i:sa', strtotime($row["Date_Posted"])))) / 86400)
                ?>
                days ago</div>
              </div>
              <div class="article-actions">
                <button class="edit-highlight">
                  <span class="material-symbols-outlined"> edit </span>
                </button>
                <!-- <form style="display: inline;" action="./Highlights.php" method="POST">
                  <button
                    id="delete-highlight"
                    type="submit"
                    name="delete_news"
                    value="<?= $row["news_number"] ?>"
                    onclick="confirm('Are you sure you want to delete the item <?= $row['Title'] ?>?')"
                  >
                    <span class="material-symbols-outlined"> delete </span>
                  </button>
                </form> -->
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
                        <form style="display: inline;" action="./Highlights.php" method="POST">
                          <button id="confirm-delete-btn" type="submit" name="delete_news" value="<?= $row["news_number"] ?>">Yes</button>
                        </form>
                        <button id="cancel-delete-btn">No</button>
                      </div>
                    </div>
                  </div>
                </section>
                <button
                  id="delete-article-btn"
                  type="submit"
                  name="delete_news"
                >
                  <span class="material-symbols-outlined"> delete </span>
                </button>
                <!-- <button
                  id="delete-highlight"
                  onclick="confirm('Are you sure you want to delete this highlight?')"
                >
                  <span class="material-symbols-outlined"> delete </span>
                </button> -->
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
              src="../../assets/testimg.jpg"
              alt="article image"
              class="article-img"
            />
            <div class="article-info">
              <div class="dates">
                <div class="date-created">26 Jan 2023</div>
                <div class="last-modified">Modified 1 day ago</div>
              </div>
              <div class="article-actions">
                <button id="edit-highlight">
                  <span class="material-symbols-outlined"> edit </span>
                </button>
                <button id="delete-highlight">
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

    <!-- <script src="../../js/uscnews.js"></script> -->
  </body>
</html>
