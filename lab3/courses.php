<?

if(isset($_COOKIE['studentID'])){
    require_once __DIR__."/include/init.php";
    include_once __DIR__."/include/partials/header.php";
    $getAllCourse = "select * from course";
    mysqli_set_charset($db,"utf8");    
    $result= mysqli_query($db,$getAllCourse);

    $render = "<div class='container'>
        <form acion='#' method='post'>
        <table>
        <tr>
            <th>Индекс</th>
            <th>Хичээлийн нэр</th>
            <th>Кердит</th>
            <th>Сонгох</th>
        </tr>
        ";

        if(isset($_POST['selectCourse'])){
            takeCourseByStudent($_POST['selectCourse']);
        }
    
        while($course = mysqli_fetch_assoc($result)){
            $render .= "<tr ";
            if(checkCourseTaken($course['courseIndex'],$_COOKIE['studentID'])){ 
                $render .= "bgcolor='#eee'";
            }
            $render .="><td>{$course['courseIndex']}</td>
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
            <button>Сонгох</button>
            </form>
            </div>";
        echo $render;
        include_once __DIR__."/include/partials/footer.php";
    }else{
        header("location: ./index.php");
    }
    ?>    

