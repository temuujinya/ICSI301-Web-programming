<?php
    include_once __DIR__."/include/partials/header.php";
?>

<?php 
    $students="select * from student";
    $result= mysqli_query($db, $students);
    $render = "<a href='./insert.php'>Оюутан нэмэх</a>";
    $render .= "<table>
        <tr>
            <td>Хувийн дугаар</td>
            <td>Овог</td>
            <td>Нэр</td>
            <td>Хүйс</td>
            <td>Төрсөн огноо</td>
            <td>Хөтөлбөр</td>
            <td></td>
        </tr>";

    while($student = mysqli_fetch_assoc($result)){
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
    //free result set
    mysqli_free_result($result);
    $render.="</table>";
    echo $render;
?>
<?php
    include "./include/partials/footer.php";
?>