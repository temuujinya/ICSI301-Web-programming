
<?

require_once __DIR__."/init.php";
include_once __DIR__."/partials/header.php";
// include_once __DIR__."/partials/navbar.php";
echo "<div class='container'>";



$errorStatus=false;
$userNameErr = $passwordErr =$passwordConfirmErr = $firstNameErr = $lastNameErr = $genderErr = $dobErr = $studentIdErr = $programErr= $userTypeErr =$staffID=$staffPosition=$staffJoinDate= "";
$userName=$password=$passwordConfirm=$firstName=$lastName=$gender=$dob=$studentID=$programIndex=$userType=$staffIdErr=$staffPositionErr=$staffJoinDateErr="";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["savePass"]) || isset($_POST["finishSignUpStaff"])|| isset( $_POST["changePass"]) || isset($_POST["finishSignUpStudent"])){

    $passHide=false;
   if(isset($_POST["changePass"]) && $errorStatus==false){
    $passHide=true;
   }
   $passwordStatus=0;
   $password = $_POST["password"];
   $passwordConfirm = $_POST["passwordConfirm"];

   if(empty($password)){
       $passwordErr = "<div class='alert alert-danger' role='alert'>
                        Нууц үгээ оруулна уу!      
                            </div>";
                            $errorStatus=true;
   }else if(checkPasswordStructure($password)<=4){
        $passwordErr="<div class='alert alert-danger' role='alert'>";
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



    if(isset($_POST["finishSignUpStudent"])){
        updateUserChangePass($_SESSION['username'], $_POST['password']);
        header("location: ./");
    }
    // if(isset($_POST["changePass"])){
    //     $passHide=false;
    // }

}?>
























<? 
// if(!$hideGeneralReg){
    $pageHide = false;
    ?>


<form action="#" method="POST">
 <? 
 if(isset($passwordStatus)){
  if(!$errorStatus && $passwordStatus<4 && !$passHide){?>
    <div class="text-center">
    <h4>Таны нууц үг <? global $passwordErr; echo $passwordErr;?> байна үргэлжлүүлэх үү</h4>
      <input type="submit" name="finishSignUpStudent" class="btn btn-primary" value="Тийм">
      <input type="submit" name="changePass" class="btn btn-primary" value="Өөр нууц үг хийх">
      </div>
 <? }} ?>


   <div class="form-group" style="<? /*echo ($passHide==false ? "display:none;":"")*/?>">
      <input type="password" class="form-control"  id="password" aria-describedby="password" value='<? echo $password;?>' placeholder="Нууц үг" name="password">
      <? echo $passwordErr; ?>
   </div>
   <div class="form-group" style="<? /*echo ($passHide==false ? "display:none;":"")*/?>">
      <input type="password" class="form-control"  id="passwordConfirm" aria-describedby="passwordConfirm"value='<? echo $passwordConfirm;?>' placeholder="Нууц үг давт" name="passwordConfirm">
      <? echo $passwordConfirmErr; ?>
   </div>
   
   <input type="submit" name ="savePass"class="btn btn-primary" value="Бүртгүүлэх">
</form>










