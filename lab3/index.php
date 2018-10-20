<?php
// include "./conf/db.php";
require_once "./conf/db.php";

$query = "select * from student";
$result = $db->query($query);


while($student = $result->fetch_assoc()){
    echo "{$student["firstName"]} bna <br/>";
}

$db->close();

?>