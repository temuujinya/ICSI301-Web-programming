<?

require_once __DIR__."/include/init.php";

if(!isAuthenticate()){
    echo "Nevter dahiad mangasaa";
    die();
}


$studProgram=findStudentProgramByID($_SESSION['studentID']);

if(1==1){
    include_once __DIR__."/include/partials/header.php";
    include_once __DIR__."/include/partials/navbar.php";
    $getAllCourse = "select * from course";
    mysqli_set_charset($db,"utf8");    
    $result= mysqli_query($db,$getAllCourse);
    
    $render = "<div class='container bg-light'>
        <form acion='#' method='post' class='studentList'>
        <table class='table table-hover '>
        <thead>
            <tr>
                <th scope='col'>Индекс</th>
                <th scope='col'>Хичээлийн нэр</th>
                <th scope='col'>Кердит</th>
                <th scope='col'>Сонгох</th>
                <th scope='col'>Сонгох</th>
            </tr>
        </thead>
        <tbody id='courses-table'>
        ";
        if(isset($_POST['selectCourse'])){
            $id=$_SESSION['studentID'];

            $courses = find_all_course();
            $course_enrollments = find_all_course_enrollment_by_student_id($id);
                // print_r($_POST['courses']);
                foreach ($_POST['selectCourse'] as $input_course) {
                    if (!find_course_enrollment_by_student_and_course_id($id, $input_course)) {
                        // insert_course_enrollment($id, $input_course);
                        takeCourseByStudent($_POST['selectCourse']);
                    }
                }
        
                while ($course = mysqli_fetch_assoc($course_enrollments)) {
                    if (!in_array($course['courseIndex'], $_POST['selectCourse'])) {
                        delete_course_enrollment_by_student_and_course_id($id, $course['courseIndex']);
                    }
                }
        
                mysqli_data_seek($course_enrollments, 0);
                $course = null;
                // redirect_to(url_for('/index.php?s_id='.$id));
            }
        
    



        while($course = mysqli_fetch_assoc($result)){
            $render .= "<tr ";
            if(checkCourseTaken($course['courseIndex'],$_SESSION['studentID'])){ 
                $render .= "class='bg-success text-light'";
            }
            $render .="><th scope='row'>{$course['courseIndex']}</th>
                    <td>{$course['courseName']}</td>
                    <td>{$course['courseCredit']}</td>
                    <td><input type='checkbox' value='{$course['courseIndex']}' name='selectCourse[]' 
                    ";
                    
            if(checkCourseTaken($course['courseIndex'],$_SESSION['studentID'])){ 
                $render .= "checked ";
            }
            $render .="/></td>
            <td><button class='btn btn-primary'>Сонгох</button></td> 
            
                </tr>";
        }

        $render .="
        </tbody>
            </table>
            <button type='reset'class='btn btn-success btn-sm'>Цэвэрлэх</button>
            <button class='btn btn-success btn-sm'>Сонгох</button>
            </form>
            <button id='program' class='btn btn-success btn-sm'>Program</button>
            <div id='confirm_box'></div>

            </div>";
        echo $render;
        include_once __DIR__."/include/partials/footer.php";
    }else{
        header("location: ./index.php");
    }
    ?>    

<script async >
var selectedCourses = [];
        // getLessonEnrolled('<?php echo $id; ?>');

        // document.getElementById('all').addEventListener('click', () => {
        //     getLessonEnrolled('<?php echo $id; ?>');
        // });

        // document.getElementById('program').addEventListener('click', () => {
        //     getProgramCourse('<?php echo $id; ?>');
        // });

        document.getElementById('program').addEventListener('click', () => {
            // displayStudents('<?php echo $id; ?>');
            // console.log("ff");
            getCoursesOfProgram('D061301');
        });
    
    
</script>