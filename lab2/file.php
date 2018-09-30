<?php 
$courses = [
    "ICSI201"=>[
    "name"=>"Объект хандалтат програмчлал",
    "ID"=>"ICSI201",
    "credit"=>3
    ],
    "ICSI202"=>[
    "name"=>"WOW32",
    "ID"=>"ICSI202",
    "credit"=>3
    ],
];
$f = "./students.txt";
// $f1 = fopen($f, "w");
// fwrite($f1,var_export($courses,true));
// fclose($f1);
// file_put_contents($f,  '<?php return ' . var_export($courses, true) . ';');

function readStudentsArrayFromFile($filePath){
    return json_decode(file_get_contents($filePath), true);
}

function readCoursesArrayFromFile($filePath){
    return json_decode(file_get_contents($filePath), true);
}

function writeStudentsArrayIntoFile($filePath,$students){
    file_put_contents($filePath,  json_encode($students));
}

function writeCoursesArrayIntoFile($filePath,$courses){
    file_put_contents($filePath,  json_encode($courses));
}


// file_put_contents($f,  json_encode($courses));
// $aaa = json_decode(file_get_contents($f), true);
$aaa = readArrayFromFile($f);
print_r($aaa);
// print_r($courses);

echo $aaa['ICSI201']['name'];



//for read little files
// $fContent = file_get_contents($f); 
// file_put_contents($f,file_get_contents($f),FILE_APPEND);

/*
If the file doesn’t exist, the filesize() function will 
return false and emit an E_WARNING, so it’s better to 
check first whether the file exists using the function 
file_exists():
*/
$dateFormat = "Y / M / d(D) g:i A";
//file accessed time
$atime = fileatime($f);
//file modified time
$mtime = filemtime($f);
//file created time
$ctime = filectime($f);

if(is_file($f)){
    if(file_exists($f)){
        if(is_readable($f)){
            if(is_writable($f)){
                $size =  filesize($f);
                echo $f ." is ". $size . " bytes <br/>";
                echo "accessed time ->".date($dateFormat,$atime)."<br/>";
                echo "modified time ->".date($dateFormat,$mtime)."<br/>";
                echo "created time ->".date($dateFormat,$ctime)."<br/>";
                // echo $fContent;
                // do{
                //     //To read from the opened file one line at a time, use the function fgets():
                //     echo fgets($f1)."<br/>";
                // //The function feof() checks whether the file has reached its end
                // }while(!feof($f1));

                fclose($f1);
            }else{
                echo "you don't have permission to write";
            }
        }else{
            echo "you don't hacve permission to read";
        }
    }else{
        echo $f." file doesn't exist.";
    }
}else{
    echo "it isn't file";
    if(is_dir($f)){
        echo "<br/>it's directory";
    }
}

?>