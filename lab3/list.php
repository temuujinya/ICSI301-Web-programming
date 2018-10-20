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
        $render.= "<tr>
                <td>{$student["studentID"]}</td>
                <td>{$student["lastName"]}</td>
                <td>{$student["firstName"]}</td>
                <td>{$student["gender"]}</td>
                <td>{$student["dob"]}</td>
                <td>{$student["programIndex"]}</td>
                <td>
                    <form method='get' action='edit.php?s_id={$student["studentID"]}'>
                        <button>Засах</button>
                    </form>
                    <form method='get' action='delete.php'>
                        <button name='s_id' value='{$student["studentID"]}'>Устгах</button>
                    </form>
                    <a href='delete.php?s_id={$student["studentID"]}'>del</a>
                </td>
            </tr>";
    }
    $render.="</table>";
    echo $render;
?>

</body>
</html>