<?php
session_start();
require("connection.php");
if($_SESSION["user_id"]==""){
  $user_id = $_SESSION['user_id'];
  header("Location: login.php");
}
$user_id = $_SESSION['user_id'];


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/closet/style/navbar.css" />
    <link rel="stylesheet" href="/closet/style/main.css" />
    <link rel="stylesheet" href="/closet/style/home.css" />
    <title>home</title>
  </head>
  <body>
    <header class="header">
      <nav class="nav">
        <div class="nav__icon"><h1>CLOSET</h1></div>
        <ul class="nav__items">
          <li class="nav__item nav__item-active">
            <a href="/"><i class="fa fa-house"></i></a>
          </li>
          <li class="nav__item">
            <a href="/closet/clothes.php"><i class="fa-solid fa-shirt"></i></a>
          </li>
          <li class="nav__item">
            <a href="/closet/upload.php"
              ><i class="fa-solid fa-cloud-arrow-up"></i
            ></a>
          </li>
          <li class="nav__item">
            <a href="/closet/setting.php"><i class="fa-solid fa-gear"></i></a>
          </li>
        </ul>
      </nav>
    </header>
    <main class="main">
      <div class="container">
        <div class="home">
          <div class="home__content">
          <h2 class="home__title">My Collections</h2>
            
            <div class="home__sets">
              
                
                <!--
                <h3 class="home__set-name">Set 1</h3>
                <div class="home__set-images">
                  <div class="home__set-image">
                    <img src="/closet/photo-1600269452121-4f2416e55c28.webp" alt="" />
                  </div>
                  <div class="home__set-image">
                    <img src="/closet/photo-1600269452121-4f2416e55c28.webp" alt="" />
                  </div>
                  <div class="home__set-image">
                    <img src="/photo-1600269452121-4f2416e55c28.webp" alt="" />
                  </div>
                  <div class="home__set-image">
                    <img src="/photo-1600269452121-4f2416e55c28.webp" alt="" />
                  </div>
                </div>
              </div>

              <div class="home__set">
                  <h3 class="home__set-name">Set 1</h3>
                <div class="home__set-images">

                  <div class="home__set-image">
                    <img src="/photo-1600269452121-4f2416e55c28.webp" alt="" />
                  </div>
                  <div class="home__set-image">
                    <img src="/photo-1600269452121-4f2416e55c28.webp" alt="" />
                  </div>
                  <div class="home__set-image">
                    <img src="/photo-1600269452121-4f2416e55c28.webp" alt="" />
                  </div>
                  <div class="home__set-image">
                    <img src="/photo-1600269452121-4f2416e55c28.webp" alt="" />
                  </div>

                </div>
              </div>

              <div class="home__set">
                <h3 class="home__set-name">Set 1</h3>
                <div class="home__set-images">
                  <div class="home__set-image">
                    <img src="/photo-1600269452121-4f2416e55c28.webp" alt="" />
                  </div>
                  <div class="home__set-image">
                    <img src="/photo-1600269452121-4f2416e55c28.webp" alt="" />
                  </div>
                  <div class="home__set-image">
                    <img src="/photo-1600269452121-4f2416e55c28.webp" alt="" />
                  </div>
                  <div class="home__set-image">
                    <img src="/photo-1600269452121-4f2416e55c28.webp" alt="" />
                  </div>
                </div>
              
              -->
              </div>
            </div>
          </div>
          <div class="container">
          <div class="home__content">
            <div class="home__title-button">
            <h2 class="home__title">Recommendation</h2>
              <span class="home__title-create button">
                <a href="/closet/clothes.php">create new</a>

                <i class="fa-solid fa-plus"></i>
              </span>
            </div>

            <div class="home__sets">
              <div class="home__set">
                <h3 class="home__set-name">Set 1</h3>
                <div class="home__set-images">
                  <?php 
                  $sql4 = "select * from clothes where user_id = '$user_id'";
                  $result4 = $conn->query($sql4);
                  if (!$result4) {
                    die("Query failed: " . $conn->error);
                }
                  
                  $numRows4 = $result4->num_rows;
                  
                  while ($row4 = $result4->fetch_assoc()) {
                    $randomNumber = random_int(1, 2);
                    if($randomNumber==2){
                      ?>
                       <div class="home__set-image">
                       <img src="upload_img/<?php echo $row4["image"];?>" alt="" />
                      </div>
                      <?php
                      }
                  }
                  ?>
                 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script
      src="https://kit.fontawesome.com/508d35aa0b.js"
      crossorigin="anonymous"
    ></script>

    <footer></footer>
  </body>
</html>
