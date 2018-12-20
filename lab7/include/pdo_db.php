<?php

$con = "mysql:host=localhost;dbname=lab7;charset=utf8mb4";

try{
    $pdo = new PDO($con, "root", "");
}catch(Exception $e){
    error_log($e->getMessage());
    exit("not connecting db pdo");
}


	function find_course_enrollment_by_student_and_course_id($s_id, $c_id)
	{
		global $pdo;
		
		$result = $pdo->prepare('SELECT * FROM coursetakenhistory WHERE studentID = :s_id AND courseIndex = :c_id LIMIT 1');
		$result->execute([':s_id' => $s_id, ':c_id' => $c_id ]);

		return $result->fetch();
	}


	function delete_course_enrollment_by_student_and_course_id($s_id, $c_id)
	{
		global $pdo;
		
		$pdo->prepare('DELETE FROM coursetakenhistory WHERE studentID = :s_id AND courseIndex = :c_id LIMIT 1')->execute([':s_id' => $s_id, ':c_id' => $c_id ]);
	}
