<?php
include './configure/conf.php';
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
             
      0==NULL ->TRUE
      stripos (mb_stripos should be used instead)
      mb_stripos — Finds position of first occurrence of a string within another, case insensitive
      Unlike mb_strpos(), mb_stripos() is case-insensitive. If needle is not found, it returns FALSE.
      */
      if(mb_stripos($student["fname"],$studentName,0, 'UTF-8')!==false){
        $foundStudents[]=$student;
      }
    }

    if(count($foundStudents)===0){
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
  //Ингэж зарлахгүй болохоор global variable болгохгүй бол 
  //Undefined variable алдаа гараад байна
  $source="";
  $source.= "<table border='1'>
    <tr>
      <td>Sisi ID</td>
      <td>Lname</td>
      <td>Fname</td>
      <td>Program</td>
      <td>Courses</td>
    </tr>";

// function cmpAlphabetically($a,$b){
//   if ($a["lname"]==$b["lname"]) return 0;
//   return strcmp($a["lname"], $b["lname"]);
// }
// usort($array, "cmpAlphabetically");
sort($students);

  foreach($students as $student){
    
    $source .= "<tr>
                <td>".$student["sisiID"]."</td>
                <td>".$student["lname"]."</td>
                <td>".$student["fname"]."</td>
                <td>".$student["program"]."</td>
                <td>";
  
                foreach($student["courses"] as $course){
                  $source .= $courses[$course]["name"].", ";
                }
  
      $source .= "</td>";
    
  }
  $source.="</table>";
  echo $source;
}
/*
SISI ID болон сонгосон хичээлүүдийг параметртээ авч оюутны мэдээллийг 
хадгалах хүснэгтэд шинэчилж оруулдаг функц бич. Энэ функцийг дуудаж 
ажиллуулахдаа тогтмол утгаар шаардлагатай хүснэгтэн хувьсагчийг үүсгэж 
параметр болгон өөрчилнө. Функцийг туршихад тогтмол утга өгөөд шалгаж болно.
*/
function addCoursesIntoStudent($students,$studentSisiId, $studentNewCourses,$courses){
  //сиси айдигаар нь key хийж оруулсан болохоор хамаа алга
  if(array_key_exists($studentSisiId,$students)){
    foreach($studentNewCourses as $studentCourse){
      // $students[$studentSisiId]["courses"]=$studentCourse;
      array_push($students[$studentSisiId]["courses"],$studentCourse);

    }
    global $studentsFilePath;
    if(writeArrayIntoFile($studentsFilePath,$students)){
      echo "Амжилттай нэмэгдлэ";
    }
  }else{
    echo "Оюутны сиси айди буруу байна";
    exit();
  }
}


function readArrayFromFile($filePath){
  if(checkFile($filePath,'r')===true){
    return json_decode(file_get_contents($filePath), true);
  }
  
}

function writeArrayIntoFile($filePath,$array){
  if(checkFile($filePath,"w")===true){
    file_put_contents($filePath,  json_encode($array));
    return true;
  }
}



/*
  Courses, Students JSON файлуудад arrayStruct.php -г гарааны утга болгон өгөх
  функц
*/
function initFilesWithJsons(){
  include 'arrayStruct.php';
  global $studentsFilePath, $coursesFilePath;
  writeArrayIntoFile($studentsFilePath,$students);
  writeArrayIntoFile($coursesFilePath,$courses);
}

/*
Файл шалгах функц
readArrayFromFile, writeArrayIntoFile функцд файл нь байгаа эрх нь байгаа эсэхийг
шалгахад ашиглаж байгаа.
*/
function checkFile($filePath,$type){
  if(is_file($filePath)){
    if(file_exists($filePath)){
      if(stripos($type,"r")!==FAlSE){
        if(is_readable($filePath)){
          return true;
        }else{
          echo "Юу байгааг нь уншиж чдку байнашд. Тийм эрх нь ч алга.";
        }
      }else if(stripos($type,"w")!==FAlSE){
        
        if(is_writable($filePath)){
          return true;
        }else{
          echo "Надад энэ файл дээр чинь бичих эрх алгаа";
        }
      }else{
        echo "Унших гээд байна уу, бичих гээд байна уу хө?";
      }
    }else{
      echo "Ийм файл байхгүй байна";
    }
  }else{
    echo "Энэ чинь файл биш байна. <br/>";
    if(is_dir($filePath)){
      echo "директорыг би уншиж бичиж чадахгүй хө";
    }
  }
}


  ?>