<div class="container">
   <!-- Content here -->
   <div class="row justify-content-center mt-5 pt-5">
      <div class="col-md-4 bg-white rounded border p-5">
         <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
               <a class="nav-link show active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="home" aria-selected="true">Нэвтрэх</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" id="signup-tab" data-toggle="tab" href="#signup" role="tab" aria-controls="profile" aria-selected="false">Бүртгүүлэх</a>
            </li>
         </ul>
         <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="home-tab">
                <? include_once "./signin.php" ?>
            </div>
            <div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="profile-tab">
                <? include_once "./signup.php" ?>
            </div>
         </div>
      </div>
   </div>
</div>
