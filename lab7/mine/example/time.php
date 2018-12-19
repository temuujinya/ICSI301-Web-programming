<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <style>
    body{
        background-color: #CCCCCC;
        text-align: center;
    }
    .displaybox{
        margin: auto;
        width: 150px;
        background-color: #FFFFFF;
        border: 2px solid #000;
        padding: 10px;
        font: 1.5em normal verdana, helvetica, arial, sans-serif;
    }
    </style>
    <script async>
    var ajaxRequest;

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
                   document.getElementById("showtime").innerHTML =              
                                 ajaxRequest.responseText; }
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
   var myURL = "servertime.php";
   var myRand = parseInt(Math.random()*999999999999999);
   myURL = myURL + "?rand=" + myRand;
   ajaxRequest.onreadystatechange = ajaxResponse;
   ajaxRequest.open("GET", myURL);
   ajaxRequest.send(null);
}
    </script>
</head>
<body onLoad="getServerTime()">
<h1>Ajax Demonstration</h1>

<h2>Getting the server time without refreshing the page</h2>

<form>
   <input type="button" value="Get Server Time" onClick="getServerTime()" />
</form>
<div id="showtime" class="displaybox"></div>

</body>
</html>
</html>