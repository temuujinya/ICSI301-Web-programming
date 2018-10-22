<?

if(isset($_COOKIE['studentID'])){
    require_once __DIR__."/include/db.php";
    include_once __DIR__."/include/partials/header.php";
    $getAllCourse = "select * from course";
    mysqli_set_charset($db,"utf8");    
    $result= mysqli_query($db,$getAllCourse);

?>

<div class="container">
    <?
        while($course = mysqli_fetch_assoc($result)){
            echo "<p>{$course['courseName']}</p>";
        }
        include_once __DIR__."/include/partials/footer.php";
    }else{
        header("location: ./index.php");
    }
    ?>    