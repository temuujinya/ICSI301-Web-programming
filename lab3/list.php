<?php
    require "./conf/db.php";
?>

<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Оюутны жагсаалт</title>
    <link rel="stylesheet" href="./public/style/main.css"/>
</head>
<body>
    
<?php 
    $students="select * from student";
    $result= $db->query($students);
    $render = "<table>
    <tr>
        <td>Хувийн дугаар</td>
        <td>Овог</td>
        <td>Нэр</td>
        <td>Хүйс</td>
        <td>Төрсөн огноо</td>
        <td>Хөтөлбөр</td>
        <td></td>
    </tr>";

    while($student = $result->fetch_assoc()){
        $tempStudent = $student;
        $render.= "<tr>
                <td>{$tempStudent["studentID"]}</td>
                <td>{$tempStudent["lastName"]}</td>
                <td>{$tempStudent["firstName"]}</td>
                <td>{$tempStudent["gender"]}</td>
                <td>{$tempStudent["dob"]}</td>
                <td>{$tempStudent["programIndex"]}</td>
                <td>
                    <form method='get' action='edit.php?s_id={$tempStudent["studentID"]}'>
                        <button>Засах</button>
                    </form>
                    <form method='get' action='delete.php'>
                        <button name='s_id' value='{$tempStudent["studentID"]}'>Устгах</button>
                    </form>
                </td>
            </tr>";
    }
    $render.="</table>";
    echo $render;
?>

</body>
</html>