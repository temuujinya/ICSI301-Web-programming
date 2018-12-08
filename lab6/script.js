myjson=null;
init();
function atob(aa){
    myjson =aa;
}


function init(){
    loadJSON(function (res){
        myjson = JSON.parse(res);
        displayStudents(myjson.students);
        eventListeners();
    });
    
}



function displayStudents(students){
    let studentList = document.querySelector(".studentList table");
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
        
        newUlList.appendChild(newUlItemNAME);
        newUlList.appendChild(newUlItemSISI);
        newUlList.appendChild(newUlItemPROGRAM);
        newUlList.setAttributeNode(newAttrSISI);
        studentList.appendChild(newUlList);
        length++;
    }
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
 

 function eventListeners(){
    studentList = document.querySelectorAll(".container .studentList table tr");
    studentList.forEach((e)=>{
        e.addEventListener("click",()=>{
        console.log(e.getAttribute("sisiid"));
        console.log(findStudentBySisiID(e.getAttribute("sisiid"),myjson));
    },false);
    });
}


function findStudentBySisiID(sisiID, students){
   result=students.filter((e)=>{e.sisiID ==sisiID});
    if(result.length==0){
        return -1;
    }else{
        return result;
    }
}
