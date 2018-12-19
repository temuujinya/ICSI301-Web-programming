
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

function ajaxResponse() {
    //This gets called when the readyState changes.
     if (ajaxRequest.readyState != 4)  //  check to see if we're done
        {  return;  }
     else {
       if (ajaxRequest.status == 200) //  check to see if successful
            {   
              let res = ajaxRequest.responseXML.getElementsByTagName("found")[0].childNodes[0].data;
              if(res=="false"){
                let field = document.querySelector("#username");

                newChild = document.createElement("div");
                  newChild.innerHTML ="YES U CAN USE IT";
                field.parentElement.appendChild(newChild);
              }else{
                let field = document.querySelector("#username");

                newChild = document.createElement("div");
                  newChild.innerHTML ="CHOOSE DIFF NAME";
                field.parentElement.appendChild(newChild);

              }
            }
       else {
         alert("Request failed: " + ajaxRequest.statusText);
            }
    }
}

function searchName(username) {
    ajaxRequest = getXMLHttpRequest();
    if (!ajaxRequest)  alert("Request error!");
    let myURL = "./include/checkUsername.php";
    myURL = myURL + "?username=" + username;
    ajaxRequest.onreadystatechange = ajaxResponse;
    ajaxRequest.open("GET", myURL);
    ajaxRequest.send(null);
 }

usernamefield = document.getElementById("username");
usernamefield.addEventListener("keyup",function (){
  searchName(this.value);
  // console.log(this.value);
});
  
