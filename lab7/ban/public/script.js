
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
            {   displaySearchResults();   }
       else {
         alert("Request failed: " + ajaxRequest.statusText);
            }
    }
}

function searchName() {
    ajaxRequest = getXMLHttpRequest();
    if (!ajaxRequest)  alert("Request error!");
    let myURL = "livesearchXML.php";
    let query = document.getElementById("searchstring").value;
    myURL = myURL + "?query=" + query;
    ajaxRequest.onreadystatechange = ajaxResponse;
    ajaxRequest.open("GET", myURL);
    ajaxRequest.send(null);
 }
  