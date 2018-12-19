<?php 

require "./init.php";
$programs=[];

     $res = findAllProgram();
    // var_dump($res);
    header("Content-Type: text/json");
    if($res){
        while($program = $res->fetch())
        {
            $programs["{$program["programIndex"]}"]=[
                "index"=>"{$program["programIndex"]}",
                "name"=>"{$program["programName"]}",
                "issuedDate"=>"{$program["issuedDate"]}",
            ];
        }
        echo json_encode($programs);
    }


