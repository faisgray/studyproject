
function switchb(){
    var select = document.getElementById("LoginForm");
    check=select.style.height;
    var select1 = document.getElementById("SignupForm");
    check=select.style.height;
    var buttonsign = document.getElementById("dirB");
    var buttontxt = document.getElementById("buttontxt");
    var logoC = document.getElementById("logoContainer");
    var logo = document.getElementById("logo");

    if(check != "0px")
    {
    select.style="height:0;opacity:100;";
    select1.style="height:450px;opacity:100;";
    buttonsign.style="transform:rotate(90deg);";
    buttontxt.innerHTML="Back to LOG IN";
    setTimeout(function(){buttontxt.scrollIntoView(top)},900);  
    }
    else{
     select.style="height:230px;opacity:100;"
     select1.style="height:0px;opacity:0;";
     buttonsign.style="transform:rotate(-90deg);";
     buttontxt.innerHTML="Create New Account";
    }

}

function eborder(dataid) {
    let emele = document.getElementById(dataid);
    emele.style = "border:1px solid rgb(202,202,202)";
}

function punh(id){
    let x = document.getElementById('sgp');
    let x1 = document.getElementById('sgcp');
let y = document.getElementById(id);
    if (x.type === "password") {
      x.type = "text";
      x1.type = "text";
      y.style="background-color:rgb(238, 136, 40);";

    } else {
      x.type = "password";
      x1.type = "password";
      y.style = "background-color:white;";
    }
}