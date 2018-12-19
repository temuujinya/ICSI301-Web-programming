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
                    console.log(ajaxRequest.responseXML.getElementsByTagName("response")[0].firstChild.nodeValue);
                    let res=ajaxRequest.responseXML.getElementsByTagName("response")[0].firstChild.nodeValue;
                    newel = document.getElementById("usernameDuplicate");
                        newel.innerHTML ="";
                        newel.innerText = res;
                    // document.getElementsByTagName("form").appendChild(newel);
                    usernamefield.parentNode.insertBefore(newel, usernamefield.nextElementSibling);
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




function getLessonEnrolled(user_id) {
    // ex 7 - 2.1
    var coursesTable = document.getElementById("courses-table");
    var tableText = '';
    var ajaxRequest = getXMLHttpRequest();
    var selectedCourses = [];
    var requestUrl = './include/getProgram.php';

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