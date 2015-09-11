<?php
session_start();
$conn=new mysqli("localhost","root","","projectdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$temp1=$_SESSION['name'];
$sqlflagupdate1="UPDATE usertable SET flagtb=2 WHERE usernametb='$temp1'";
$conn->query($sqlflagupdate1);

echo 'u have been logged out';


$conn->close();
session_destroy();
header('Location: index.php');
?>