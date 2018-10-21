<? 
require_once __DIR__."/../config.php";
?>
<div class="text-center">
    <img class="justify-content-center mb-5 mt-5" src="<? echo $site_url;?>/public/uploads/img/logo.png" width="60%"  alt="">
</div>
 <?
 echo $invalidLogin;
 ?>
<form action="<?echo $site_url;?>/" method="POST">
   <div class="form-group">
      <!--<label for="loginEmail">Цахим шуудан</label>-->
      <input type="text" class="form-control" id="loginEmail" placeholder="Цахим хаяг/Хэрэглэгчийн нэр"/ name="loginID" required>
      <!--
         <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
         -->
   </div>
   <div class="form-group">
      <!--<label for="loginPass">Нууц үг</label>-->
      <input type="password" class="form-control" id="loginPass" placeholder="Нууц үг" name="loginPass" required/>
      <input type="hidden" name="login" />
   </div>

   <!--
      <div class="form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>
      -->
   <button type="submit " class="btn btn-primary">Нэвтрэх</button>
   <br/>
   <a href="">Нууц үг мартсан</a>
</form>