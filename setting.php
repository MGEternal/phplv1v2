<?php
session_start();
include("connection.php");
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$sql="select * from users where user_id = '$user_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
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
    <link rel="stylesheet" href="/closet/style/setting.css" />
     

    <title>upload</title>
  </head>
  <body>
    <header class="header">
      <nav class="nav">
        <div class="nav__icon"><h1>closet</h1></div>
        <ul class="nav__items">
          <li class="nav__item">
            <a href="/closet/"><i class="fa fa-house"></i></a>
          </li>
          <li class="nav__item">
            <a href="/closet/clothes.php"><i class="fa-solid fa-shirt"></i></a>
          </li>
          <li class="nav__item">
            <a href="/closet/upload.php"
              ><i class="fa-solid fa-cloud-arrow-up"></i
            ></a>
          </li>
          <li class="nav__item nav__item-active">
            <a href="/closet/setting.php"><i class="fa-solid fa-gear"></i></a>
          </li>
        </ul>
      </nav>
    </header>
    <main class="main">
      <div class="container">
        <div class="setting">
          <div class="setting__items">
            <div class="setting__item">
              <h2 class="setting__item-title">Username</h2>
              <p class="setting__item-subtitle"><?php echo $username; ?></p>
            </div>
            <div class="setting__item">
              <h2 class="setting__item-title">Email</h2>
              <p class="setting__item-subtitle"><?php echo $row["email"]; ?></p>
            </div>
          </div>
          <div class="setting__logout">
            <a href="logout.php">LOGOUT</a>
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
