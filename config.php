<?php
$servername = "localhost";
$username = "root";
$password = "root";
$db = "my_proj_db";
// Create connection
$connection = mysqli_connect($servername, $username, $password, $db);
// Check connection
if (!$connection) {
   die("Connection failed: " . mysqli_connect_error());
}
?>