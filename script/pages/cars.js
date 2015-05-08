/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function init() {
    make_search_field("search_field", "Type car make, model, year, color, etc.");
    show_info("search_results","search_results");
    show_info("rented_cars","rented_cars");
    show_info("returned_cars","returned_cars");

}

function close_message() {
    $("background").style.display = "none";
    $("message_box").style.display = "none";
    $("message").innerHTML = "";
}

function show_message() {
    $("background").style.display = "block";
    $("message_box").style.display = "block";
}
function find_car_key(event){
    if(even.keyCode == 13)
        find_car();
}
function show_info(type, id){ //function test for switch
    var data = new FormData();
    data.append("type", type);
    var Function=function(text){
        if(text.trim()=="redirect")
            window.location.assign("index.html");
        $(id).innerHTML = text;
    }
    Ajax_send(Function, null, data, "POST", "Cars.php");
    
}


function find_car(){
    var data = new FormData();
    var value=$("search_field").value;
    data.append("search_field", $("search_field").value);
    var Function=function(text)
    {
        $("search_results").innerHTML = text;
    }
    
    Ajax_send(Function, null, data, "POST", "Cars.php");
}
function rented_cars(){//ignore, incomplete
    var Function=function(text)
    {
        $("rented_cars").innerHTML = text;
    }
    Ajax_send(Function, null, null, "POST", "Cars.php");
}
function logout(){ //incomplete still
    var data = new FormData();
    var Function=function(text){
        if(text.trim() ==="success")
            window.location.assign("login.html");
    };
    Ajax_send(Function, null, data, "POST", "login.php");
}

