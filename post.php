<?php
session_start();
if(isset($_SESSION['name'])){
   $text = $_POST['text'];

   
   $name=trim($_SESSION['name']);
   $friend=trim($_SESSION['friend']);
    $filename=$name.$friend;
   $fp = fopen("$filename".".html", 'a+');
   fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
   fclose($fp);
  
 $filename1=$friend.$name;
   $fp1 = fopen("$filename1".".html", 'a+');
   fwrite($fp1, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
   fclose($fp1);
  
   
   
  // $fp = fopen("log.html", 'a');
   //fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
  // fclose($fp);
}
?>