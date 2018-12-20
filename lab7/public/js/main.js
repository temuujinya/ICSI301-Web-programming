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
    // var myvar='<?php findStudentProgramByID($_SESSION[\'studentID\']); ?>';
    getStudentsOfProgram('<?php echo $studentPro; ?>');

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










function confirmLesson(user_id, selectedCourses) {
    var confirmInfo = {
        [user_id]: selectedCourses,
    };

    var confirmBox = document.getElementById('confirm_box');
    var ajaxRequest = getXMLHttpRequest();
    var requestUrl = './ajax.php';

    if (ajaxRequest) {
        ajaxRequest.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                confirmBox.innerHTML = this.responseText;
            } else {
                return;
            }
        };
        ajaxRequest.open('POST', requestUrl, true);
        ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajaxRequest.send('confirm=' + JSON.stringify(confirmInfo));
    }
}

function getLessonEnrolled(user_id) {
    // ex 7 - 2.1
    var coursesTable = document.getElementById("courses-table");
    var tableText = '';
    var ajaxRequest = getXMLHttpRequest();
    var selectedCourses = [];
    var requestUrl = './include/verifycourse.php';

    if (ajaxRequest) {
        ajaxRequest.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var returnJSON = JSON.parse(this.responseText);
                var course_enrollments = returnJSON.course_enrollments;
                var courses = returnJSON.courses;

                course_enrollments.forEach((enrolled_course) => {
                    courses.filter((course) => {
                        if (course['course_id'] == enrolled_course['course_id']) {
                            selectedCourses.push(course['course_id']);
                            tableText += `
                            <tr class="table-success">
                                <th scope="row">${course["course_id"]}</th>
                                <td>${course["course_name"]}</td>
                                <td>${course["credit"]}</td>
                                <td><input name="courses[]" checked type="checkbox" value="${course["course_id"]}" />
                            </tr>`;
                        }
                    });
                });

                courses.forEach((course) => {
                    if (!selectedCourses.includes(course['course_id'])) {
                        tableText += `
                            <tr>
                                <th scope="row">${course["course_id"]}</th>
                                <td>${course["course_name"]}</td>
                                <td>${course["credit"]}</td>
                                <td><input name="courses[]" type="checkbox" value="${course["course_id"]}" />
                            </tr>`;
                    }
                });
                coursesTable.innerHTML = tableText;

                // ex 7 - 2.2        
                var confirm = document.getElementById('confirm');
                confirm.addEventListener('click', () => {
                    confirmLesson(user_id, selectedCourses);
                });

            } else {
                return;
            }
        };
        ajaxRequest.open('POST', requestUrl, true);
        ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajaxRequest.send('student_id=' + user_id);
    }
}

function getProgramCourse(user_id) {
    // ex 7 - 2.1
    var coursesTable = document.getElementById("courses-table");
    var tableText = '';
    var ajaxRequest = getXMLHttpRequest();
    var selectedCourses = [];
    var requestUrl = './include/verifycourse.php';

    if (ajaxRequest) {
        ajaxRequest.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseXML;
                var course_enrollments = data.getElementsByTagName('course_enrollments')[0].getElementsByTagName('course_id');
                var courses = data.getElementsByTagName('courses')[0].getElementsByTagName('course');

                console.log();

                Array.from(course_enrollments).forEach((enrolled) => {
                    selectedCourses.push(enrolled.textContent);
                });

                Array.from(courses).forEach((course) => {
                    var course_id = course.getElementsByTagName('course_id')[0].textContent;
                    var course_name = course.getElementsByTagName('course_name')[0].textContent;
                    var credit = course.getElementsByTagName('credit')[0].textContent;
                    if (selectedCourses.includes(course_id)) {
                        tableText += `
                            <tr class="table-success">
                                <th scope="row">${course_id}</th>
                                <td>${course_name}</td>
                                <td>${credit}</td>
                                <td><input name="courses[]" checked type="checkbox" value="${course_id}" />
                            </tr>`;
                    } else {
                        tableText += `
                            <tr>
                                <th scope="row">${course_id}</th>
                                <td>${course_name}</td>
                                <td>${credit}</td>
                                <td><input name="courses[]" type="checkbox" value="${course_id}" />
                            </tr>`;
                    }
                });
                coursesTable.innerHTML = tableText;
            } else {
                return;
            }
        };
        ajaxRequest.open('POST', requestUrl, true);
        ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajaxRequest.send('student_id=' + user_id + '&xml=true');
    }
}



function refreshCaptcha() {
    var captcha_code = document.getElementById('captcha_code');
    var ajaxRequest = getXMLHttpRequest();
    var requestUrl = './include/captcha.php';

    if (ajaxRequest) {
        ajaxRequest.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this)
                captcha_code.setAttribute('src', './include/captcha.php');
            } else {
                return;
            }
        };
        ajaxRequest.open('GET', requestUrl, true);
        ajaxRequest.send(null);
    }
}








function getCoursesOfProgram(index)   //  The main JavaScript for calling the update. 
{
    console.log(index);
    ajaxRequest = getXMLHttpRequest();
    if (!ajaxRequest)  {
            document.getElementById("showtime").innerHTML = "Request error!";
            return;      }
    var myURL = "include/getCoursesByProgram.php";
    myURL = myURL + "?program=" + index;
    ajaxRequest.onreadystatechange = courseProgramsResponse;
    ajaxRequest.open("GET", myURL);
    ajaxRequest.send(null);
}


function courseProgramsResponse()  //This gets called when the readyState changes.
{
    if (ajaxRequest.readyState != 4)  //  check to see if we're done
        {  return;  }
    else {
        if (ajaxRequest.status == 200) //  check to see if successful
            {   
                    

                    // let program = document.getElementById("programs-table");
                    // if(program){
                        // console.log(ajaxRequest.response);
                        let students = JSON.parse(ajaxRequest.response);
                        displayProgramCourses(students);
                    // }
                }
                
        else {
        alert("Request failed: " + ajaxRequest.statusText);
            }
        }
}


function displayProgramCourses(students){
    var studentList = document.querySelector(".studentList table tbody");
    // length = 0;
    studentList.innerHTML="";
    console.log(students);
    // while(length<students.length){
        for(index in students){
        let currentStudent = students[index];
        
        let newUlList = document.createElement("tr");
        let newUlItemLastNAME = document.createElement("td");
        newUlItemLastNAME.innerHTML = students[index].cindex;
        console.log(currentStudent);  
        let newUlItemNAME = document.createElement("td");
        newUlItemNAME.innerHTML = currentStudent.cname;
        let newUlItemSISI = document.createElement("td");
        newUlItemSISI.innerHTML = currentStudent.ccredit;

        newUlList.appendChild(newUlItemNAME);
        newUlList.appendChild(newUlItemLastNAME);
        newUlList.appendChild(newUlItemSISI);
        studentList.appendChild(newUlList);
        // studentList.innerHTML="dd";
        // length++;
    }

}