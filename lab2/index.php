<?php
  include 'functions.php';

$courses = [
  "ICSI201"=>[
    "name"=>"Объект хандалтат програмчлал",
    "ID"=>"ICSI201",
    "credit"=>3
  ],
  "ICSI202"=>[
    "name"=>"WOW32",
    "ID"=>"ICSI202",
    "credit"=>3
  ],
  ];


$students = array(
  "16b1seas3369"=>array(
    "fname"=>"Steve",
    "lname"=>"Jobs",
    "sisiID"=>"16b1seas3369",
    "program"=>"SE",
    "courses"=>[]
  ),
  "16b1seas3370"=>array(
    "fname"=>"Bill",
    "lname"=>"Gates",
    "sisiID"=>"16b1seas3370",
    "program"=>"SE",
    "courses"=>[]
  ),
  "16b1seas3371"=>array(
    "fname"=>"Zuckerberg",
    "lname"=>"Mark",
    "sisiID"=>"16b1seas3371",
    "program"=>"SE",
    "courses"=>[]
  ),
  "16b1seas3372"=>array(
    "fname"=>"Амархүү",
    "lname"=>"Ган-Эрдэнэ",
    "sisiID"=>"16b1seas3372",
    "program"=>"SE",
    "courses"=>[]
  ),
  "16b1seas3373"=>array(
    "fname"=>"Явуухулан",
    "lname"=>"Эрдэнэ",
    "sisiID"=>"16b1seas3373",
    "program"=>"SE",
    "courses"=>[]
  ),
  "16b1seas3373"=>array(
    "fname"=>"Нисдэг луу",
    "lname"=>"Артан-Эрдэнэ",
    "sisiID"=>"16b1seas3373",
    "program"=>"SE",
    "courses"=>[]
  ),
  "16b1seas3373"=>array(
    "fname"=>"Абуу",
    "lname"=>"Ястай",
    "sisiID"=>"16b1seas3373",
    "program"=>"SE",
    "courses"=>[]
  ),
);

array_push($students["16b1seas3369"]["courses"],"ICSI201");
array_push($students["16b1seas3370"]["courses"],"ICSI201");
var_dump($students);



if(isset($_GET["searchStudentByLname"])){
  $studentName =$_GET["searchStudentByLname"];
  $foundStudents=findStudentByName($students,$studentName);
  if($foundStudents!=0)displayStudentsInformation($foundStudents,$courses);  
}

if(isset($_POST["displayAllStudents"])){
  $displayAllStudents=$_POST["displayAllStudents"];
  displayStudentsInformation($students,$courses);
}


?>

<form action="#" method="get">
  <input name="searchStudentByLname" type="text"/>
  <button>Find</button>
</form>


<form action="#" method="post">
  <button name="displayAllStudents">Display</button>
</form>

<h2>Хичээл нэмэх</h2>

  <?php

  // if(isset($_POST["coursesID"])){
  //   var_dump($_POST["coursesID"]);
  // }

  if(isset($_GET["studenIdChoice"]) && isset($_GET['coursesID'])){
    $newStudents=addCoursesIntoStudent($students, $_GET["studenIdChoice"],$_GET['coursesID'],$courses);
  }
  ?>

<form action="#" method="get">
  <label for="studenIdChoice">SISI ID оруулна уу:</label>
  <input list="studentIdList" id="studenIdChoice" name="studenIdChoice" />
  <datalist id="studentIdList">
      <?php
        foreach($students as $student){
          echo "<option value='".$student['sisiID']."'>";
        }
      ?>
  </datalist>

  <br/>
  <select name="coursesID[]" multiple size=6>
      <?php
        foreach($courses as $course){
          echo "<option value='".$course['ID']."'>".$course['name']."</option>";
        }
      ?>
  </select>
  <br/>
  
  <button>Send</button>
</form>