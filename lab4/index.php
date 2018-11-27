<?php
// include "./conf/db.php";
require_once __DIR__."/include/init.php";
$invalidLogin="";
$errorStatus=false;

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signin"])){
    $studentID =$_POST["loginID"];
    $studentPASS =$_POST["loginPass"];
    if(loginCheck($studentID, $studentPASS)===true){
        if(isset($_POST["remember"])){
            setcookie("username",$studentID,time() + (86400 * 365));
        }
    }elseif(loginCheck($studentID, $studentPASS)===-1){
        $invalidLogin ="<div class='alert alert-danger' role='alert'>
                            Ийм нэвтрэх нэртэй хэрэглэгч алга байна.
                        </div>";
        
    }elseif(loginCheck($studentID, $studentPASS)===-2){
        $invalidLogin ="<div class='alert alert-danger' role='alert'>
                            Системийн админ таныг блоклосон байна мөнгөө
                            төл .
                        </div>";
    }else{
        $invalidLogin ="<div class='alert alert-danger' role='alert'>
                            Оюутны хувийн дугаар эсвэл нууц үг буруу байна.
                        </div>";
    }

    // $findStudentById = "select * from student where studentID='{$studentID}'";
    // $result = mysqli_query($db,$findStudentById);
    
    // if(mysqli_fetch_assoc($result)!==null){
    //     $studentPASS = sanitizeString($_POST["loginPass"]);

    //     $passCheck = "select * from student where studentID='{$studentID}' AND password='{$studentPASS}'";
    //     $result = mysqli_query($db, $passCheck);
    //     if(mysqli_fetch_assoc($result)!==null){
    //         echo "logged in";
    //         setcookie("studentID",$studentID);
    //         header("location: {$site_url}/");
    //     }else{
    //         echo "passwrong";
    //     }
    // }else{
    //     $invalidLogin ="<div class='alert alert-danger' role='alert'>
    //                         Оюутны хувийн дугаар эсвэл нууц үг буруу байна.
    //                     </div>";
    // }
}

$userNameErr = $passwordErr =$passwordConfirmErr = $firstNameErr = $lastNameErr = $genderErr = $dobErr = $studentIdErr = $programErr= $userTypeErr =$staffID=$staffPosition=$staffJoinDate= "";
$userName=$password=$passwordConfirm=$firstName=$lastName=$gender=$dob=$studentID=$programIndex=$userType=$staffIdErr=$staffPositionErr=$staffJoinDateErr="";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup"]) || isset($_POST["finishSignUpStaff"])|| isset( $_POST["changePass"]) || isset($_POST["finishSignUpStudent"])){
    
    $passHide=false;
   if(isset( $_POST["finishSignUpStaff"]) ||isset( $_POST["finishSignUpStudent"])|| isset( $_POST["changePass"])){
    $passHide=true;
   }
   $passwordStatus=0;
   $userName = $_POST["userName"];
   $userType = $_POST["userType"];
   $password = $_POST["password"];
   $passwordConfirm = $_POST["passwordConfirm"];
   $lastName = $_POST["lName"];
   $firstName = $_POST["fName"];

if($userType=='2'){
    $gender = $_POST["gender"];
     $dob = $_POST["dob"];
    if(isset($_POST["studentID"])){
        $studentID = $_POST["studentID"];
    }
    if(isset($_POST["programIndex"])){
        $programIndex = $_POST["programIndex"];
    }
}
if($userType=='1'){
    if(isset($_POST["staffID"])){
        $staffID = $_POST["staffID"];
    }
    if(isset($_POST["staffPosition"])){
        $staffPosition = $_POST["staffPosition"];
    }
    if(isset($_POST["staffJoinDate"])){
        $staffJoinDate= $_POST["staffJoinDate"];
    }
}
   if(empty($userName)){
      $userNameErr = "<div class='alert alert-danger' role='alert'>
                        Хэрэглэгчийн нэр заавал оруулах ёстой.
                     </div>";
                     $errorStatus=true;
   }else if(!checkUserNameStructure($userName)){
      $userNameErr = "<div class='alert alert-danger' role='alert'>
                     Хэрэглэгчийн нэр нь латин том жижиг үсэг болон тоо доогуур зураас
                     агуулж болох ба 5-32 тэмдэгт байх ёстой. Тусгай тэмдэгт ашиглаж
                     болохгүй(!@#$%^&*()
                     </div>";
                     $errorStatus=true;
   }else if(!checkUserName($userName)){
      $userNameErr = "<div class='alert alert-danger' role='alert'>
                     Тус хэрэглэгчийн нэр нь ашиглагдаж байна. Өөр нэр оруулна уу
                     </div>";
                     $errorStatus=true;
   }

   if(empty($password)){
       $passwordErr = "<div class='alert alert-danger' role='alert'>
                        Нууц үгээ оруулна уу!      
                            </div>";
                            $errorStatus=true;
   }else if(checkPasswordStructure($password)<=4){
        $passwordErr="<div class='alert alert-danger' role='alert'>";
        switch(checkPasswordStructure($password)){
            case 4: $passwordErr .="Нууц үгийн хүч машs зэрэг";break;
            case 3: $passwordErr .="Нууц үгийн хүч дунд зэрэг";break;
            case 2: $passwordErr .="Нууц үгийн хүч сул зэрэг";break;
            case 1: $passwordErr .="Нууц үгийн хүч маш муу";$errorStatus=true;break;
            case 0: $passwordErr .="Нууц үгийн урт богино байна. Доод тал нь 6 тэмдэгт байх ёстой";$errorStatus=true;break;
            case -1: $passwordErr .="Нууц үг хэтэрхий урт байна. Ихдээ 32 тэмдэгт байх ёстой";$errorStatus=true;break;
            case NULL: $passwordErr .="Зөвхөн латин том жижиг үсэг, тоо болон, тусгай тэмдэгтийг зөвшөөрнө";$errorStatus=true;break; 
        }
        $passwordErr .= "</div>";
   }
    $passwordStatus =checkPasswordStructure($password);

    if(empty($passwordConfirm)){
    $passwordConfirmErr = "<div class='alert alert-danger' role='alert'>
                     Нууц үгээ давтаж оруулна уу!      
                         </div>";
                         $errorStatus=true;
    }else if(!checkPasswordsEqual($password,$passwordConfirm)){
     $passwordConfirmErr="<div class='alert alert-danger' role='alert'>
        Хоёр нууц үг таарахгй байна
     </div>";
     $errorStatus=true;
    }

    if(empty($firstName)){
        $firstNameErr = "<div class='alert alert-danger' role='alert'>
                            Нэрээ оруулна уу!
                        </div>";
                        $errorStatus=true;
    }
    if(empty($lastName)){
        $lastNameErr = "<div class='alert alert-danger' role='alert'>
                            Овгоо оруулна уу!
                        </div>";
                        $errorStatus=true;
    }



    if($userType=='1'){
        if(empty($staffID)){
            $staffIdErr = "<div class='alert alert-danger' role='alert'>
                            Ажилтны дугаараа оруулна уу!
                            </div>";
                            $errorStatus=true;
        }

        if(empty($staffPosition)){
            $staffPositionErr = "<div class='alert alert-danger' role='alert'>
                        албан тушаалаа оруулна уу!
                        </div>";
                        $errorStatus=true;
        }

        if(empty($staffJoinDate)){
            $staffJoinDateErr="<div class='alert alert-danger' role='alert'>
            Ажилд орсон огноо оруулна!
            </div>";
            $errorStatus=true;
        }
        
    }

    if($userType=='2'){

    if(empty($gender)){
        $genderErr = "<div class='alert alert-danger' role='alert'>
                            Хүйсээ сонгоно уу!
                        </div>";
                        $errorStatus=true;
    }
    if(empty($dob)){
        $dobErr = "<div class='alert alert-danger' role='alert'>
                        Төрсөн огноогоо сонгоно уу!
                        </div>";
                        $errorStatus=true;
    }
        if(empty($studentID)){
            $studentIdErr = "<div class='alert alert-danger' role='alert'>
                            Оюутны дугаараа оруулна уу!
                            </div>";
                            $errorStatus=true;
        }

        if(empty($programIndex)){
            $programErr = "<div class='alert alert-danger' role='alert'>
                        Хөтөлбөрөө сонгоно уу!
                        </div>";
                        $errorStatus=true;
        }
    }

    

    if(isset($_POST["programIndex"])){
    $programIndex = $_POST["programIndex"];
    if(empty($programIndex)){
        $programErr = "<div class='alert alert-danger' role='alert'>
                        Хөтөлбөрөө сонгоно уу!
                        </div>";
                        $errorStatus=true;
    }
}
    if(empty($userType)){
        $userTypeErr = "<div class='alert alert-danger' role='alert'>
                        Хэрэглэгчийн төрлөө сонгоно уу!
                        </div>";
                        $errorStatus=true;
    }

    if(!$errorStatus){
        echo "aldaagui";
        if($passwordStatus!=4){
            echo "pass not enough";
        }else{
            echo "hi";
        }
    }

    if(!isset($_POST["finishSignUpStaff"])&& !isset($_POST["finishSignUpStudent"]) && isset($_GET["t"])){
        if($_GET['t']=='student'){
            addNewStudent($userName, $password, $lastName, $firstName, $studentID,$gender,$dob,$userType,$programIndex);
            header("location: ./");
        }elseif($_GET['t']=='staff'){
            addNewStaff($userName, $password, $lastName, $firstName, $staffID, $staffPosition, $staffJoinDate, $userType);
            header("location: ./");
        }
    }
    if(isset($_POST["finishSignUpStaff"])){
        addNewStaff($userName, $password, $lastName, $firstName, $staffID, $staffPosition, $staffJoinDate, $userType);
        header("location: ./");
    }
    if(isset($_POST["finishSignUpStudent"])){
        addNewStudent($userName, $password, $lastName, $firstName, $studentID,$gender,$dob,$userType,$programIndex);
        header("location: ./");
    }
    // if(isset($_POST["changePass"])){
    //     $passHide=false;
    // }

}

if(!isset($_SESSION['username'])){
    require_once "include/auth/auth.php";
}elseif(isAdmin($_SESSION['username']) && !isNeedChangePass($_SESSION['username'])){
    require_once "list.php";
}elseif(isNeedChangePass($_SESSION['username'])) {
    
    require_once "include/changepass.php";
}else{
    require_once "courses.php";
}
mysqli_close($db);

include_once __DIR__."/include/partials/footer.php";
?>