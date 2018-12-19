<?php
global $db;


function hashmin($pass){
    $saltA = "$%28Temuujinkka";
    $saltB = "Bna$%^&hha_?";
    $hashed = hash('ripemd128',$saltA.$pass.$saltB);
    return $hashed;
}

function findAllStudentsByProgram($program){
    global $pdo;
    $query = "select * from student where programIndex=:program";
    $query = $pdo->prepare($query);
    $query->bindParam(":program",$program);
    $query->execute();
    if($query->rowCount()>0){
        return $query;
    }else{
        return false;
    }
}

function loginCheckUsername($username){
    global $pdo;
    $query = "select * from users where userName=:username";
    $query = $pdo->prepare($query);
    $query->bindParam(":username",$username);
    $query->execute();
    if($query->rowCount()>0){
        return true;
    }else{
        return false;
    }
}

function loginCheckPassword($username, $password){
    global $pdo;
    $query = "select * from users where userName=:username and password=:password";
    $query = $pdo->prepare($query);
    $query->bindParam(":username",$username);
    $query->bindParam(":password",$password);
    $password=hashmin($password);
    $query->execute();
    if($query->rowCount()>0){
        return true;
    }else{
        return false;
    }
}

function findStudentID($username){
    global $pdo;
    $query = "select * from student where userName=:username";
    $query = $pdo->prepare($query);
    $query->bindParam(":username",$username);
    $query->execute();
    $query=$query->fetch();
    return $query["studentID"];
}
/* 
1-staff
2-student
*/
function findUserType($username){
    global $pdo;
    $query = "select * from users where userName=:username";
    $query = $pdo->prepare($query);
    $query->bindParam(":username",$username);
    $query->execute();
    $query=$query->fetch();
    return $query["userType"];
}

/* 
1-admin
0-student
*/
function findUserRole($username){
    global $pdo;
    $query = "select * from users where userName=:username";
    $query = $pdo->prepare($query);
    $query->bindParam(":username",$username);
    $query->execute();
    $query=$query->fetch();
    return $query["role"];
}

function isAdmin($username){
    if(findUserRole($username)){
        return true;
    }else{
        return false;
    }
}

function isAuthenticate(){
    if(isset($_SESSION['username'])&&isset($_SESSION['userType'])){
        return true;
    }else{
        return false;
    }
}
/*
0-no
1-yes 
*/
function isBlocked($username){
    global $pdo;
    $query = "select * from users where userName=:username";
    $query = $pdo->prepare($query);
    $query->bindParam(":username",$username);
    $query->execute();
    $query=$query->fetch();
    return $query["isBlocked"];
}

/*
0-no
1-yes 
*/
function isNeedChangePass($username){
    global $pdo;
    $query = "select * from users where userName=:username";
    $query = $pdo->prepare($query);
    $query->bindParam(":username",$username);
    $query->execute();
    $query=$query->fetch();
    return $query["changePass"];
}

function updateUserPassword($username, $password){
    global $pdo;
    $query = "update users set password=:password where userName=:username";
    $query = $pdo->prepare($query);
    $query->bindParam(":username",$username);
    $query->bindParam(":password",$password);
    $query->execute();
}

/*
-1 - username not found
-2 - user blocked
*/
function loginCheck($username, $password){
    if(loginCheckUsername($username)){
        if(loginCheckPassword($username,$password)){
            if(!isBlocked($username)){
                $_SESSION['username']=$username;
                $_SESSION['userType']=findUserType($username);
                $_SESSION['isBlocked']=isBlocked($username);
                $_SESSION['needChangePass']=isNeedChangePass($username);
                if(findUserType($username)===1){
                    $_SESSION['userRole']=isAdmin($username);
                }else{
                    $_SESSION['studentID']=findStudentID($username);
                    
                }
                return true;
            }else{
                return -2;
            }
            // $_SESSION['']
        }
    }else{
        return -1;
    }
}
function updateUserChangePass($username,$changePass){
    global $pdo;
    $query = "update  users SET changePass=:changepass where 
                userName = :username";
    $query=$pdo->prepare($query);
    $query->bindParam(":username", $username);
    $query->bindParam(":changepass",$changePass);
    $query->execute();
}

function updateUserIsBlocked($username,$isblocked){
    global $pdo;
    $query = "update  users SET isBlocked=:isblocked where 
                userName = :username";
    $query=$pdo->prepare($query);
    $query->bindParam(":username", $username);
    $query->bindParam(":isblocked",$isblocked);
    $query->execute();
}
function addNewUser($username, $password, $usertype){
    global $pdo;
    $query = "insert into users(userName, password, userType) 
                values(:userName,:passWord,:userType)";
    $query = $pdo->prepare($query);
    $password=hashmin($password);
    $query->bindParam(':userName',$username);
    $query->bindParam(':passWord',$password);
    $query->bindParam(':userType',$usertype);
    $query->execute();
}

function addNewStaff($username, $password, $lName, $fName, $staffID, $staffPosision, $staffJoinDate, $userType){
    global $pdo;
    addNewUser($username, $password, $userType);
    $query = "insert into staff
        (username, staffID, position, firstName, lastName, dateJoined)
        values(:username, :staffid, :position, :fname, :lname, :datejoined)";
    $query=$pdo->prepare($query);
    $query->bindParam(':username',$username);
    $query->bindParam(':staffid',$staffID);
    $query->bindParam(':position',$staffPosision);
    $query->bindParam(':fname',$fName);
    $query->bindParam(':lname',$lName);
    $query->bindParam(':datejoined',$staffJoinDate);
    $query->execute();
}

function addNewStudent($username, $password, $lName, $fName, $studentID, $gender, $dob, $userType, $programIndex){
    global $pdo;
    addNewUser($username, $password, $userType);
    $query = "insert into student
        (username, studentID, firstName, lastName, gender,
        programIndex, dob)
        values(:username, :studentid, :fname, :lname, :gender,
        :programIndex, :dob)";
    $query=$pdo->prepare($query);
    $query->bindParam(':username',$username);
    $query->bindParam(':studentid',$studentID);
    $query->bindParam(':fname',$fName);
    $query->bindParam(':lname',$lName);
    $query->bindParam(':gender',$gender);
    $query->bindParam(':programIndex',$programIndex);
    $query->bindParam(':dob',$dob);
    $query->execute();
}


function findAllProgram(){
    global $pdo;
    $query = "select * from program";
    $query = $pdo->prepare($query);
    $query->execute();

    return $query;
}

function findAllUsers(){
    global $pdo;
    $query = "select * from users";
    $query = $pdo->prepare($query);
    $query->execute();
    return $query;
}

function checkUserName($username){
    global $pdo;
    $query = "select * from users where userName = :userName";
    $query = $pdo->prepare($query);
    $query->bindParam(':userName', $username);
    $query->execute();
    if($query->rowCount()>0){
        return false;
    }else{
        return true;
    }
}
/*
4- маш сайн
3- дунд
2-сул
1- маш муу
0- богино байна
-1 - хэтэрхий урт байна
NULL - зөвшөөрөгдөхгүй тэмдэгт
*/
function checkPasswordStructure($password){
    if(preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,32}$/', $password)){
        return 4;
     }else if(preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,32}$/', $password)
                || preg_match('/^(?=.*\d)(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,32}$/', $password)
                || preg_match('/^(?=.*[@#\-_$%^&+=§!\?])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,32}$/', $password)){
         return 3;
     }else if(preg_match('/^(?=.*\d)[0-9A-Za-z@#\-_$%^&+=§!\?]{6,32}$/', $password)
                || preg_match('/^(?=.*[@#\-_$%^&+=§!\?])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,32}$/', $password)
                || preg_match('/^(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,32}$/', $password)){
                return 2;              
                // }
                // else if(preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,32}$/',$password)){
                //     return 1;
                }else if(preg_match('/^[0-9A-Za-z@#\-_$%^&+=§!\?]{6,32}$/', $password)){
                    // echo "length";
                    return 1;
                }elseif(strlen($password)<6){
                    return 0;
                }elseif(strlen($password)>32){
                    return -1;
                }
 }
 
function checkUserNameStructure($username){
    if(preg_match('/^[A-Za-z]{1}[A-Za-z0-9_]{5,32}$/', $username)){
       return true;
    }else{
        return false;
    }
}

function checkPasswordsEqual($pass,$passConfirm){
    if(strcmp($pass, $passConfirm)==0){
        // var_dump($query);
        return true;
    }else{
        return false;
    }
}

function isUserProgram($programIndex, $studentID){
    global $db;
    $studentID=findStudentID($_SESSION["username"]);
    $checkQR="select * from student where 
    studentID ='{$studentID}' AND programIndex='{$programIndex}'";
    $checkQR = mysqli_query($db,$checkQR);
    if(!$checkQR){
        die("erro".mysqli_error($db));
    }
    if(mysqli_num_rows($checkQR)<=0){
        return false;      
    }
    return true;
}

function checkCourseTaken($courseIndex){
    global $db;
    $studentID=findStudentID($_SESSION["username"]);
    $checkQR="select * from coursetakenhistory where 
        studentID ='{$studentID}' AND courseIndex='{$courseIndex}'";
    $checkQR = mysqli_query($db,$checkQR);
    if(!$checkQR){
        die("erro".mysqli_error($db));
    }
    if(mysqli_num_rows($checkQR)<=0){
        return false;      
    }
    return true;
}

function takeCourseByStudent($courses){
    global $db;
    $studentID=findStudentID($_SESSION["username"]);
    foreach($courses as $course){
        $takeCourse = "insert into coursetakenhistory (studentID,courseIndex)
        values ('{$studentID}','{$course}')";
        mysqli_query($db,$takeCourse);
    }
}

function selectProgram($program){
    global $db;
    $studentID=findStudentID($_SESSION["username"]);
        $choosenProgram = "update student set programIndex='{$program}' where studentID = '{$studentID}'";
        mysqli_query($db,$choosenProgram);
}

function sanitizeString($var){
    global $db;
    $var = mysqli_real_escape_string($db, $var);
    $var =  filter_var($var, FILTER_SANITIZE_STRING,FILTER_SANITIZE_STRIP_HIGH);
    return $var;
}
?>