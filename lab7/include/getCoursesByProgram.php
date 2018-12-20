<?php 

require "./init.php";
if(isset($_GET["program"])){
$students=[];

    $program = $_GET["program"];
     $res = findAllCoursesByProgram($program);
    // var_dump($res);
    header("Content-Type: application/JSON");
    if($res){
        while($student = $res->fetch())
        {
                $students["{$student["courseIndex"]}"]=[
                "cindex"=>"{$student["courseIndex"]}",
                "cname"=>"{$student["courseName"]}",
                "ccredit"=>"{$student["courseCredit"]}"
            ];
        }
        echo json_encode($students);
    }


}
