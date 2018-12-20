<? 
require_once __DIR__."/../config.php";
?>
<div class="text-center">
    <img class="justify-content-center mb-5 mt-5" src="<? echo $site_url;?>/public/uploads/img/logo.png" width="60%"  alt="">
</div>
 <?
 echo $invalidLogin;
 if(isset($_GET['msg'])){
    echo "<div class='alert alert-success' role='alert'>".$_GET['msg']."</div>";
 }
 ?>
<form action="<?echo $site_url;?>/" method="POST">
   <div class="form-group">
      <!--<label for="loginEmail">Цахим шуудан</label>-->
      <input type="text" value="<? echo (isset($_COOKIE["username"]) ? $_COOKIE["username"]:"")?>" class="form-control" id="loginEmail" placeholder="Цахим хаяг/Хэрэглэгчийн нэр" name="loginID" required>
      <!--
         <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
         -->
   </div>
   <div class="form-group">
      <!--<label for="loginPass">Нууц үг</label>-->
      <input type="password" class="form-control" id="loginPass" placeholder="Нууц үг" name="loginPass" required/>
      <input type="hidden" name="login" />
   </div>

   <div>
        <img id="captcha_code" src="./include/captcha.php" />
        <input type="button" id="refresh-captcha" value="Refresh Captcha"/>
    </div>
    <div class="form-group">
        <br/>
        <input required type="text" name="captcha" id="captcha" class="demoInputBox"><br>
    </div>
   <!--
      <div class="form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>
      -->

   <input type="checkbox" name="remember" value="1">Remember<br/>
   <input type="submit" class="btn btn-primary" name="signin" value="Нэвтрэх">
   <br/>
   <a href="">Нууц үг мартсан</a>
</form>
