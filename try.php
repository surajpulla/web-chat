
<?php
session_start();
$conn=new mysqli("localhost","root","","projectdb");
/*if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
							} 
else echo "FRIENDS LIST DATABSE CONNECTED";
*/
$sqlcheck="SELECT * FROM usertable";
$result=$conn->query($sqlcheck);
echo '<h3>CLICK ON FRIEND TO CHAT<h3/>';


if(isset($_SESSION['name'])){

	while($row=$result->fetch_assoc()){
		//if((($_POST['name'])==$row['usernametb'])&&(($_POST['password'])==$row['passwordtb'])){
			if($_SESSION['name']!=$row['usernametb']){
				
			//if($row['flagtb']==1){
			
//echo "<br><a  href='' id='on'  onclick='linkonline(this)' style='color: green;'>".$row['usernametb']." </a>online<br>";
		//	}
			//else if($row['flagtb']==2){
			
echo "<br><a   href='' class='office' id='off' onclick='linkonline(this)' style='color: red;'>".$row['usernametb']."</a><br>";
			//}
	}
		}
	
	$conn->close();
		}
	
	if(isset($_SESSION['friend'])){
		print_r($_SESSION['friend']);
	}
?>

