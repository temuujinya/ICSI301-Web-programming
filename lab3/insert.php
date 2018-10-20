<?php
    include __DIR__."/conf/partials/header.php";
    if(isset($_POST['insert'])){
        $insert = $db->prepare("insert into student (studentID, lastName, firstName, gender,
                        dob, programIndex,password) values (?,?,?,?,?,?,?)");

        $insert->bind_param('sssssss',
                            $_POST['studentID'],
                            $_POST['lastName'],
                            $_POST['firstName'],
                            $_POST['gender'],
                            $_POST['dob'],
                            $_POST['programIndex'],
                            $_POST['password']);
        $status=$insert->execute();
        if($status === false){
            trigger_error($insert->error, E_USER_ERROR);
        }

        header("Location: ./list.php");
        exit();
    }
    // TODO: gender to selection or option &&  program
    echo "
        <form method='post' action='#'>
            <label for='studentID'>Хувийн дугаар</label>
            <input type='text' id='studentID' name='studentID' placeholder=''/>
            <label for='lastName'>Нэр</label>
            <input type='text' id='lastName' name='lastName' placeholder=''/>
            <label for='lastName'>Овог</label>                    
            <input type='text' id='lastName' name='firstName' placeholder=''/>
            <label for='gender'>Хүйс</label>                                        
            <input type='text' id='gender' name='gender' placeholder=''/>
            <label for='dob'>Төрсөн огноо</label>                                                            
            <input type='date' id='dob' name='dob' placeholder=''/>
            <label for='programIndex'>Хөтөлбөр</label>                                        
            <input type='text' id='programIndex' name='programIndex' placeholder=''/>
            <label for='gender'>Нууц үг</label>                                        
            <input type='password' id='password' name='password' placeholder=''/>
            <button name='insert'>Хадгалах</button>
        </form>
    ";

?>