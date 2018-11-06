<?php 
setcookie("studentID","");
unset($_COOKIE["studentID"]);
header("location: ./index.php")
?>