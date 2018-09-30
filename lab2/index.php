<?php
/* 
  Сурагчийн хүснэгтэд sisiID гаар key(associate array) хийхэд болохгүй санагдсан
  учир нь сурагч хүснэгтрүү нэмэлт утга оруулахад key өмнө нь зарлагдсан байх
  ёстой.
*/
  include 'functions.php';
  include './configure/conf.php';

  // initFilesWithJsons();

  if(!isset($courses)){
    $courses=readArrayFromFile($coursesFilePath);
  }
  if(!isset($students)){
    $students=readArrayFromFile($studentsFilePath);
  }

  if(isset($_POST["searchStudentByLname"])){
    $studentName =$_POST["searchStudentByLname"];
    $foundStudents=findStudentByName($students,$studentName);
    if($foundStudents!=0)displayStudentsInformation($foundStudents,$courses);  
  }

  if(isset($_POST["displayAllStudents"])){
    $displayAllStudents=$_POST["displayAllStudents"];
    displayStudentsInformation($students,$courses);
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Бяцхан сиси</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  
  <form action="#" method="post">
    <input name="searchStudentByLname" type="text"/>
    <button>Хайх</button>
  </form>

  <form action="#" method="post">
    <button name="displayAllStudents">Бүх оюутны мэдээллийг харах</button>
  </form>

  <h2>Хичээл нэмэх</h2>
  <?php
    if(isset($_POST["studenIdChoice"]) && isset($_POST['coursesID'])){
      addCoursesIntoStudent($students, $_POST["studenIdChoice"],$_POST['coursesID'],$courses);
    }
  ?>

  <form action="#" method="POST">
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
    <button>Нэмэх</button>
  </form>

</body>
</html>