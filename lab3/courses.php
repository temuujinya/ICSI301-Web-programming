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

    
        while($course = mysqli_fetch_assoc($result)){
            $render .= "<tr ";
            if(checkCourseTaken($course['courseIndex'],"16b1seas3369")){ 
                $render .= "bgcolor='#eee'";
            }
            $render .="><td>{$course['courseIndex']}</td>
                    <td>{$course['courseName']}</td>
                    <td>{$course['courseCredit']}</td>
                    <td><input type='checkbox' name=selectCourse[]/></td>
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

