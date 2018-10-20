<?php
    include_once __DIR__."/include/partials/header.php";
 
    if(isset($_POST["save"])){
        //PHP PREPARED STATEMENT(help for escape sql injection)
        $update =$db->prepare("update student set studentID=?,lastName=?,firstName=?,gender=?,dob=?,programIndex=?, password=? where studentID=?");
        //TODO: oilgo
        //https://stackoverflow.com/questions/18316501/php-update-prepared-statement
        
        // The argument may be one of four types:
        //     i - integer
        //     d - double
        //     s - string
        //     b - BLOB
        $update->bind_param('ssssssss',
                            $_POST['studentID'],
                            $_POST['lastName'],
                            $_POST['firstName'],
                            $_POST['gender'],
                            $_POST['dob'],
                            $_POST['programIndex'],
                            $_POST['password'], 
                            $_GET['s_id']);
        $status=$update->execute();
        if ($status === false) {
            trigger_error($update->error, E_USER_ERROR);
        }
        /*
            Оюутны хувийн дугаарыг сольсон бол тухайд дугаараар нь дахин хандаж байна.
        */
        header("Location: ./update.php?s_id={$_POST['studentID']}");
        exit();
    }

    if(isset($_GET["s_id"])){
        $s_id = $_GET["s_id"];
        $getStudent = "select * from student where studentID='{$s_id}'";
        $result=$db->query($getStudent);
        $student = $result->fetch_assoc();
        // TODO: gender to selection or option &&  program
        echo "
            <form method='post' action='#'>
                <label for='studentID'>Хувийн дугаар</label>
                <input type='text' id='studentID' name='studentID' value='{$student['studentID']}'/>
                <label for='lastName'>Нэр</label>
                <input type='text' id='lastName' name='lastName' value='{$student['lastName']}'/>
                <label for='lastName'>Овог</label>                    
                <input type='text' id='lastName' name='firstName' value='{$student['firstName']}'/>
                <label for='gender'>Хүйс</label>                                        
                <input type='text' id='gender' name='gender' value='{$student['gender']}'/>
                <label for='dob'>Төрсөн огноо</label>                                                            
                <input type='date' id='dob' name='dob' value='{$student['dob']}'/>
                <label for='programIndex'>Хөтөлбөр</label>                                        
                <input type='text' id='programIndex' name='programIndex' value='{$student['programIndex']}'/>
                <label for='gender'>Нууц үг</label>                                        
                <input type='password' id='password' name='password' value='{$student['password']}'/>
                <button name='save'>Хадгалах</button>
            </form>
        ";
        }
?>