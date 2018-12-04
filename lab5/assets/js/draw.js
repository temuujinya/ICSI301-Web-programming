// if(document.readyState =='interactive'){
colorClasses = ["bg-yellow", "bg-red", "bg-black", 
"bg-lightgreen", "bg-blue"];
let inCorrect=[[]];
// error.push([1])
// let smile=[
//     ["","bg-yellow","bg-yellow","bg-yellow","bg-yellow","bg-yellow",""],
//     ["bg-yellow","","","","","","bg-yellow"],
//     ["bg-yellow","","bg-black","","bg-black","","bg-yellow"],
//     ["bg-yellow","","","","","","bg-yellow"],
//     ["bg-yellow","","","","","","bg-yellow"],
//     ["bg-yellow","","bg-red","bg-red","bg-red","","bg-yellow"],
//     ["bg-yellow","","","","","","bg-yellow"],
//     ["","bg-yellow","bg-yellow","bg-yellow","bg-yellow","bg-yellow",""],
// ];

let smile=[
    [-1,0,0,0,0,0,-1],
    [0,-1,-1,-1,-1,-1,0],
    [0,-1,2,-1,2,-1,0],
    [0,-1,-1,-1,-1,-1,0],
    [0,-1,-1,-1,-1,-1,0],
    [0,-1,1,1,1,-1,0],
    [0,-1,-1,-1,-1,-1,0],
    [-1,0,0,0,0,0,-1,]
];

let userinput=[
    [-1,-1,-1,-1,-1,-1,-1],
    [-1,-1,-1,-1,-1,-1,-1],
    [-1,-1,-1,-1,-1,-1,-1],
    [-1,-1,-1,-1,-1,-1,-1],
    [-1,-1,-1,-1,-1,-1,-1],
    [-1,-1,-1,-1,-1,-1,-1],
    [-1,-1,-1,-1,-1,-1,-1],
    [-1,-1,-1,-1,-1,-1,-1],
];

function drawMission(drawField,missionArr){
    draw = document.querySelector(drawField)

    for(let i=0; i<smile.length;i++){
        s = document.createElement("tr");
        for(let j=0; j<smile[i].length;j++){
            tdata = document.createElement("td");
            tdataAttr = document.createAttribute("number");
            tdataAttr.value= i*10+j;
            tdata.setAttributeNode(tdataAttr);
            if(missionArr != undefined)
            tdata.className = findColorClass(smile[i][j]);
            
            s.appendChild(tdata);
        }
        draw.appendChild(s);
    }
}

drawMission("#challenge #mission tbody",smile);
drawMission("#challenge #userBoard tbody");




// bg-yellow
// bg-red
// bg-black
// bg-lightgreen
// bg-blue
function findColorClass(colorNumber){
    switch(colorNumber){
        case 0: 
            return colorClasses[colorNumber];
            break;
        case 1: 
            return colorClasses[colorNumber];
            break;
        case 2: 
            return colorClasses[colorNumber];
            break;
        case 3: 
            return colorClasses[colorNumber];
            break;
        case 4: 
            return colorClasses[colorNumber];
            break;
        default: return " ";break;
    }
}


function checkCorrectColor(missionArr){
    if(JSON.stringify(missionArr)===JSON.stringify(userinput)){
        // if(inCorrect!==false)
        // inCorrect=true;
        alert("hojloo");
        document.location.reload();
    }else{
        console.log("loose");
        alert("looser");
        document.location.reload();
    }
    console.log(inCorrect);
}

let currentColor = null;

let userBoard = document.querySelectorAll("#challenge #userBoard tbody tr td");

userBoard.forEach((onePixel)=>{
    onePixel.addEventListener("click",(e)=>{
        colorNumber=parseInt(currentColor);
        pixelNumber = parseInt(onePixel.getAttribute("number"));
        if(currentColor!=null){
            onePixel.classList=findColorClass(colorNumber);
            userinput[parseInt(pixelNumber/10)][parseInt(pixelNumber%10)]=colorNumber;
            // checkCorrectColor(smile);            
        }else{
            alert("Өнгөө сонго ");
        }
        
    },false);
    onePixel.addEventListener("dblclick", ()=>{
        colorNumber=parseInt(currentColor);
        pixelNumber = parseInt(onePixel.getAttribute("number"));
        if(onePixel.classList!=null){
            onePixel.classList="";
            userinput[parseInt(pixelNumber/10)][parseInt(pixelNumber%10)]=-1;
        }
    },false);
});


let colorBtns = document.querySelectorAll(".color-btn");

colorBtns.forEach((colorBtn)=>{
    colorBtn.addEventListener("click",()=>{
        currentColor = colorBtn.getAttribute("colorCode");
    },false)
})

gametime=30;
seconds =gametime;
startbtn = document.getElementById("startBTN");

var myVar = null;
function myTimer() {
    if(seconds===0 || seconds<=0){
        checkCorrectColor(smile);
        clearInterval(myVar);
    }
    document.getElementById("timer").innerHTML = seconds;
    --seconds;
}

startbtn.addEventListener("click",()=>{
    if(myVar!==null){
        clearInterval(myVar);
    }
    seconds=gametime;
    myVar = setInterval(myTimer, 1000);
},false);



// }