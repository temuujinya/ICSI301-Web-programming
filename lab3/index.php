<?php
// include "./conf/db.php";
require_once __DIR__."/include/db.php";

$query = "select * from student";
$result = mysqli_query($db,$query);


while($student = mysqli_fetch_assoc($result)){
    echo "{$student["firstName"]} bna <br/>";
}

mysqli_close($db);
?>