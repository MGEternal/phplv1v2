<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    include("connection.php");

$user_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents('php://input'), true);
$items = $data['itemsID'];
$name = $data['name'];
foreach ($items as $itemID) {
    echo $itemID;


    $sql1 = "insert into sets (`s_name`,`c_id`,`user_id`) VALUES ('$name','$itemID','$user_id')";
    $result = $conn->query($sql1);
  if($result){
      echo 'Items ID' . $itemID . 'Have added to the server <br>' ;
  }else{
      echo "Error: " . $sql1 . "<br>" . $conn->error;
  }

}






}
?>