<?php
    require_once __DIR__ ."/include/init.php"; 
    if(!isAuthenticate()){
        echo "Nevter dahiad mangasaa";
        die();
    }
    include_once __DIR__."/include/partials/header.php";
    include_once __DIR__."/include/partials/navbar.php";
if(isAdmin($_SESSION['username'])){

    $students="select * from student";
    mysqli_set_charset($db,"utf8");
    $result= mysqli_query($db, $students);
    $render = "<div class='container bg-light'>";
    $render .= "<a class='btn btn-success btn-md' href='./insert.php'>Оюутан нэмэх</a>";
    $render .= "<table class='table table-hover'>
        <thead>
            <tr>
                <th scope='col'>Хэрэглэгчийн нэр</th>
                <th scope='col'>Хувийн дугаар</th>
                <th scope='col'>Овог</th>
                <th scope='col'>Нэр</th>
                <th scope='col'>Хүйс</th>
                <th scope='col'>Төрсөн огноо</th>
                <th scope='col'>Хөтөлбөр</th>
                <th scope='col'></th>
            </tr>
        </thead>";

    while($student = mysqli_fetch_assoc($result)){
        $tempStudent = $student;
        $render.= "<tr>
                <td>{$tempStudent["userName"]}</td>
                <td>{$tempStudent["studentID"]}</td>
                <td>{$tempStudent["lastName"]}</td>
                <td>{$tempStudent["firstName"]}</td>
                <td>{$tempStudent["gender"]}</td>
                <td>{$tempStudent["dob"]}</td>
                <td>{$tempStudent["programIndex"]}</td>
                <td>
                    <form method='get' action='update.php'>
                        <button class='btn btn-success btn-sm' name='s_id' value='{$tempStudent["studentID"]}'>Засах</button>
                    </form>
                    <form method='get' action='delete.php'>
                        <button class='btn btn-danger btn-sm' name='s_id' value='{$tempStudent["studentID"]}'>Устгах</button>
                    </form>
                </td>
            </tr>";
    }
    //free result set
    mysqli_free_result($result);
    $render.="</table>
        </div>";
    echo $render;
?>
<?php

    include "./include/partials/footer.php";
}else{
    header("location: ./index.php");
}
?>