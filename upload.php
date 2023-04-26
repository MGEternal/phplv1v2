<?php
session_start();
include("connection.php");

if(isset($_POST["upload"])){
// File upload directory
$uploadDir = "upload_img/";

$closer_type = $_POST["select_cate"];
$user_id = $_SESSION['user_id'];
$fileName = $_FILES["clothes-image"]["name"];
$fileTmpName = $_FILES["clothes-image"]["tmp_name"];
$fileType = $_FILES["clothes-image"]["type"];
$fileSize = $_FILES["clothes-image"]["size"];
$fileError = $_FILES["clothes-image"]["error"];

// Get the file extension
$fileExt = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));

// Check if the file extension is allowed
$allowedExt = array("jpg", "jpeg", "png");
if(!in_array($fileExt, $allowedExt)){
    echo '<script language="javascript">alert("Error: Invalid file type. Only JPG, JPEG, and PNG files are allowed.")</script>';
    header("upload.php");

}
else{

$sql1 = "insert into clothes (`c_type`,`image`,`user_id`) VALUES ('$closer_type','$fileName','$user_id')";
$result = $conn->query($sql1);
if($result){
  echo '<script language="javascript">alert("Upload Success")</script>';
}else{
    echo "Error: " . $sql1 . "<br>" . $conn->error;
}

$uploadPath = $uploadDir . $fileName;
move_uploaded_file($fileTmpName, $uploadPath);

}
}

$sql2 = "select * from sets ";


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
    <link rel="stylesheet" href="/closet/style/upload.css" />
    <title>upload</title>
  </head>
  <body>
    <header class="header">
      <nav class="nav">
        <div class="nav__icon"><h1>CLOSET</h1></div>
        <ul class="nav__items">
          <li class="nav__item">
            <a href="/closet/"><i class="fa fa-house"></i></a>
          </li>
          <li class="nav__item">
            <a href="/closet/clothes.php"><i class="fa-solid fa-shirt"></i></a>
          </li>
          <li class="nav__item nav__item-active">
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
    <div class="upload">
      <form  action="upload.php" method="post" enctype="multipart/form-data">
        <div class="upload__form">
          <div class="upload__column"></div>
          <div class="upload__row"></div>
          <input type="file" class="upload__input" name="clothes-image" id="clothes-image"/>
          <div class="upload__preview upload__preview-active">
            <img src="" id="imgPreview"/>
          </div>
        </div>
        <div class="upload__select">
          <label for="create_name">Category</label>
          <select name="select_cate" id="cateName" class="upload__dropdown">
            <option value="hat">hat</option>
            <option value="shirts">shirts</option>
            <option value="Pants">Pants</option>
            <option value="Shoes">Shoes</option>
          </select>
        </div>
        <div class="upload__button button">
          <input type="submit" value="Upload Your Clothes" name="upload"/>
          <i class="fa-solid fa-arrow-up"></i>
        </div>
      </form>
    </div>
  </div>
</main>
    <script
      src="https://kit.fontawesome.com/508d35aa0b.js"
      crossorigin="anonymous"
    ></script>

    <footer></footer>
  </body>
  <script>
    const imageInput = document.getElementById("clothes-image");
    const imagePreview = document.getElementById("imgPreview");
    const dropdown = document.querySelector(".upload__select");
    const selectCate = document.getElementById("cateName");

    imageInput.addEventListener("change", function () {
      dropdown.classList.add("upload__dropdown-active")
      const file = this.files[0];
      const reader = new FileReader();

      reader.addEventListener("load", function () {
        imagePreview.src = reader.result;
      });

      imagePreview.classList.add("upload__preview-active");

      if (file) {
        reader.readAsDataURL(file);
      } else {
        imagePreview.src = "";
      }
    });


  </script>
</html>