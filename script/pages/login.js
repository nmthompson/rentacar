function maybe_login(event){
    if (event.keyCode == 13) //ENTER KEY
        login();
}

function login(){
    var form = $("login_form");
    var formData = new FormData(form);
    $("loading").className="loading";
    var Function = function(text){
        if(text.trim()==="success")
            window.location.assign("cars.html");
        else{
            $("loading").className="loading_hidden";
            $("login_feedback").innerHTML = "Invalid username or password";
        }
    };
    Ajax_send(Function, null, formData, "POST", "login.php");
}

