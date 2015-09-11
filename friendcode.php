<?php
session_start();
if(isset($_SESSION['name'])){
$_SESSION['friend']=$_POST['text'];

}
?>