<?php
    require_once __DIR__ ."/include/init.php"; 
    if(!isAuthenticate()){
        echo "Nevter dahiad mangasaa";
        die();
    }
    include_once __DIR__."/include/partials/header.php";
    include_once __DIR__."/include/partials/navbar.php";
if(isAdmin($_SESSION['username'])){

   
    $users= findAllUsers();
    $render = "<div class='container bg-light'>";
    // $render .= "<a class='btn btn-success btn-md' href='./insert.php'>Оюутан нэмэх</a>";
    $render .= "<table class='table table-hover'>
        <thead>
            <tr>
                <th scope='col'>Хэрэглэгчийн нэр</th>
                <th scope='col'>Хэрэглэгчийн эрх</th>
                <th scope='col'>Төрөл</th>
                <th scope='col'>Блок авсан</th>
                <th scope='col'>Нууц үг солих хэрэгтэй</th>
                <th scope='col'>Бүртгүүлсэн огноо</th>
            </tr>
        </thead>
        ";
    if(isset($_POST["savePerUser"])){
        updateUserChangePass($_POST['username'], $_POST['changePass']);
        updateUserIsBlocked($_POST['username'], $_POST['isBlocked']);
    }
    while($user = $users->fetch()){
        $tempUser = $user;
        $render.= "
        <form action'#' method='post'>
        <tr>
                <td>{$tempUser["userName"]}</td>
                <td>".($tempUser["role"]==true ? 'Админ':'энгийн')."</td>
                <td>".($tempUser["userType"]==1 ? 'Ажилтан':'Оюутан')."</td>
                <td> 
                <div class='form-group'>
                <input type='hidden' name='username' value='{$tempUser["userName"]}'>
                <select id='isBlocked' name='isBlocked' class='form-control'>
                <option  ".($tempUser['isBlocked']==1 ? 'selected':'')." value='1' >Тийм</option>
                <option  ".($tempUser['isBlocked']==0 ? 'selected':'')." value='0' >Үгүй</option>
                </select>
                </div>
                  </td>
                <td>
                <div class='form-group'>
                <select id='changePass' name='changePass' class='form-control'>
                  <option  ".($tempUser['changePass']==1 ? 'selected':'')." value='1' >Тийм</option>
                  <option  ".($tempUser['changePass']==0 ? 'selected':'')." value='0' >Үгүй</option>
                </select>
                </div></td>
                <td>{$tempUser["regDate"]}</td>
                <td>
                    <input type='submit' class='btn btn-success btn-sm' name='savePerUser' value='Хадгалах'>
                    <form method='get' action='update.php'>
                        <button class='btn btn-success btn-sm' name='s_id' value='".findStudentID($_SESSION['username'])."'>Засах</button>
                    </form>
                    <form method='get' action='delete.php'>
                        <button class='btn btn-danger btn-sm' name='s_id' value='".findStudentID($_SESSION['username'])."'>Устгах</button>
                    </form>
                </td>
            </tr>
            
            ";
        $render .= "</form>";
    }
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