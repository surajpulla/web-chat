
<?php
session_start();
$conn=new mysqli("localhost","root","","projectdb");

$sqlcheck="SELECT * FROM usertable";
$result=$conn->query($sqlcheck);

echo '<h3>FRIEND STATUS<h3/>';
if(isset($_SESSION['name'])){

	while($row=$result->fetch_assoc()){
		//if((($_POST['name'])==$row['usernametb'])&&(($_POST['password'])==$row['passwordtb'])){
			if($_SESSION['name']!=$row['usernametb']){
				
			if($row['flagtb']==1){
			
echo "<br><span id='on'   style='color: green;'>".$row['usernametb']." </span>online<br>";
			}
			else if($row['flagtb']==2){
			
echo "<br><span class='office' id='off'  style='color: red;'>".$row['usernametb']."</span>offline<br>";
			}
	}
		}
	
	$conn->close();
		}
	
	
?>

