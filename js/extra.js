function eachk(email, eelem) {
  console.log("i called again");
  var jemail = JSON.stringify(email.value);
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var resp = (this.responseText);
      if (resp != "") {
        document.getElementById("sgee").innerHTML = resp;
        layoutchng(email, eelem);
        console.log("ready");
        chkssame(email.value,"0");
      }
      else{
        chkssame(email.value,"1");
      }
    }
  };
  xmlhttp.open("POST", "eachk.php", true)
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("q=" + jemail);
};