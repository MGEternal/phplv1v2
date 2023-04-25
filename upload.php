<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
session_start();
include("connection.php");

// File upload directory
$uploadDir = "upload_img/";

// Get the uploaded file details

$closer_type = $_POST["select_cate"];

$user_id = $_SESSION['user_id'];
$fileName = $_FILES["file"]["name"];
$fileTmpName = $_FILES["file"]["tmp_name"];
$fileType = $_FILES["file"]["type"];
$fileSize = $_FILES["file"]["size"];
$fileError = $_FILES["file"]["error"];

if ($fileError === 0) {
    // Move the uploaded file to the desired directory
    $uploadPath = $uploadDir . $fileName;
    if (move_uploaded_file($fileTmpName, $uploadPath)) {
        echo "File has been uploaded successfully!";
    } else {
        echo "Failed to upload file.";
    }
} else {
    echo "Error uploading file: " . $fileError;
}

$sql1 = "insert into clothes (`c_name`,`image`,`user_id`) VALUES ('$closer_type','$fileName','$user_id')";
$result = $conn->query($sql1);
if($result){
    header("Location: welcome.php");
}else{
    echo "Error: " . $sql1 . "<br>" . $conn->error;
}


}
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
    <form action="upload.php" method="post">
    <main class="main">
      <div class="container">
        <div class="upload">
          <div class="upload__form">
            <div class="upload__column"></div>
            <div class="upload__row"></div>
            <input
              type="file"
              class="upload__input"
              name="clothes-image"
              id="clothes-image"
            />
            <div class="upload__preview upload__preview-active">
              <img src="" id="imgPreview" />
            </div>
          </div>
          <div class="upload__select">
            <label for="create_name">Category</label>
            <select name="select_cate" id="cateName" class="upload__dropdown">
              <option value="something1">something1</option>
              <option value="something2">something2</option>
              <option value="something3">something3</option>
            </select>
          </div>
          <div class="upload__button button">
            <input type="submit" value="Upload Your Clothes" class="" />
            <i class="fa-solid fa-arrow-up"></i>
          </div>
        </div>
      </div>
    </main>
    </form>
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

    const formData = new FormData();
    const uploadButton = document.querySelector(".upload__button");
    const boundary = Math.random().toString().substr(2);
    uploadButton.addEventListener("click", () => {
      dropdown.classList.remove("upload__dropdown-active")
      const file = imageInput.files[0];
      if (file) {
        formData.append("image", file);
        formData.append("cate-name", selectCate.value)
        fetch("/closet/upload-php.php", {
          method: "POST",
          body: formData,
        })
          .then((response) => response.text())
          .then((data) => console.log(data))
          .catch((error) => console.error(error));
      }
    });
  </script>
</html>
