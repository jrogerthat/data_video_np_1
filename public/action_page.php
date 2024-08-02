<?php

//echo $_POST["firstname"];
//echo $_POST["lastname"];

$filename = "outputs/" . $_POST["postid"].".txt";

$myfile = fopen($filename, "a+") or die("couldn't open"); 
//fwrite($myfile, $_POST["firstname"]);
//fwrite($myfile, $_POST["lastname"]);
fwrite($myfile, $_POST["data"]);
fwrite($myfile, "\n");
fclose($myfile);
?>
