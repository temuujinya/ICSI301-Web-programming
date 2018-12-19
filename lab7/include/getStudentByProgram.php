<?php 

require "./init.php";
if(isset($_GET["program"])){
$students=[];

    $program = $_GET["program"];
     $res = findAllStudentsByProgram($program);
    // var_dump($res);
    header("Content-Type: application/JSON");
    if($res){
        while($student = $res->fetch())
        {
            $students["{$student["studentID"]}"]=[
                "fname"=>"{$student["firstName"]}",
                "lname"=>"{$student["lastName"]}",
                "gender"=>"{$student["gender"]}",
                "dob"=>"{$student["dob"]}",
                "id"=>"{$student["studentID"]}",
            ];
        }
        echo json_encode($students);
    }


}
