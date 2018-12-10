myjson=null;
init();
// function atob(aa){
//     myjson =aa;
// }


function init(){
    loadJSON(function (res){
        myjson = JSON.parse(res);
        displayStudents(myjson.students);
        eventListeners();
    });
    
}



function displayStudents(students){
    let studentList = document.querySelector(".studentList table tbody");
    length = 0;
    while(length<students.length){
        let currentStudent = students[length];
        let newUlList = document.createElement("tr");
        let newUlItemNAME = document.createElement("td");
        newUlItemNAME.innerHTML = currentStudent.firstName;
        let newUlItemSISI = document.createElement("td");
        newUlItemSISI.innerHTML = students[length].sisiID;
        let newUlItemPROGRAM = document.createElement("td");
        newUlItemPROGRAM.innerHTML = students[length].program;
        let newAttrSISI = document.createAttribute("sisiID");
        newAttrSISI.value = currentStudent.sisiID;
        let newAttrScope = document.createAttribute("scope");
        newAttrScope.value = "row";

        newUlList.appendChild(newUlItemNAME);
        newUlList.appendChild(newUlItemSISI);
        newUlList.appendChild(newUlItemPROGRAM);
        newUlList.setAttributeNode(newAttrScope);
        newUlList.setAttributeNode(newAttrSISI);
        studentList.appendChild(newUlList);
        length++;
    }
}

function isCourseHaveFreeSeat(course){
    // res = findCourseByIndex(myjson.courses, courseIndex);
    if(!course.takenSeat)
            course.takenSeat=0;
        freeSeats = course.seats - course.takenSeat;
console.log(freeSeats);
    if(freeSeats>0){
        return true;
    }else{
        return false;
    }
}

function displayCourses(courses, studentID){
    let courseList = document.querySelector(".courseList table tbody");
    courseList.innerHTML="";
    length = 0;
    let student=findStudentBySisiID(studentID, myjson.students);
    
    while(length<courses.length){
        let currentCourse = courses[length];
        

        let newUlList = document.createElement("tr");
        let newUlItemINDEX = document.createElement("td");
        newUlItemINDEX.innerHTML = currentCourse.index;
        let newUlItemNAME = document.createElement("td");
        newUlItemNAME.innerHTML = currentCourse.name;
        let newUlItemCredit = document.createElement("td");
        newUlItemCredit.innerHTML = currentCourse.credit;

        newElementTakenInfo = document.createElement("td");
        
        let newUlItemBTN = document.createElement("td");
        // console.log(student[0].enrolled);
        let newUlItemBTNchoose = document.createElement("button");
        noseats = document.createElement("p");
        if(!student.enrolled || !isEnrolledCourse(student.enrolled, currentCourse.index)){
            newUlItemBTNchoose.innerText = "СОНГОХ"
            newUlItemBTNchoose.classList="btn btn-primary";
            if(!isCourseHaveFreeSeat(currentCourse))
                {
                    disabledBTN = document.createAttribute("disabled");
                    newUlItemBTNchoose.setAttributeNode(disabledBTN);
                    
                        noseats.innerText= "* Суудал дүүрсэн байна";
                        noseats.classList = "text-danger";
                }

        }else if(isEnrolledCourse(student.enrolled, currentCourse.index)){
            newUlItemBTNchoose.innerText = "ЦУЦЛАХ"            
            newUlItemBTNchoose.classList="btn btn-danger";
            // newUlList.appendChild(newElementTakenInfo);
            newElemetCount = document.createElement("div");
            newElemetCount.innerText ="Нийт"+currentCourse.seats+"/"+ currentCourse.takenSeat +" суусан";
            newElementTakenInfo.appendChild(newElemetCount);
        }
        newUlItemBTNchoose.id="chooseorcancel";
        newUlItemBTN.appendChild(newUlItemBTNchoose);
        let newAttrINDEX = document.createAttribute("index");
        newAttrINDEX.value = currentCourse.index;
        let newAttrScope = document.createAttribute("scope");
        newAttrScope.value = "row";

        newUlList.appendChild(newUlItemINDEX);
        newUlList.appendChild(newUlItemNAME);
        newUlList.appendChild(newUlItemCredit);
        newUlList.appendChild(newUlItemBTN);
        // newUlList.appendChild(noseats);
        newUlItemBTN.appendChild(noseats);

        if(newElementTakenInfo)
        newUlList.appendChild(newElementTakenInfo);
        newUlList.setAttributeNode(newAttrINDEX);
        newUlList.setAttributeNode(newAttrScope);
        courseList.appendChild(newUlList);
        length++;
    }


    courseList.innerHTML+="<tr><td colspan='5'><button id='confirmBTN' class='btn btn-success float-center'>БАТЛАХ</button></td></tr>";
}

/*
enrolledList - үзсэн хичээлийн индекс жагсаалт
*/
function isEnrolledCourse(enrolledList, courseIndex){
    res = enrolledList.find((e)=>{
        // console.log(e);
        return e == courseIndex;
    });

    if(res){
        return true;
    }else{
        return false;
    }
    
//    result=students.find((e)=>{
//     // console.log(e);   
//         return e.sisiID ==sisiID;
//     }
//     );

    // enrolledList.forEach((element) => {
    //     res=element.indexOf(courseIndex);
    //     if(res>=0){
    //         return true;
    //     }else
    //     {
    //         console.log("hi");
    //         return false;
    //     }    
    // });
}



function loadJSON(callback) {   

    var xobj = new XMLHttpRequest();
        xobj.overrideMimeType("application/json");
    xobj.open('GET', 'data.json', true); // Replace 'my_data' with the path to your file
    xobj.onreadystatechange = ()=> {
          if (xobj.readyState == 4 && xobj.status == "200") {
            // Required use of an anonymous callback as .open will NOT return a value but simply returns undefined in asynchronous mode
            callback(xobj.responseText);
          }
    };
    xobj.send(null);  
 }
 

selectedStudent=null;
currentStudentID=null;
choosenCredit = 0;

 /* 
 
 */
function calcCredit(enrolledList){
   summary = 0;
    enrolledList.forEach(function(e){
        summary+=findCourseByIndex(myjson.courses,e).credit;
        console.log(summary);
    });
    return summary;
}

function findCourseCreditByIndex(courseList, courseIndex){
    res = courseList.find((e)=>{
        return e.index == courseIndex;
    });
    if(res){
        return res.credit;
    }else{
        return -1;
    }
}

function addEnrolledCourse(student, courseIndex){
    let addCredit = findCourseCreditByIndex(myjson.courses,courseIndex);
    let course = findCourseByIndex(myjson.courses,courseIndex);
    console.log(addCredit);
    if(choosenCredit+addCredit>21){
        // alert("credit heterlee");
        // TODO: disappear after moment or adding close btn fix duplicate
        doc = document.querySelector(".container");
        if(!doc.querySelector("#overCredit")){
        error = document.createElement("div");
        error.classList= "alert alert-danger";
        error.id="overCredit";
        error.innerText="Кредит хэмжээ 21-с хэтэрч байгаа тул тус хичээлийг сонгох боломжгүй";
        errorCloseBTN = document.createElement("button");
            errorCloseBTN.innerText="X";
            errorCloseBTN.classList="btn btn-danger btn-sm float-right ";
        error.appendChild(errorCloseBTN);
        doc.insertBefore(error,doc.childNodes[0]); 
    }
        return false;
    }else{
        choosenCredit+=addCredit;
        student.enrolled.push(courseIndex);
        

        course.takenSeat+=1;
        return true;
    }
}

function removeEnrolledCourse(student, courseIndex){
    let removeCredit = findCourseCreditByIndex(myjson.courses,courseIndex);
    let course = findCourseByIndex(myjson.courses,courseIndex);

    student.enrolled.splice(student.enrolled.indexOf(courseIndex),1);
    choosenCredit-=removeCredit;
    course.takenSeat--;
    return true;
}


function selectedStdt(e){
    if(selectedStudent!=null && selectedStudent!=e){
        selectedStudent.classList.remove("table-info");
        selectedStudent = e;
        selectedStudent.classList.add("table-info");

        currentStudentID = e.getAttribute("sisiID");

    }else{
        selectedStudent = e;
        currentStudentID = e.getAttribute("sisiID");

        selectedStudent.classList.add("table-info");
    }
}

 function eventListeners(){
    studentList = document.querySelectorAll(".container .studentList table tr");
    studentList.forEach(function (e){
        e.addEventListener("click",()=>{

        // a = document.createAttribute("class");
        // a.value="table-info";
        // e.setAttributeNode(a);
       
        // e.classList="table-info";
        // e.classList.remove("table-info");
        selectedStdt(e);
        displayCourses(myjson.courses,e.getAttribute("sisiid"));

        student = findStudentBySisiID(currentStudentID,myjson.students);
        if(!student.enrolled){
            student.enrolled = [];
        }
        choosenCredit = calcCredit(student.enrolled);

        chooseBTN = document.querySelectorAll("#chooseorcancel");
        chooseBTN.forEach((e)=>{
            e.addEventListener("click",()=>{
                courseIndex = e.parentNode.parentNode.getAttribute("index");

                if(isEnrolledCourse(student.enrolled,courseIndex)){
                    console.log("canceled");
                    if(removeEnrolledCourse(student, courseIndex)){
                        e.classList = "btn btn-primary";
                        e.innerText = "СОНГОХ";
                    }
                }else{
                    // student.enrolled.push(courseIndex);
                    if(addEnrolledCourse(student, courseIndex)){
                        console.log("added");
                        e.classList = "btn btn-danger";
                        e.innerText = "ЦУЦЛАХ";
                    }
                }


        overCredit = document.querySelector("#overCredit");
        overCredit.addEventListener("click",()=>{
            overCredit.remove();
        },false);


            });
        });
        document.getElementById("showJSON").innerHTML="";
        confirmBTN = document.querySelector("#confirmBTN");
        confirmBTN.addEventListener("click",()=>{
            document.getElementById("showJSON").innerHTML=JSON.stringify(findStudentBySisiID(currentStudentID, myjson.students));
        },false);

        // console.log(e.getAttribute("sisiid"));
        console.log(findStudentBySisiID(e.getAttribute("sisiid"),myjson.students));
    },false);

    
    });
}

function findStudentBySisiID(sisiID, students){
/*
.find() - oldson ehnii elementiig butsaana
.filter() - shuultuuriig davj bui buh elementiig butsaana array
*/
   result=students.find((e)=>{
    // console.log(e);   
        return e.sisiID ==sisiID;
    }
    );

    if(!result){
        // console.log(students);
        return -1;

    }else{
        return result;
    }
}


function findCourseByIndex(courses, courseIndex){
    /*
    .find() - oldson ehnii elementiig butsaana
    .filter() - shuultuuriig davj bui buh elementiig butsaana array
    */
       result=courses.find((e)=>{
        // console.log(e);   
            return e.index ==courseIndex;
        }
        );
    
        if(result==0){
            // console.log(students);
            return -1;
    
        }else{
            return result;
        }
    }