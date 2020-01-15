window.onload = function () {
  var eelearr = ["lge","lgp","fName", "lName", "sge", "sgp"];
  var x = 0;
  while (x <= 5) {
    var eles = document.getElementById(eelearr[x])
    var ele = eles.value;
    var eeles = document.getElementById(eelearr[x] + 'e');
    var eele = eeles.innerHTML;
    if (eele !== "") {
      layoutchng(eles, eeles)
    }
    else if (ele !== "") {
      validate(eelearr[x]);
    }
    x++;
  }
}
// check if same email goes to availability check
function validateo() {
  var lemail = false;
  var lpassword = false;
  var fname = false;
  var lname = false;
  var email = false;
  var password = false;
  var cpassword = false;
  this.setlemail = function (arg = false) {
    lemail = arg;
  }
  this.setlpassword = function (arg = false) {
    lpassword = arg;
  }

  this.setfname = function (arg = false) {
    fname = arg;
  };
  this.setlname = function (arg = false) {
    lname = arg;
  };
  this.setemail = function (arg = false) {
    email = arg;
  };
  this.setpassword = function (arg = false) {
    password = arg;
  };
  this.setconfirmpassword = function (arg = false) {
    cpassword = arg;
  };
  this.chkallfortruth = function () {
    var chkarr = [];
    chkarr[0] = fname;
    chkarr[1] = lname;
    chkarr[2] = email;
    chkarr[3] = password;
    chkarr[4] = cpassword;
    return chkarr;
  };
  this.chkforlogtruth = function () {
    var chkarr = [];
    chkarr[0] = lemail;
    chkarr[1] = lpassword;
    return chkarr;
  }
}


var valo = new validateo();

function validate(dataid) {
  // dtest =input fields, eele = error elements
  var dtest = document.getElementById(dataid);
  var eele = document.getElementById(dataid + "e");
  dtvalue = dtest.value;
  console.log(dataid);
  switch (dataid) {
    case "lge":
      var checkp = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      if (dtvalue === "") {
        eele.innerHTML = null;
        valo.setlemail();
      }
      else {
        if (dtvalue.match(checkp)) {
          eele.innerHTML = null;
          valo.setlemail(true);

        }
        else {
          eele.innerHTML = "Please Enter Valid Email";
          valo.setlemail();
        }
      }
      break;
    case "lgp":
        if (dtvalue.length < 5) {
          if (dtvalue != "") {
            eele.innerHTML = "short password";
            valo.setlpassword();
          }
          else {
            eele.innerHTML = null;
            valo.setlpassword();
          }
        }
        else {
          eele.innerHTML = null;
          valo.setlpassword(true);
        }
      break;
    case "fName":
      dtvalue = dtvalue.trim();
      var check = /^[A-Za-z ]+$/;
      if (dtvalue === "") {
        eele.innerHTML = null;
        valo.setfname();
      }
      else {
        if (dtvalue.match(check)) {
          eele.innerHTML = null;
          valo.setfname(true);

        }
        else {
          eele.innerHTML = "Please use letters only(no gaps & numbers)";
          valo.setfname();
          
        }
      }
      break;
    case "lName":
      var check = /^[A-Za-z]+$/;
      if (dtvalue === "") {
        eele.innerHTML = null;
        valo.setlname();

      }
      else {
        if (dtvalue.match(check)) {
          eele.innerHTML = null;
          valo.setlname(true);

        }
        else {
          eele.innerHTML = "Please use letters only(no gaps & numbers)";
          valo.setlname();
        }
      }
      break;

    case "sge":
      var checkp = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      if (dtvalue === "") {
        eele.innerHTML = null;
        valo.setemail();
      }
      else {
        if (dtvalue.match(checkp)) {
          eele.innerHTML = null;
          valo.setemail(true);

        }
        else {
          eele.innerHTML = "Please Enter Valid Email";
          valo.setemail();
        }
      }
      break;

    case "sgp":
      if (dtvalue.length < 5) {
        if (dtvalue != "") {
          eele.innerHTML = "short password";
          valo.setpassword();
        }
        else {
          eele.innerHTML = null;
          valo.setpassword();
        }
      }
      else {
        eele.innerHTML = null;
        valo.setpassword(true);
        cpass =document.getElementById('sgcp').value;
        if(cpass !== ''){
          if(dtvalue === cpass ){
            eele.innerHTML = "";
            valo.setpassword(true);
          }else if(dtvalue !== cpass){
            eele.innerHTML = "please enter same password";
            valo.setpassword();
          }
        }
      }
      break;
      case "sgcp":
        console.log("case(sgcp)");
        if(dtvalue !== document.getElementById('sgp').value){
          eele.innerHTML = 'please enter same password';
          valo.setconfirmpassword();
        }else if(dtvalue === document.getElementById('sgp').value){
          eele.innerHTML = '';
          valo.setconfirmpassword(true);
        }
        break; 
  }
  layoutchng(dtest, eele);
}



// cele = elements for which the layout has to be configured,errele = by cheching theirs error tooltips;
function layoutchng(cele, errele, ) {
  var eedata = errele.innerHTML;
  var inpdata = cele.value;
  if (eedata === "") {
    if (inpdata === "")
      cele.style = "border:1px solid rgb(228, 59, 59)";
    else {
      cele.style = "border:1px solid rgb(107, 226, 84);";
    }
  }
  else {
    cele.style = "border:1px solid rgb(228, 59, 59);background-color:rgb(238, 196, 196);";
  }
};


// email input configuration and avaibility check;


// check for filld inputs

function chksfld() {
  
  var chkarr = valo.chkallfortruth();
  console.log(chkarr);
  var eelearr = ["fName", "lName", "sge", "sgp",'sgcp'];
  var x = 0;

  while (x <= 4) {

    if (!chkarr[x]) {
      eele = document.getElementById(eelearr[x] + 'e');
      ele = document.getElementById(eelearr[x]);
      eele.innerHTML = "please fill it";
      ele.focus();
      return false;
    }
    x++
  };
  return true;
}

function chklfld() {
  
  var chkarr = valo.chkforlogtruth();
  var eelearr = ["lge","lgp"];
  var x = 0;

  while (x <= 1) {

    if (!chkarr[x]) {
      eele = document.getElementById(eelearr[x] + 'e');
      ele = document.getElementById(eelearr[x]);
      eele.innerHTML = "Fill it Correctly";
      ele.focus();
      return false;
    }
    x++
  };
  return true;
}
