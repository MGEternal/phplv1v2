<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
session_start(); // Start the session
include("connection.php");
$username = $_POST['username'];
$password = $_POST['password'];

// SQL query to retrieve user from database
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'"; // replace 'users' with your table name and 'username', 'password' with your column names

// Execute the query
$result = $conn->query($sql);

// Check for query execution errors
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Check if a user was found
if ($result->num_rows > 0) {
    // User found, perform login action (e.g., set session, redirect to home page)
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row["user_id"];
    $_SESSION['username'] = $username;
    header("Location: index.php");
} else {
    // User not found, display error message
    echo "Invalid username or password.";
    header("Location: login.php");
}

// Close the database connection
$conn->close();

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/closet/style/main.css" />
    <link rel="stylesheet" href="/closet/style/login.css" />
    <title>login</title>
  </head>
  <body>
    <main class="main">
      <div class="container">
        <div class="form">
          <h1 class="form__title">Welcome To Closet</h1>
          <form action="login.php" method="POST">
            <div class="form__inputs">
              <label for="username">Username</label>
              <input type="text" name="username" id="username" />
            </div>
            <div class="form__inputs">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" />
            </div>
            <span class="form__link"><a href="/closet/register.php">register</a></span>
            <div class="form__button button-alt">
              <input type="submit" value="Login" />
            </div>
          </form>
        </div>
      </div>
    </main>
  </body>
</html>
