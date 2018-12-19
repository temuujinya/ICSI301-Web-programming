<?

require_once __DIR__."/include/init.php";
if(!isAuthenticate()){
    echo "Nevter dahiad mangasaa";
    die();
}
if(1==1){
    include_once __DIR__."/include/partials/header.php";
    include_once __DIR__."/include/partials/navbar.php";
    $getAllCourse = "select * from program";
    mysqli_set_charset($db,"utf8");    
    $result= mysqli_query($db,$getAllCourse);
    $render = "<div class='container bg-light'>
        <form acion='#' id='programs-table' method='post'>
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
            selectProgram($_POST['selectCourse']);
        }
    
        while($course = mysqli_fetch_assoc($result)){
            $render .= "<tr ";
            if(isUserProgram($course['programIndex'],$_SESSION['studentID'])){ 
                $render .= "class='bg-success text-light'";
            }
            $render .="><th scope='row' pIndex={$course['programIndex']}>{$course['programIndex']}</th>
                    <td>{$course['programName']}</td>
                    <td>{$course['issuedDate']}</td>
                    <td><input type='radio' value='{$course['programIndex']}' name='selectCourse' 
                    ";
                    
            if(isUserProgram($course['programIndex'],$_SESSION['studentID'])){ 
                $render .= "checked";
            }
            $render .="/></td>
                </tr>";
        }

        $render .="
            </table>
            <button type='reset'class='btn btn-success btn-sm'>Цэвэрлэх</button>
            <button class='btn btn-success btn-sm'>Сонгох</button>
            </form>
            <div class='studentList'>
            <table class='table table-hover  table-dark'>
                <thead>
                    <tr>
                        <th scope='col'>Овог</th>
                        <th scope='col'>нэр</th>
                        <th scope='col'>Дугаар</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
        </div>
            ";
        echo $render;
        include_once __DIR__."/include/partials/footer.php";
    }else{
        header("location: ./index.php");
    }
    ?>    

