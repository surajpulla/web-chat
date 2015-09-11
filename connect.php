<?php
$temp;
$temp1;
$servernamedb="localhost";
$usernamedb="root";
$passworddb="";
$database="projectdb";

//connecting to mysql
$conn=new mysqli($servernamedb,$usernamedb,$passworddb,$database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

/*creating a databse
$sqldb="CREATE DATABASE projectdb";
if($conn->query($sqldb)==TRUE){	
 echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}
*/
//creating a table

$sqltable="CREATE TABLE IF NOT EXISTS usertable(
id INT(10) AUTO_INCREMENT PRIMARY KEY,
usernametb VARCHAR(20) NOT NULL,
passwordtb VARCHAR(20) NOT NULL,
flagtb INT(10) NOT NULL)";

if ($conn->query($sqltable) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

if(isset($_POST['signupsubmit'])){
	
$stmt=$conn->prepare("INSERT INTO  usertable(
usernametb,passwordtb,flagtb) VALUES(?,?,?)");
$stmt->bind_param("ssi",$usernametb,$passwordtb,$flagtb);

//parameters to be set
$usernametb=$_POST['usernamenew'];

$passwordtb=$_POST['passwordnew'];
$flagtb=2;
$stmt->execute();

//$usernametb="hello";
//$passwordtb="hellopas";
//$flagtb=0;
//$stmt->execute();

$stmt->close();
}
/*if(isset($_POST['enter'])){
	global $temp;
	$temp=$_POST['name'];
	echo $temp;
$sqlflagupdate="UPDATE usertable SET flagtb=1 WHERE usernametb='$temp'";

$conn->query($sqlflagupdate);
}*/
 /*if(isset($_GET['logout'])){
	 
	 global $temp1;
	 $temp1=$_POST['name'];
	 echo $temp1;
$sqlflagupdate1="UPDATE usertable SET flagtb=2 WHERE usernametb='".$temp1."'";
$conn->query($sqlflagupdate1);
}
*/
$sqlcheck="SELECT * FROM usertable";
$result=$conn->query($sqlcheck);
if(isset($_POST['enter'])){
	while($row=$result->fetch_assoc()){

		if((($_POST['name'])==$row['usernametb'])&&(($_POST['password'])==$row['passwordtb'])){
			if($row['flagtb']==2){
				
				if(isset($_POST['enter'])){
				global $temp;
				$temp=$_POST['name'];
				echo $temp;
				$sqlflagupdate="UPDATE usertable SET flagtb=1 WHERE usernametb='$temp'";
				$conn->query($sqlflagupdate);
}
				header('Location: index.php');
				$matchflag=0;
	
		break;
		}
		else if($row['flagtb']==1){
			$matchflag=2;
		break;
		}
	}
	else {$matchflag=1;}
}
	if($matchflag==1){
		
	header('Location:signup.php');
	}
	if($matchflag==2){
		
	header('Location:error.php');
	}
}
//sign up database interaction






$conn->close();
?>