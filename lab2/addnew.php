<?php 
    include 'include/partials/header.php';
?>

<div class="container">
    <div class="row"> 
      <div class="col-md-12 mt-2">
        <h2>Хичээл нэмэх</h2>
        <?php
          if(isset($_POST["studenIdChoice"]) && isset($_POST['coursesID'])){
            addCoursesIntoStudent($students, $_POST["studenIdChoice"],$_POST['coursesID'],$courses);
          }
        ?>

        <form action="#" method="POST">
            <div class="form-group">
                <label for="studenIdChoice">SISI ID оруулна уу:</label>
                <input list="studentIdList" id="studenIdChoice" class="form-control" name="studenIdChoice" />
                <datalist id="studentIdList">
                    <?php
                    foreach($students as $student){
                        echo "<option value='".$student['sisiID']."'>";
                    }
                    ?>
                </datalist>
            
            </div>
            <br/>
            <div class="form-group">
                <label for="coursesList">Хичээл сонгоно уу（CTRL дараад олон хичээл сонгоно）</label>
                <select name="coursesID[]" id="coursesList" class="form-control" multiple size=6>
                    <?php
                        foreach($courses as $course){
                            echo "<option value='".$course['ID']."'>".$course['ID']." - ".$course['name']." (".$course['credit']." кр)"."</option>";
                        }
                    ?>
                </select>
            </div>
          <button class="btn btn-primary">Нэмэх</button>
        </form>
      </div>
    </div>
</div>

<?php 
    include 'include/partials/footer.php';
?>