var express = require("express");
var app = express();
var request = require("request");
var xmlParser = require("xml2js").parseString;
var mongoose = require("mongoose");
var bodyParser = require("body-parser");

mongoose.connect("mongodb://localhost/numdumpOld");

app.set("view engine", "ejs");
var students = [];

//SCHEMA SETUP
var StudentSchema = new mongoose.Schema({
	SID: Number,
	CardNr: String,
    LName: String,
	FName: String,
	RegistryNr: String,
	Phones: String,
	Emails: String,
	School: String,
	Pro: String,
	Curriculum: String,
	St: String,
	Alevel: String,
	Tp: String,
});

var Student = mongoose.model("student",StudentSchema);

app.get("/", function(req, res) {
    let end = 70000; //17 10010066890 onii svvliin bvrtgel
    for (var i = 66890; i < end; i++) {
        console.log(i+"= "+(i*100)/end);
        var url =
            "https://sisi.num.edu.mn/sisi_v4/modules/xproxy_.ashx?p1=100100" + i + "&nr1=322&_=1515363303844";
        request(url, function(error, response, body) {
                if (!error && response.statusCode == 200) {
                    // res.send(body);
                    var data = xmlParser(body, function(error, result) {
                        try{
                        var sid = result["root"]["row"][0]["$"]["SID"];
                        }
                        catch(e){
                           // console.log("SID PROBLEM");
                        }

                        try{
                        var CardNr = result["root"]["row"][0]["$"]["CardNr"];
                        }
                        catch(e){
                            //console.log("CARDNR PROBLEM");
                        }

                        try{
                        var lname = result["root"]["row"][0]["$"]["lname"];
                        }
                        catch(e){
                            //console.log("LNAME PROBLEM");
                        }

                        try{    
                        var fname = result["root"]["row"][0]["$"]["fname"];
                        }
                        catch(e){
                            //console.log("FNAME PROBLEM");
                        }

                        try{    
                        var RegistryNr = result["root"]["row"][0]["$"]["RegistryNr"];
                        }
                        catch(e){
                            //console.log("RegistryNr PROBLEM");
                        }

                        try{
                        var phones =  result["root"]["row"][0]["$"]["phones"];
                        }
                        catch(e){
                            //console.log("PHONES PROBLEM");
                        }

                        try{
                        var emails =  result["root"]["row"][0]["$"]["emails"];
                        }
                        catch(e){
                           // console.log("EMAILS PROBLEM");
                        }

                        //Programs
                        try{
                        var School =result["root"]["row"][0]["programs"][0]["$"]["school"];
                        }
                        catch(e){
                            //console.log("School PROBLEM");
                        }

                        try{
                        var pro =result["root"]["row"][0]["programs"][0]["$"]["pro"];
                        }
                        catch(e){
                            //console.log("PRO PROBLEM");
                        }

                        try{
                        var curriculum =result["root"]["row"][0]["programs"][0]["$"]["curriculum"];
                        }
                        catch(e){
                            //console.log("curriculum PROBLEM");
                        }

                        try{
                        var st =result["root"]["row"][0]["programs"][0]["$"]["st"];
                        }
                        catch(e){
                            //console.log("ST PROBLEM");
                        }

                        try{
                        var Alevel =result["root"]["row"][0]["programs"][0]["$"]["Alevel"];
                        }
                        catch(e){
                            //console.log("Alevel PROBLEM");
                        }

                        try{
                        var tp =result["root"]["row"][0]["programs"][0]["$"]["tp"];
                        }
                        catch(e){
                            //console.log("ST PROBLEM");
                        }

                        // console.log(result["root"]["row"]["programs"][0]["$"]["Alevel"]);
                       
                        var newObj = {
                            SID: sid,
                            CardNr: CardNr,
                            LName: lname,
                            FName: fname,
                            RegistryNr: RegistryNr,
                            Phones: phones,
                            Emails: emails,
                            School: School,
                            Pro: pro,
                            Curriculum: curriculum,
                            St:st,
                            Alevel:Alevel,
                            Tp:tp
                        }

                        

                        //Create new campground and save to DB
                        Student.create(newObj, function(err, newlyCreated){
                            if (err) {
                                console.log(err);
                            }
                        });                            
                    
                        //students.push(newObj);
                        
                        /*
                        if(result["root"]["row"][0].find("programs")){
                        students.school=result["root"]["row"][0]["programs"][0]["$"]["school"];}
                        */ // console.log(JSON.stringify(result["root"]["row"][0]["$"]["SID"]));
                        // console.log(all.length);
                    });
                    // 

                }
    });
    }
// console.log(i+"= "+sid[0]);
res.render("home", {
    students: students
});
});


app.listen(3000, function(req, res) {
    console.log("App is running...");
});
