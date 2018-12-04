live = 5;
currentQuestion =0;
imagePos = 0;
question=[
    ["How many states in USA?","fifty","10"],
    ["Who won the 2016 Election?","donald trump","10"],
    ["What is the capital of America?","Washington DC","20"],
    ["Who is the third President of USA?","Thomas Jefferson","30"]
];

images=[
    ["hangman0.png"],
    ["hangman1.png"],
    ["hangman2.png"],
    ["hangman3.png"],
    ["hangman4.png"],
    ["hangman0.png"]
];

currentAnswer  = "";

questionField = document.getElementById("question");

function isContain(key){
    let locations=[],i=-1;
    while((i=question[currentQuestion][1].toLowerCase().indexOf(key,i+1))>=0){
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

livecountlabel = document.getElementById("livecountlabel");
startBTN = document.getElementById("startgame");
restartBTN = document.getElementById("restartgame");

function replaceAt(string, index, replace) {
    return string.substring(0, index) + replace + string.substring(index + 1);
  }

function displayAnswer(key,locations){
    answerField = document.getElementById("answer");
    length = locations.length;
    index = 0;

    while(index<length){
        answerField.childNodes[locations[index]].innerHTML=key;
        // currentAnswer.replaceAt(parseInt(locations[index]),key);
       currentAnswer = replaceAt(currentAnswer, locations[index],key);
        index++;
    }
}

function displayLive(){
    liveCount = document.getElementById("liveCount");
    liveCount.innerHTML = live;
}



function isComplete(currentQuestion){
    if(currentAnswer === question[currentQuestion][1].toLowerCase() ){
        question.splice(currentQuestion,1);
        gameinit();
    }
}
seconds =0;

var myVar = null;
function myTimer() {
    if(seconds===0 || seconds<=0){
        // checkCorrectColor(smile);
        clearInterval(myVar);
        alert("looser");
    }
    
    isComplete(currentQuestion);
    document.getElementById("timer").innerHTML = seconds;
    --seconds;
}

function gameinit(){
    currentAnswer="";
    if(myVar!==null){
        clearInterval(myVar);
    }
    myVar = setInterval(myTimer, 1000);
    if(question.length==0){
        alert("you win");
    }else{
        currentQuestion = Math.floor(Math.random()*question.length);
    }
    seconds= question[currentQuestion][2];
    // currentAnswer = question[currentQuestion][1].toLowerCase();
    fillZero(question[currentQuestion][1].length);
    console.log(currentAnswer);
    questionField.innerHTML = question[currentQuestion][0];
    drawAnswerField();
}

function checkLive(live){
    if(live>0){
        return true;
    }
    else{
        return false;
    }
}

function fillZero(length){
    i=0;
    while(i<length){
        currentAnswer+=" ";
        i++;
    }
}


startBTN.addEventListener("click",()=>{
    
    // if(myVar!==null){
    //     clearInterval(myVar);
    // }
    // myVar = setInterval(myTimer, 1000);

    // currentQuestion = Math.floor(Math.random()*question.length);
    // seconds= question[currentQuestion][2];
    // // currentAnswer = question[currentQuestion][1].toLowerCase();
    // fillZero(question[currentQuestion][1].length);
    // console.log(currentAnswer);
    // questionField.innerHTML = question[currentQuestion][0];
    // drawAnswerField();
    gameinit();
    if(live>0){
        displayLive();}
    else{
        alert("ami duuslaa");
    }
    livecountlabel.style.display="block";
    startBTN.style.display="none";
    restartBTN.style.visibility="visible";
    window.addEventListener("keydown",(e)=>{
        
        
        console.log(
            isContain(e.key));
        locations = isContain(e.key);
        if(locations.length>0){
            displayAnswer(e.key, locations);
        }else{
            live--;
            imagePos++;
            gamestaus = document.getElementById("gamestatus");
            gamestaus.style.backgroundImage = "url('assets/img/hangman/"+images[imagePos]+"')";
            if(checkLive(live)){
                displayLive();}
            else{
                alert("ami duuslaa");
                clearInterval(myVar);
            }

            //end ami hasah
        }

// answerField = document.getElementById("answer");
// console.log(answerField.childNodes[0].innerHTML="f");
        // console.log(locations == []);
    },false);

},false);

restartBTN.addEventListener("click",()=>{
    document.location.reload();
},false);