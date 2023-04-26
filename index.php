<?php
session_start();
require("connection.php");
if($_SESSION["user_id"]==""){
  $user_id = $_SESSION['user_id'];
  header("Location: login.php");
}
$user_id = $_SESSION['user_id'];
$sql="SELECT * FROM sets WHERE `user_id` = '$user_id'";
$result = $conn->query($sql);
if (!$result) {
  die("Query failed: " . $conn->error);
}

$numRows = $result->num_rows;
$data = [];
$i=0;

while ($row = $result->fetch_assoc() or $numRows==0) {
  
  $data[] = $row["s_name"]; 
  $numRows++;
  $i++;
 
  
}
$uniqueArray = array_values(array_unique($data));


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
            <h2 class="home__title">Recommendation</h2>
            <div class="home__sets">
              
                <?php 
                $x=0;
                foreach ($uniqueArray as $value) {
                  ?>
                  <div class="home__set">
                  <h3 class="home__set-name"><?php echo $value; ?></h3>
                  <div class="home__set-images">
                  <?php
                  $sql2 = "SELECT * from sets where user_id = '$user_id' and s_name = '$value' ";
                  $result2 = $conn->query($sql2);
                  if (!$result2) {
                    die("Query failed: " . $conn->error);
                }
                  
                  $numRows2 = $result2->num_rows;
                  while ($row2 = $result2->fetch_assoc()) {
                    $c_id=$row2["c_id"];
                    $sql3="SELECT * from clothes where c_id = '$c_id'";
                    $result3 = mysqli_query($conn, $sql3);
                    $row3 = mysqli_fetch_assoc($result3);
                    ?>
                    
                    <div class="home__set-image">
                    <img src="upload_img/<?php echo $row3["image"];?>" alt="" />

                    </div>
                    <?php
                    $numRows++;
                    $x++;
                }
                ?>
                
                </div>
                </div>
                </div>
                <?php
              }
                ?>
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
              </div>
              -->
            </div>
          </div>
          
          <div class="home__content">
            <div class="home__title-button">
              <h2 class="home__title">My Collections</h2>
              <span class="home__title-create button">
                <a href="/closet/clothes.php">create new</a>

                <i class="fa-solid fa-plus"></i>
              </span>
            </div>

            <div class="home__sets">
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
