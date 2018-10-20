<img class="justify-content-center mb-5 mt-5" src="images/fl-logo.svg" alt="">
<form action="/login" method="POST">
   <div class="form-group">
      <!--<label for="loginEmail">Цахим шуудан</label>-->
      <input type="email" class="form-control" required id="loginEmail" aria-describedby="emailHelp" placeholder="Цахим хаяг/Хэрэглэгчийн нэр"/ name="email">
      <!--
         <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
         -->
   </div>
   <div class="form-group">
      <!--<label for="loginPass">Нууц үг</label>-->
      <input type="password" class="form-control" id="loginPass" placeholder="Нууц үг" name="password" required/>
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