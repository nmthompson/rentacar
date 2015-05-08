function Ajax_send(success_function,fail_function,data,method,page) {
    var ajax; //ajax object
    if (window.XMLHttpRequest)
        ajax = new XMLHttpRequest(); //non-IE browser
    else
        ajax = new ActiveXObject("Microsoft.XMLHTTP");//IE browser
    fail_function = typeof fail_function !== 'undefined' ? fail_function : function(){};
    ajax.onreadystatechange = function() { //this function is called whenever the status of the ajax request changes
        if (ajax.readyState === 4){  //if the request is processed 
            if(ajax.status===200)//if the request is OK
                success_function(ajax.responseText);
            else
               fail_function(); //if something goes wrong 
        }        
    };
    ajax.open(method, page); 
    ajax.send(data); //send the data  
}

function $(id){
    return document.getElementById(id);
}

function show_tab(tab){
    var tabs=document.getElementsByClassName("tab_pressed");
    var pressed_tab=tabs[0];
    pressed_tab.className="tab";
    pressed_tab.firstElementChild.className="tab_detail_hidden";
    tab.className="tab_pressed";
    tab.firstElementChild.className="tab_detail";
}

// a function that makes a field look like a search box

function make_search_field(key, initial_text){
    
    var element=$(key);
    element.value=initial_text;
    element.style.color="gray";
    
    element.onmouseover=function(){
        if(element.value===initial_text)
        element.style.color="lightgray";
    };
    
    element.onmouseout=function(){
        if(element.value===""){
            element.value=initial_text;
            element.style.color="gray";
        }
        if(element.value===initial_text)
            element.style.color="gray";
    };
    
    element.onfocus=function(){
        if(element.value===initial_text)
            element.value="";
    };
    
    element.onkeydown=function(){
        if(element.value===initial_text)
            element.value="";
        element.style.color="black";
    };
    
}