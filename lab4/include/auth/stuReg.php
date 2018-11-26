<? 
   global $programs;
// if(!$hideGeneralReg){
   ?>


<form action="<? echo $site_url;?>/index.php#signup" method="POST">

 <? 
 if(isset($passwordStatus)){
 if(!$errorStatus && $passwordStatus<4){?>
   <h1>Таны нууц үг <? global $passwordErr; echo $passwordErr;?> байна үргэлжлүүлэх үү</h1>
 <? }} ?>
 <div style="<? echo ($userType=="" ?"":"display:none")?>">
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
    <div class="form-group">
      <select id="inputState" name="gender"  class="form-control">
        <option <? echo($gender=="" ?"selected":"")?> value="">Хүйс...</option>
        <option <? echo($gender==1 ?"selected":"")?> value="1">Эмэгтэй</option>
        <option <? echo($gender==2 ?"selected":"")?> value="2">Эрэгтэй</option>
      </select>
    <? echo $genderErr; ?>
    </div>

   <div class="form-group">
      <input id="datepicker" name="dob" width="276" value="<? echo $dob; ?>" placeholder="Төрсөн огноо" name="dob">
      <? echo $dobErr; ?>
   </div>
   <div class="form-group" style="<? echo ($errorStatus===false ? "display:none;":"dd")?>">
      <!--<label for="loginPass">Нууц үг</label>-->
      <input type="text" class="form-control" id="studentID" value='<? echo $studentID;?>' placeholder="Оюутны дугаар" name="studentID">
      <? echo $studentIdErr; ?>
   </div>
   
    <div class="form-group">
      <select id="programIndex" name="programIndex" class="form-control">
        <option  value="" >Хөтөлбөр...</option>
        <?php 
         $programsHtml="";
         while($program = $programs->fetch()){
            $programsHtml.="<option ". ($programIndex==$program["programIndex"] ? " selected ":"")."value='".$program["programIndex"]."'>".$program["programName"]."</option>";
         }
         echo $programsHtml;
        ?>
      </select>
      <? echo $programErr; ?>
    </div>

      </div>
   <input type="submit" name ="signup"class="btn btn-primary" value="Бүртгүүлэх">
</form>
