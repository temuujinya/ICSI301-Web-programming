
  <?php 
    include 'include/partials/header.php';
  ?>
  <div class="container">
    <div class="row">
      <!-- <form action="#" method="post">
        <input name="searchStudentByLname" type="text"/>
        <button>Хайх</button>
      </form> -->

      <form action="#" method="post" class="float-right">
        <button class="btn btn-primary " name="displayAllStudents">Бүх оюутны мэдээллийг харах</button>
      </form>
    </div>

    <div class="row">
      <div class="col-md-12">
        <?php
          if(!isset($_POST["searchStudentByLname"])){
            displayStudentsInformation($students,$courses);
          }
          if(isset($_POST["searchStudentByLname"])){
            $studentName =$_POST["searchStudentByLname"];
            $foundStudents=findStudentByName($students,$studentName);
            if($foundStudents!=0)displayStudentsInformation($foundStudents,$courses);  
          }
        ?>
    </div>

    

  </div>

<?php 
  include 'include/partials/footer.php';
?>