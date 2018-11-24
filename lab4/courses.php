<?

if(isset($_COOKIE['studentID'])){
    require_once __DIR__."/include/init.php";
    include_once __DIR__."/include/partials/header.php";
    $getAllCourse = "select * from course";
    mysqli_set_charset($db,"utf8");    
    $result= mysqli_query($db,$getAllCourse);

    $render = "<div class='container bg-light'>
        <form acion='#' method='post'>
        <table class='table table-hover'>
        <thead>
            <tr>
                <th scope='col'>Индекс</th>
                <th scope='col'>Хичээлийн нэр</th>
                <th scope='col'>Кердит</th>
                <th scope='col'>Сонгох</th>
            </tr>
        </thead>
        ";

        if(isset($_POST['selectCourse'])){
            takeCourseByStudent($_POST['selectCourse']);
        }
    
        while($course = mysqli_fetch_assoc($result)){
            $render .= "<tr ";
            if(checkCourseTaken($course['courseIndex'],$_COOKIE['studentID'])){ 
                $render .= "class='bg-success text-light'";
            }
            $render .="><th scope='row'>{$course['courseIndex']}</th>
                    <td>{$course['courseName']}</td>
                    <td>{$course['courseCredit']}</td>
                    <td><input type='checkbox' value='{$course['courseIndex']}' name='selectCourse[]' 
                    ";
                    
            if(checkCourseTaken($course['courseIndex'],$_COOKIE['studentID'])){ 
                $render .= "checked disabled";
            }
            $render .="/></td>
                </tr>";
        }

        $render .="
            </table>
            <button type='reset'class='btn btn-success btn-sm'>Цэвэрлэх</button>
            <button class='btn btn-success btn-sm'>Сонгох</button>
            </form>
            </div>";
        echo $render;
        include_once __DIR__."/include/partials/footer.php";
    }else{
        header("location: ./index.php");
    }
    ?>    

