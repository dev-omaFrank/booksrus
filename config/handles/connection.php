<?php
$servername = 'localhost';
$username = 'root';
$password = '';
//create connection
$conn = mysqli_connect($servername,$username, $password, 'booksrus');
if(!$conn){
  die('connection failed:   ' . mysqli_connect_error());
}
//else {
//   echo 'connection created successfully';
// }

// create db
$sql = "CREATE DATABASE IF NOT EXISTS booksrus";
if(mysqli_query($conn,$sql)){
  // echo '</br>database created successfully</br>';
}else {
  echo "Error creating table: " . mysqli_error($conn);
}



//create table
$sql = 'CREATE TABLE IF NOT EXISTS users(
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_email VARCHAR(30) NOT NULL,
  user_password VARCHAR(30) NOT NULL,
  user_avatar VARCHAR(30) NOT NULL,
  reg_date TIMESTAMP
)';
if(mysqli_query($conn,$sql)){
  // echo '</br>database created successfully</br>';
}else {
  echo "</br>Error creating table: " . mysqli_error($conn);
}

?>