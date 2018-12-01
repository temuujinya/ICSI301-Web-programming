
colorClasses = ["bg-yellow", "bg-red", "bg-black", 
"bg-lightgreen", "bg-blue"];


let smile=[
    ["","0","0","0","0","0",""],
    ["0","","","","","","0"],
    ["0","","2","","2","","0"],
    ["0","","","","","","0"],
    ["0","","","","","","0"],
    ["0","","1","1","1","","0"],
    ["0","","","","","","0"],
    ["","0","0","0","0","0",""],
];
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
    }
}