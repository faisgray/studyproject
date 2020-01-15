var chnameval = '';
var cour = '';
function addchap(){
var chname = document.getElementById('chapterfield');
if(chname.value  === ""){
 chname.style = "border:1px solid red;background:rgb(244,170,170)"; 
}
else if(chname.value  !== ""){
  if(chname.value.match(/^[A-Za-z1-90+. ]+$/) && chname.value.length <= 30 && chname.value.length >= 3){
    document.getElementById('chaptererror').innerHTML = "";
  chname.toggleAttribute('style',false);
  var token = document.getElementById('chaptoken').value;
  chnameval = chname.value;
  cour = document.getElementById('forcourse').value;
  var chapter = 'token='+token+'&subject='+cour+'&case=c'+'&chapters='+chnameval;
  console.log(chapter);
  readyajax('/teacherpassnewdata.php',chapter,'addchapter');
  
  NQ();
  chname.value = "";
  }else{
    document.getElementById('chaptererror').innerHTML = "please use alphabets and numbers only,minimum 3 letters required,should not exceed 20 letters";
    chname.style = "border:1px solid red;background:rgb(244,170,170)"; 
  }
 }
}
function chapadded(status){
console.log(status);
status = JSON.parse(status);
alltokenchange(status[0]);

if(status[1]){
status[2] = JSON.parse(status[2]);
if(status[2][0]){
notify(status[2][1]);
createch(status[2][2]);

console.log(sesruoc);
console.log(typeof(sesruoc));
}
else{
  notify(status[2][1]);
}
}
else{
  notify('course add fail please try again');
}
// dont send request just for one chapter set it manually;
}
function alltokenchange(token){
  var tokelem = document.getElementsByClassName('token');
for(var x=0;x<tokelem.length;x++){
  tokelem[x].value = token;
}
}
function createch(newch){
  var chnamecont = document.createElement('div');
     chnamecont.setAttribute('class','chapter');
     chnamecont.setAttribute('id',newch);
     var chname = document.createElement('div');
     chname.setAttribute('class','chaptername');
     chnameval =  chnameval.toUpperCase();
     var chnamenode = document.createTextNode(chnameval);
     
     chname.appendChild(chnamenode);
chnamecont.appendChild(chname);
     indelem.appendChild(chnamecont);

     for(var x = 0;x < sesruoc.length;x++){
      if(sesruoc[x].id === cour){
    var chapter = JSON.parse(sesruoc[x].chapters);
    chnameval = chnameval.toUpperCase();
    
    chapter[chnameval] = newch;
    
    document.getElementById('chcount').innerHTML =Object.getOwnPropertyNames(chapter).length;
    chnameval = "";
    chapter = JSON.stringify(chapter);
    sesruoc[x].chapters = chapter;
    break;
      }
    }
     
}