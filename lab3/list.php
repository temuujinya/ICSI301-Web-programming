<?php
    include "./conf/partials/header.php";
?>

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
                    <form method='get' action='update.php'>
                        <button name='s_id' value='{$tempStudent["studentID"]}'>Засах</button>
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
<?php
    include "./conf/partials/footer.php";
?>