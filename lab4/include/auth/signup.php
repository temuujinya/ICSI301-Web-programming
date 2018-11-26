<? 
   global $programs;
// if(!$hideGeneralReg){
   ?>

<div class="text-center">
    <img class="justify-content-center mb-5 mt-5" src="<? echo $site_url;?>/public/uploads/img/logo.png" width="60%"  alt="">
</div>
<a href="<? echo $site_url;?>/index.php?t=student#signup">Student</a>
<a href="<? echo $site_url;?>/index.php?t=staff#signup">Staff</a>
<? 
if(isset($_GET["t"])){
    if($_GET["t"]=='student')
        require "stuReg.php";   
    elseif($_GET["t"]=='staff')
        require "staReg.php";
}?>

