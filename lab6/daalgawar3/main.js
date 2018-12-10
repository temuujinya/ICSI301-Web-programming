htmlCode = '';
html = document.getElementsByTagName("html")[0];
// console.log(html);
newDiv = document.createElement("ul");
    newDiv.id = "myUL";

find_child(html);
newDiv.innerHTML = htmlCode;

// html.getElementsByTagName("body").insertBefore(newDiv,html.firstChild);
html.getElementsByTagName("body")[0].insertBefore(newDiv,html.getElementsByTagName("body")[0].firstChild);


function find_child(element) {
    children = element.childNodes;

    if (children.length > 0) {
        children.forEach(function (child){
            // htmlCode+="<li><span class='caret'>";
            // htmlCode+="<li>";
            
                renderInfo(child);
            // htmlCode+="</span>";
            htmlCode+="<ul class='nested'>";
            find_child(child);
            htmlCode+="</ul>";
            htmlCode+="</li>";
        });
    }
    // else{
    //     htmlCode+="<li>";
    //     renderInfo(children);
    //     htmlCode+="</li>";
    // }

}

function renderInfo(element) {
    var tag = '';
    var attrs = element.attributes;
    var my_attrs = '';

    if (element.nodeName == "#text") {
        // tag = element.data;
        // console.log();
        htmlCode += "<li>"+ element.data +"</li>";
        return;
    } else {
        tag = '+' + element.tagName;
    }

    if (attrs != undefined && attrs.length > 0) {
        my_attrs += '[';
        for (i = 0; i < attrs.length; i++) {
            my_attrs += attrs[i].name + "=" + attrs[i].value + "; ";
        }
        my_attrs += ']';
    }
    htmlCode += "<li><span class='caret'>" + tag + my_attrs + "</span>";
}


var toggler = document.getElementsByClassName("caret");
    var i;
    
    for (i = 0; i < toggler.length; i++) {
      toggler[i].addEventListener("click", function() {
        this.parentElement.querySelector(".nested").classList.toggle("active");
        this.classList.toggle("caret-down");
      });
    }