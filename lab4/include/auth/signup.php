<? include_once __DIR__."/../config.php";?>
<div class="text-center">
    <img class="justify-content-center mb-5 mt-5" src="<? echo $site_url;?>/public/uploads/img/logo.png" width="60%"  alt="">
</div>
<form action="/register" method="POST">
   <div class="form-group">
      <input type="text" class="form-control" required id="lastName" aria-describedby="lastName" placeholder="Овог" name="lName">
   </div>
   <div class="form-group">
      <input type="text" class="form-control" required id="firstName" aria-describedby="firstName" placeholder="Нэр" name="fName">
   </div>
   <!--
   <div class="form-group">
      <input type="text" class="form-control"  id="username" aria-describedby="username" placeholder="Хэрэглэгчийн нэр" name="">
   </div>
-->
   <div class="form-group">
      <!-- <label for="lastName">Нэр</label>-->
      <!--<label for="loginEmail">Цахим шуудан</label>-->
      <input type="email" class="form-control" required id="r_loginEmail" aria-describedby="emailHelp" placeholder="Цахим хаяг" name="email">
      <!--
         <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
         -->
   </div>
   <div class="form-group">
      <!--<label for="loginPass">Нууц үг</label>-->
      <input type="password" class="form-control" id="r_loginPass" required    placeholder="Нууц үг" name="password">
   </div>
   <div class="form-group">
      <!--<label for="loginPass">Нууц үг</label>-->
      <input type="password" class="form-control" id="loginPassRepeat" required    placeholder="Нууц үг давт" name="re_password">
   </div>
   <div class="form-group">
      <!--<label for="loginPass">Нууц үг</label>-->
      <input id="datepicker" width="276" placeholder="Төрсөн огноо" name="dob">
   </div>
   <div class="form-group">
      <!--<label for="loginPass">Нууц үг</label>-->
      <input type="text" class="form-control" id="phoneNumber" required placeholder="Утасны дугаар" name="phoneNumber">
   </div>
   <div class="form-group">
      <!--<label for="loginPass">Нууц үг</label>-->
      <input type="text" class="form-control" id="school" required    placeholder="Сургууль" name="school">
   </div>
   <div class="form-group">
      <!--<label for="loginPass">Нууц үг</label>-->
      <input type="text" class="form-control" id="level" required    placeholder="Түвшин" name="level">
   </div>
   <!--
      <div class="form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>
      -->
   <button type="submit" class="btn btn-primary">Бүртгүүлэх</button>
</form>