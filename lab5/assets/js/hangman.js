live = 5;
currentQuestion =0;

question=[
    ["How many states in USA?","fifty","10"],
    ["Who won the 2016 Election?","donald trump","10"],
    ["What is the capital of America?","Washington DC","20"],
    ["Who is the third President of USA?","Thomas Jefferson","30"]
];

questionField = document.getElementById("question");

function isContain(key){
    let locations=[],i=-1;
    while((i=question[currentQuestion][1].indexOf(key,i+1))>=0){
       locations.push(i); 
    }
    return locations;
}

function drawAnswerField(){
    length = question[currentQuestion][1].length;
    index=0;
    answerField = document.getElementById("answer");
    answerField.innerHTML="";
    while(index<length){
    // answerField.innerHTML= question[currentQuestion][1];
        answerKey = document.createElement("div");
        answerKey.classList="answerkey";
        // answerKey.innerHTML = question[currentQuestion][1][index];
        answerField.appendChild(answerKey);
    index++;
    }
}

startBTN = document.getElementById("startgame");
restartBTN = document.getElementById("restartgame");





startBTN.addEventListener("click",()=>{
    currentQuestion = Math.floor(Math.random()*question.length);
    questionField.innerHTML = question[currentQuestion][0];
    drawAnswerField();
    startBTN.style.display="none";
    restartBTN.style.visibility="visible";
    window.addEventListener("keydown",(e)=>{
        console.log(
            isContain(e.key));
        locations = isContain(e.key);
        if(locations.length>0){
            console.log("hwllo");
        }


answerField = document.getElementById("answer");
console.log(answerField.child(1));
        // console.log(locations == []);
    },false);

},false);

restartBTN.addEventListener("click",()=>{
    document.location.reload();
},false);