<?php
$host = "localhost";
$database = "utsweb";
$username = "root";
$password = "";
 
// Create connection
 
$conn = mysqli_connect($host, $username, $password, $database);
 
// Check connection
 
if (!$conn) {
 
    die("Connection failed: " . mysqli_connect_error());
 
}
?>