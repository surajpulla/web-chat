<html>
<body>
<?php
$myfile = fopen("surajdon.html", "r") or die("Unable to open file!");
echo fread($myfile,filesize("surajdon.html"));
fclose($myfile);
?>
</body>
</html>