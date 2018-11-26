<? 
   global $programs;
// if(!$hideGeneralReg){
   ?>


<form action="<? echo $site_url;?>/index.php?t=staff#signup" method="POST">

 <? 
 if(isset($passwordStatus)){
 if(!$errorStatus && $passwordStatus<4){?>
   <div class="text-center">
   <h4>Таны нууц үг <? global $passwordErr; echo $passwordErr;?> байна үргэлжлүүлэх үү</h4>
    <input type="submit" name="finishSignUpStaff" class="btn btn-primary" value="Тийм">
    <input type="submit" name="changePass" class="btn btn-primary" value="Нууц">
    <a href="<? echo $site_url;?>/index.php?t=staff&changePadd=1#signup" class="btn btn-primary">Өөр нууц үг хийх</a>
    </div>
 <? }} ?>

 <div style="<? echo ($userType!="" && $errorStatus==false ? "display:none;":"")?>">

   <div class="form-group" >
      <input type="text" class="form-control"  id="username" aria-describedby="userName" value='<? echo $userName; ?>' placeholder="Хэрэглэгчийн нэр" name="userName">
      <? echo $userNameErr; ?>
   </div>
   <div class="form-group">
      <input type="password" class="form-control"  id="password" aria-describedby="password" value='<? echo $password;?>' placeholder="Нууц үг" name="password">
      <? echo $passwordErr; ?>
   </div>
   <div class="form-group">
      <input type="password" class="form-control"  id="passwordConfirm" aria-describedby="passwordConfirm"value='<? echo $passwordConfirm;?>' placeholder="Нууц үг давт" name="passwordConfirm">
      <? echo $passwordConfirmErr; ?>
   </div>
   <div class="form-group">
      <input type="text" class="form-control"  id="lastName" aria-describedby="lastName" value='<? echo $lastName;?>' placeholder="Овог" name="lName">
      <? echo $lastNameErr; ?>
   </div>
   <div class="form-group">
      <input type="text" class="form-control"  id="firstName" aria-describedby="firstName" value='<? echo $firstName;?>' placeholder="Нэр" name="fName">
      <? echo $firstNameErr; ?>
   </div>
    <!-- <div class="form-group">
      <select id="inputState" name="gender"  class="form-control">
        <option <? echo($gender=="" ?"selected":"")?> value="">Хүйс...</option>
        <option <? echo($gender==1 ?"selected":"")?> value="1">Эмэгтэй</option>
        <option <? echo($gender==2 ?"selected":"")?> value="2">Эрэгтэй</option>
      </select>
    <? echo $genderErr; ?>
    </div> -->

   <div class="form-group">
      <!--<label for="loginPass">Нууц үг</label>-->
      <input type="text" class="form-control" id="staffID" value='<? echo $staffID;?>' placeholder="Ажилтны дугаар" name="staffID">
      <? echo $staffIdErr; ?>
   </div>

   <div class="form-group">
      <!--<label for="loginPass">Нууц үг</label>-->
      <input type="text" class="form-control" id="staffPosition" value='<? echo $staffPosition;?>' placeholder="Албан тушаал" name="staffPosition">
      <? echo $staffPositionErr; ?>
   </div>

   <div class="form-group">
      <!--<label for="loginPass">Нууц үг</label>-->
      <input id="datepicker" name="staffJoinDate" width="276" value="<? echo $staffJoinDate; ?>" placeholder="Ажилд орсон огноо">
      <? echo $staffJoinDateErr; ?>
   </div>
    <input type='hidden' name="userType" value="1">
   <input type="submit" name ="signup"class="btn btn-primary" value="Бүртгүүлэх">
</form>
