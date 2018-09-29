<?php

/*
Оюутны хүснэгт, оюутны нэрийг параметр болгон авч оюутны нэрээр хайж тохирох оюутны/оюутнуудын 
мэдээллийг бүхэлд (хүснэгтийн нэгж элементээр) нь буцаадаг функц бич. Хайх оюутны нэр нь заавал 
бүрэн байх албагүй бөгөөд тухайн үг, үсэг оролцсон ойролцоо нэртэй оюутны/оюутнуудын мэдээллийг 
буцаадаг байна.
*/
function findStudentByName($students,$studentName){
  if($studentName != NULL){
    $foundStudents=[];
    foreach($students as $student){
      /*
        stripos is like strpos but case-insensitive
        Find the position of the first occurrence of a case-insensitive substring in a string
        Return Values
          Returns the position of where the needle exists relative to the beginnning of the haystack 
          string (independent of offset). Also note that string positions start at 0, and not 1.
          Returns FALSE if the needle was not found.
      */        
      //0==NULL ->TRUE
      if(stripos($student["fname"],$studentName)!==false){
        echo $studet["fname"];
        $foundStudents[]=$student;
      }
    }

    if(count($foundStudents)==NULL){
      echo "Ийм нэртэй оюутан байхгүй";
      return 0;
    }
  }
  else{
    echo "Оюутны нэр оруул.";
    return 0;
  }
    return $foundStudents;
  }
  
  
/*
Оюутны хүснэгтийг параметртээ авч бүх оюутны мэдээллийг харгалзах сонгосон 
хичээлүүдтэй хамт жагсаан харуулах HTML кодыг үүсгэдэг функц бич. Жагсаан 
харуулахдаа оюутны нэрээр А-Я үсгийн дарааллаар эрэмбэлж харуулна. Үүний 
тулд хүснэгтийн утгуудыг эрэмбэлэх нэргүй (anonymous function - [2] номын 
74-р хуудас, 134-139-р хуудас) функцийг ашигла. usort, uasort, uksort 
функцүүдийг судлах шаардлагатай. Энэ даалгаварт ямар нэг байдлаар хэрэглэгчээс 
утга авах шаардлагагүй. Функцийн ажиллагааг шалгахын тулд тогтмол утгууд 
өгч болно.
*/
function displayStudentsInformation($students,$courses){
  echo "
  <table border='1'>
    <tr>
      <td>Sisi ID</td>
      <td>Lname</td>
      <td>Fname</td>
      <td>Program</td>
      <td>Courses</td>
    </tr>
      ";
  
  foreach($students as $student){
    $html .= "<tr>
                <td>".$student["sisiID"]."</td>
                <td>".$student["lname"]."</td>
                <td>".$student["fname"]."</td>
                <td>".$student["program"]."</td>
                <td>";
  
                foreach($student["courses"] as $course){
                  $html .= $courses[$course]["name"].", ";
                }
  
      $html .= "</td>";
    
  }
  echo $html.="</table>";
  
}
/*
SISI ID болон сонгосон хичээлүүдийг параметртээ авч оюутны мэдээллийг 
хадгалах хүснэгтэд шинэчилж оруулдаг функц бич. Энэ функцийг дуудаж 
ажиллуулахдаа тогтмол утгаар шаардлагатай хүснэгтэн хувьсагчийг үүсгэж 
параметр болгон өөрчилнө. Функцийг туршихад тогтмол утга өгөөд шалгаж болно.
*/
function addCoursesIntoStudent($students,$studentSisiId, $studentNewCourses,$courses){
  if(array_key_exists($studentSisiId,$students)){
    foreach($studentNewCourses as $studentCourse){
      // $students[$studentSisiId]["courses"]=$studentCourse;
      array_push($students[$studentSisiId]["courses"],$studentCourse);

    }
    displayStudentsInformation($students,$courses);
  }else{
    echo "Оюутны сиси айди буруу байна";
    exit();
  }
}

  ?>