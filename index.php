<?php
include 'connect.php';
?>


<?php
session_start();

if(isset($_GET['logout'])){
	
	
$fp = fopen($_SESSION['name'].".html", 'a');
fwrite($fp, "<div class='msgln'>(".date("g:i A").")<i>User ". $_SESSION['name'] ." has left the chat session.</i><br></div>");
fclose($fp);

//session_destroy();

header("Location: logout.php"); //Redirect the user
}



function loginForm(){
echo'
<div id="loginform">
<form action="index.php" method="POST">
<p>Please enter your name to continue:</p>
<label for="name">Name:</label>
<input type="username" name="name" id="name" maxlength="10" title="Enter the UserName" pattern="[a-zA-Z0-9]+" required/><br>
<label for="password">Password:</label>
<input type="password" name="password" id="password" maxlength="10" title="Enter Password" pattern="[a-zA-Z0-9]+" required/><br>
<input type="hidden" name="hidden" />
<input type="submit" name="enter" id="enter" value="Enter" /><br>
<a id="signup" href="signup.php">SIGN UP</a>
</form>
</div>
';
}

if(isset($_POST['enter'])){
  if($_POST['name'] != ""){
     $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
     $_SESSION['friend']="check"; 
 }
  else{
    echo '<span class="error">Please type in a name</span>';
  }
}

?>

<?php

		if(isset($_POST['enter'])){
if($_POST['name'] != ""){
$cookie_name="user";
$cookie_value=stripslashes(htmlspecialchars($_POST['name']));
setcookie($cookie_name,$cookie_value,time()+(86400*30),"/","","",TRUE);
echo $_COOKIE[$cookie_name];		}}
?>


<!DOCTYPE html>
<html>
<head>
<title>TYPE2TALK</title>
<link type="text/css" rel="stylesheet" href="style.css" />
<link type="text/css" rel="stylesheet" href="main.css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>


</head>

<body>
<?php

if(!isset($_SESSION['name'])){

loginForm();
}

else{
?>

<div id="friendslist">

</div>

<div id="status123"style="font-family:cursive;
width:30%;
height:50%;
overflow:scroll;
background-color:gray;
float:right;

">


</div>


<div id="resizeDiv">

<div id="wrapper">
<h2 id="heading">TYPE2TALK</h2>

<div id="menu">
<p class="welcome">Welcome, <b><?php echo $_SESSION['name']; ?></b></p>
<p class="logout"><a id="exit" class="links" href="#">Exit Application</a></p>
<div style="clear:both"></div>
</div>


<div id="chatbox">
<?php
  
if(file_exists("log.html") && filesize("log.html") > 0){
    $handle = fopen("log.html", "r");
    $contents = fread($handle, filesize("log.html"));
    fclose($handle);

   // echo $contents;
}
?>
</div>

<form name="message" action="" style="width:100%">
<input name="usermsg" type="text" id="usermsg" size="63" />
<input name="submitmsg" type="submit"Â  id="submitmsg" value="Send" />
</form>

<script>

  $('#resizeDiv')

    .draggable()

    .resizable();

    $('#resizeDiv')

    .resizable({

        start: function(e, ui) {

            alert('resizing started');

        },

        resize: function(e, ui) {

         

        },

        stop: function(e, ui) {

            alert('resizing stopped');

        }

    });

 </script>



</div>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js">
</script>

<script type="text/javascript">

function linkonline(e){
	
	var x=e.innerHTML;
	      $.post("friendcode.php", {text: x});
	var y = '<?php
	echo $_SESSION["name"];
	?>';
	
	 
	 alert(x);
	 alert(y);
	

}
function linkoffline(e){
	var x=e.innerHTML;
	      $.post("friendcode.php", {text: x});
	var y = '<?php
	echo $_SESSION["name"];
	?>';
	
	 
	 alert(x);
	 alert(y);
	
	//alert('user is offline do u want to continue');
}


$(document).ready(function(){

setInterval(function(){
$('#friendslist').load('try.php');
 },500);
 
 setInterval(function(){
$('#status123').load('stat.php');
 },500);
 
//function friendlist(){
//$( "#friendslist" ).load( "try.php", function() {
  //alert( "Load was performed." );
//	});
//}

//$('a').click(function(){
	
	  //alert('hello');
//	if ( $("#friendslist").find("p")){
	//	 alert('hello');
	 //}
	 
//});


//$(function() {
	 //$('#friendslist')
      //     .html('')
        //   .load('try.php');
		//});
    //$("#friendslist. a").click(function() {
      // alert('hello');
   // });

//$(".logout").on("click", ".links", function(event){
  //  alert('gotClicked');
//});
  
   $("#exit").click(function(){
       var exit = confirm("Are you sure you want to end the session?");
	  
       if(exit==true){
		   window.location = 'index.php?logout=true';

	 }
   });


   $("#submitmsg").click(function(){
      var clientmsg = $("#usermsg").val();
      $.post("post.php", {text: clientmsg});
	  // $.post("postpost.php", {text: clientmsg});
      $("#usermsg").attr("value", "");
      return false;
   });

   setInterval (loadLog,500);
  // setInterval (friendlist, 1500);
                              


function loadLog(){
    var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20;

	
    $.ajax({ url: "<?php echo $_SESSION['name']?><?php echo $_SESSION['friend']?>.html",
             cache: false,
             success: function(html){
                $("#chatbox").html(html);
                var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
                if(newscrollHeight > oldscrollHeight){
                    $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); 
                }
             },
    });
}
});
</script>

<?php
}
?>


</body>
</html>