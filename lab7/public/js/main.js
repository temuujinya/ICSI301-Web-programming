let ajaxRequest;

function getXMLHttpRequest() {
    /*   This function attempts to get an Ajax request object by trying
         a few different methods for different browsers.  */
       var request, err;
       try {
         request = new XMLHttpRequest();   // Firefox, Safari, Opera, etc.
       }
       catch(err) {
           try {             //  first attempt for Internet Explorer
              request = new ActiveXObject("MSXML2.XMLHttp.6.0");
           }
           catch (err) {
                          try {    //  second attempt for Internet Explorer
                            request = new ActiveXObject("MSXML2.XMLHttp.3.0");
                          }
                          catch (err) {
                            request = false;  // oops, can’t create one!  
                          }
            }
        }
       return request;  
}

function ajaxResponse()  //This gets called when the readyState changes.
{
    if (ajaxRequest.readyState != 4)  //  check to see if we're done
        {  return;  }
    else {
        if (ajaxRequest.status == 200) //  check to see if successful
            {   
                    let usernamefield = document.getElementById("username");    
                    // console.log(ajaxRequest.responseXML.getElementsByTagName("response")[0].firstChild.nodeValue);
                    if(usernamefield)
                    {let res=ajaxRequest.responseXML.getElementsByTagName("response")[0].firstChild.nodeValue;
                    if(res){
                        newel = document.getElementById("usernameDuplicate");
                            newel.innerHTML ="";
                            newel.innerText = res;
                        // document.getElementsByTagName("form").appendChild(newel);
                        usernamefield.parentNode.insertBefore(newel, usernamefield.nextElementSibling);
                    }
                }
                }
        else {
        alert("Request failed: " + ajaxRequest.statusText);
            }
        }
}
function getServerTime()   //  The main JavaScript for calling the update. 
{
    ajaxRequest = getXMLHttpRequest();
    if (!ajaxRequest)  {
            document.getElementById("showtime").innerHTML = "Request error!";
            return;      }
    var myURL = "include/checkUsername.php";
    var myRand = document.getElementById("username").value;
    console.log(myRand);
    myURL = myURL + "?username=" + myRand;
    ajaxRequest.onreadystatechange = ajaxResponse;
    ajaxRequest.open("GET", myURL);
    ajaxRequest.send(null);
}
let usernamefield = document.getElementById("username");
if(usernamefield)
{
usernamefield.addEventListener("keyup",()=>{
    getServerTime();
})}
// usernamefield.addEventListener("change",()=>{
//     getServerTime();
// })



function programsStudentResponse()  //This gets called when the readyState changes.
{
    if (ajaxRequest.readyState != 4)  //  check to see if we're done
        {  return;  }
    else {
        if (ajaxRequest.status == 200) //  check to see if successful
            {   
                    

                    let program = document.getElementById("programs-table");
                    if(program){
                        // console.log(ajaxRequest.response);
                        let students = JSON.parse(ajaxRequest.response);
                        displayStudents(students);
                    }
                }
                
        else {
        alert("Request failed: " + ajaxRequest.statusText);
            }
        }
}

function getStudentsOfProgram(index)   //  The main JavaScript for calling the update. 
{
    ajaxRequest = getXMLHttpRequest();
    if (!ajaxRequest)  {
            document.getElementById("showtime").innerHTML = "Request error!";
            return;      }
    var myURL = "include/getStudentByProgram.php";
    myURL = myURL + "?program=" + index;
    ajaxRequest.onreadystatechange = programsStudentResponse;
    ajaxRequest.open("GET", myURL);
    ajaxRequest.send(null);
}

let programsTable = document.getElementById("programs-table");
if(programsTable){
    let table = document.querySelectorAll("#programs-table table tbody tr");
    table.forEach((e)=>{
        e.addEventListener('click',()=>{
            let pIndex=e.querySelector("th").getAttribute("pindex");
            getStudentsOfProgram(pIndex);
        });
    });
}




function displayStudents(students){
    var studentList = document.querySelector(".studentList table tbody");
    // length = 0;
    studentList.innerHTML="";
    console.log(students);
    // while(length<students.length){
        for(index in students){
        let currentStudent = students[index];
        
        let newUlList = document.createElement("tr");
        let newUlItemLastNAME = document.createElement("td");
        newUlItemLastNAME.innerHTML = students[index].lname;
        console.log(currentStudent);  
        let newUlItemNAME = document.createElement("td");
        newUlItemNAME.innerHTML = currentStudent.fname;
        let newUlItemSISI = document.createElement("td");
        newUlItemSISI.innerHTML = currentStudent.id;
        let newUlItemPROGRAM = document.createElement("td");
        newUlItemPROGRAM.innerHTML = currentStudent.dob;
        let newAttrSISI = document.createAttribute("sisiID");
        newAttrSISI.value = currentStudent.id;
        let newAttrScope = document.createAttribute("scope");
        newAttrScope.value = "row";

        newUlList.appendChild(newUlItemNAME);
        newUlList.appendChild(newUlItemLastNAME);
        newUlList.appendChild(newUlItemSISI);
        newUlList.appendChild(newUlItemPROGRAM);
        newUlList.setAttributeNode(newAttrScope);
        newUlList.setAttributeNode(newAttrSISI);
        studentList.appendChild(newUlList);
        // studentList.innerHTML="dd";
        // length++;
    }

}