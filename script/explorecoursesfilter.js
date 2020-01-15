document.body.setAttribute('ontouchmove','displayfilters()');
var ascourse = document.getElementById('ascourse');
var assubject = document.getElementById('assubject');
var asyear = document.getElementById('asyear')
var gcourse = document.getElementById('gcourse');
var gsubject = document.getElementById('gsubject');
var sboard = document.getElementById('sboard');
var sclass = document.getElementById('sclass');
var sstream = document.getElementById('sstream');
// var steacher = document.getElementById('steacher');
var ssubject = document.getElementById('ssubject');
var schapter = document.getElementById('schapter');
var ascont = document.getElementById('asc');
var scont = document.getElementById('sc');
var gcont = document.getElementById('gc');
var scrollright =document.getElementById('nscrolll');
var scrollleft =document.getElementById('scrolll');
filterbutton = document.getElementById('recommandedhead');
var filterlogo = document.getElementById('filterlogo');
var confirmaddcont = document.getElementById('confirmadd');
var coridelem = document.getElementById('corid');
var cortokenelem = document.getElementById('cortoken');
var hit='no';


// containers
var filtercontainer = document.getElementById("filtercontainer");
var flcon = document.getElementById('coursesfilter');
var sstrcon = document.getElementById('filterstreamcontainer');
var corbox = document.getElementById('coursebox');
var confirmaddcont =document.getElementById('confirmadd');
var notifyelem = document.getElementById('inform');
var notifyelemcont = document.getElementById('informcontainer');

console.log(subnav);
console.log(assubject);
console.log(ascourse);

// ////////////////////////////////////
// function for interface
var dfot = false;
function displayfiltersontouch(){
if(!dfot){
  dfot = true;
  displayfilters();
}
}
function  displayfilters(){
  if(filtercontainer.style.height === '0px'){
      filtercontainer.style="height:358px;opacity:1"; 
  filterlogo.style=" background-position:0px -325px;";
flcon.style = "background-color:rgb(21, 168, 109);";
document.body.scrollIntoView(true);
document.body.setAttribute('ontouchmove','displayfilters()');
dfot = false;

  }else{
    document.body.toggleAttribute('ontouchmove',false);
    filtercontainer.style="height:0px;opacity:0";
    filterlogo.style=" background-position:0px -300px;";
flcon.style = "background-color:white;"
    
  }
}

function confirmsh(){
  confirmaddcont.style = "height:0;opacity:0";
  console.log(confirmaddcont.style.height + confirmaddcont.style.opacity);

}

function  getscourses(){
// place clear filter 
corbox.innerHTML = "";
  filterbutton.style.display = 'block';
  
  var data ="category=s&";
var sboaval = sboard.value;
var sclaval = sclass.value;
// var steaval = steacher.value;
var ssubval = ssubject.value;
var sstrval = sstream.value;
var schaval = schapter.value;

if(sboaval !== 'none'){
  data += 'board='+sboaval+'&';
}
if(sclaval !== 'none'){
  data += 'class='+sclaval+'&';
}
if(sstrval !== 'none'){
  data += 'stream='+sstrval+'&';
}

// if(steaval !== ''){
//   data += 'teacher='+steaval+'&';
// }

if(schaval !== ''){
  data += 'chapter='+schaval+'&';
}
if(ssubval !== ''){
  data += 'subject='+ssubval+'&';
}
data = data.slice(0,-1);
readyajax('/studentcoursesget.php',data);

displayfilters();
}


function getascourses(){
ascouval = ascourse.value;
assubval = assubject.value;
asyeaval = asyear.value;

corbox.innerHTML = "";
  filterbutton.style.display = 'block';

  var data = "category=as&";
  if(ascouval !== ''){
    data += 'class='+ascouval+'&';
  }
  
  if(assubval !== ''){
    data += 'subject='+assubval+'&';
  }
  
  if(asyeaval !== 'none'){
    data += 'year='+asyeaval+'&';
  }
data = data.slice(0,-1);
console.log(data);
readyajax('/studentcoursesget.php',data);
displayfilters();
}




function getgcourses(){
  gcouval = gcourse.value;
  gsubval = gsubject.value;

corbox.innerHTML = "";
filterbutton.style.display = 'block';

var data = "category=g&";
if(gcouval !== ''){
  data += 'class='+gcouval+'&';
}

if(gsubval !== ''){
  data += 'subject='+gsubval+'&';
}

data = data.slice(0,-1);
console.log(data);
readyajax('/studentcoursesget.php',data);
displayfilters();

}


function cleanfilters(){

  corbox.innerHTML = "";
  filterbutton.style.display = 'none';
  getcourses();
}


function changefilter(bname){
  var asdisp = ascont.style.width;
  var sdisp = scont.style.width;
  var gdisp = gcont.style.width;
if(bname === 'scrolll'){
  if(asdisp === '0px' && sdisp === "0px"){
    scont.style="width:200px;opacity:100";  
    gcont.style = "width:0px;opacity:0";
    scrollright.style="visibility:visible";
  }
  else if(asdisp === '0px' && gdisp === "0px" && sdisp === '200px'){
    scont.style="width:0px;opacity:0";  
    ascont.style = "width:200px;opacity:100";
    scrollleft.style="visibility:hidden";
  }
}else{
  if(gdisp === '0px' && sdisp === "0px"){
    scont.style="width:200px;opacity:100";  
    ascont.style = "width:0px;opacity:0";
    scrollleft.style = 'visibility:visible';
  }
  else if(asdisp === '0px' && gdisp === "0px" && sdisp=== '200px'){
    scont.style="width:0px;opacity:0";  
    gcont.style = "width:200px;opacity:100";
    scrollright.style = 'visibility:hidden';

  }
}
}

function getcourses(data = ""){
  readyajax('/studentcoursesget.php');
  console.log('getCoursescalled');
  }







  // ajax function
function readyajax(url,data="",why='place'){
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST",url,true);
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function(){
    if(this.readyState === 4 && this.status === 200){
      console.log(why);
      switch(why){
        case 'place':{
          placecourses(this.responseText);
        }
        break;
        case 'add':
          var cresponse = this.responseText;
          cresponse = JSON.parse(cresponse)
          console.log(cresponse.token);
          cortokenelem.value =  cresponse.token;
          console.log(cresponse);
          if(cresponse.added === true){
            var note = "added successfully";
            notify(note);
            console.log(note);
          }else if(cresponse.added === false){
            var note = "Can't add,please try again";
            console.log(note);
            notify(note);
          }
          break;
      }
      
  
    }
  }
    xhttp.send(data);
}

// //////////////////////////////////////
// //////////////////////////////////////
// place courses function
// //////////////////////////////////////
// //////////////////////////////////////

function placecourses(courses){
  console.log(courses);
  if(courses !== 'false'){
courses = JSON.parse(courses);
for(var x=0;x<courses.length;x++){
var subtemp = document.createElement('div');
subtemp.setAttribute('class','subjecttemplete');
subtemp.setAttribute('id',courses[x].sno+'temp');

var subhead = document.createElement('div');
subhead.setAttribute('class',"head");

var year="";
if(courses[x].year !== null){
  year = courses[x].year;
  }

if(courses[x].year !== null){
  var subheadyear = document.createElement('div')
  }
var subheadclass = document.createElement('span');
subheadclass.setAttribute('class','class');
var subheadclassnode = document.createTextNode(courses[x].class+' '+year+' ');
subheadclass.appendChild(subheadclassnode);


var subheadtitle = document.createElement('span');
subheadtitle.setAttribute('class','subjecttitle');
var subheadtitlenode = document.createTextNode(courses[x].subject);
subheadtitle.appendChild(subheadtitlenode);
// {authornameblock
var subheadauthorcontainer = document.createElement('div');
subheadauthorcontainer.setAttribute('class','author');

var subheadauthor = document.createElement('div');
var subheadauthornode  = document.createTextNode('- Author -');
subheadauthor.appendChild(subheadauthornode);

var teacher = JSON.parse(courses[x].teacher)
var subheadauthorname = document.createElement('div');
subheadauthorname.setAttribute('class','authorname');
var subheadauthornamenode = document.createTextNode(teacher[0]);
subheadauthorname.appendChild(subheadauthornamenode);
// }
subheadauthorcontainer.appendChild(subheadauthor);
subheadauthorcontainer.appendChild(subheadauthorname);

// put above contents in head;
subhead.appendChild(subheadclass);
subhead.appendChild(subheadtitle);
subhead.appendChild(subheadauthorcontainer);


subtemp.appendChild(subhead);
var subhr = document.createElement('hr');
subtemp.appendChild(subhr);
console.log(courses[x].board)

  var subabout = document.createElement('div');
 subabout.setAttribute('class',"subjecttitle _aboutsub");
 if(courses[x].board !== null){
 var subaboutnode = document.createTextNode("Board:"+courses[x].board);
 subabout.appendChild(subaboutnode);
 }
 subtemp.appendChild(subabout);



var subjectinfo = document.createElement('div');
subjectinfo.setAttribute('class','subjectinfo');
// {
var studentscount = document.createElement('div');
studentscount.setAttribute('class','studentscount');
studentscount.setAttribute('title','student');

var studentlogocontainer = document.createElement('div');
studentlogocontainer.setAttribute('class','logocontainer _inlinef _slc')
var studentlogo = document.createElement('span');
studentlogo.setAttribute('class',"studentslogo")
studentlogocontainer.appendChild(studentlogo);

var studentcountnumber = document.createElement('span');
studentcountnumber.setAttribute('class','scount');
var studentcountnode = document.createTextNode(' '+courses[x].joined);
studentcountnumber.appendChild(studentcountnode);

studentscount.appendChild(studentlogocontainer);
studentscount.appendChild(studentcountnumber);
subjectinfo.appendChild(studentscount);
// }
// {
var rankcountcontainer = document.createElement('div');
rankcountcontainer.setAttribute('title','rank');
rankcountcontainer.setAttribute('class','rankcount');

var ranklogocontainer = document.createElement('div');
ranklogocontainer.setAttribute('class','logocontainer _inlinef _slc');
var ranklogo = document.createElement('span');
ranklogo.setAttribute('class',"ranklogo")
ranklogocontainer.appendChild(ranklogo);

var rankcountnumber = document.createElement('span');
 rankcountnumber.setAttribute('class','scount');
var rankcountnode = document.createTextNode(' '+courses[x].rank);
rankcountnumber.appendChild(rankcountnode);

rankcountcontainer.appendChild(ranklogocontainer);
rankcountcontainer.appendChild(rankcountnumber);
subjectinfo.appendChild(rankcountcontainer);
  // }
var linechange = document.createElement('br');
linechange.setAttribute('style','clear:both');
subjectinfo.appendChild(linechange);

var subbutton = document.createElement('div');
subbutton.setAttribute('class',"button _addbutton")
subbutton.setAttribute('id',courses[x].sno);
subbutton.setAttribute('onclick','addcourse(this.id)');


var subbuttonnode = document.createTextNode('Add');
subbutton.appendChild(subbuttonnode);

subtemp.appendChild(subjectinfo);

subtemp.appendChild(subbutton);
// put head in coursetemplete;
corbox.appendChild(subtemp);
}

}
else{
  
  var notify = document.createElement('div');
  notify.setAttribute('class','_light');
  var notifynode = document.createTextNode('No Course Found');
  notify.appendChild(notifynode);

  corbox.appendChild(notify);
}

}


// //////////////////////////////////////
// //////////////////////////////////////
// place courses function
// //////////////////////////////////////
// //////////////////////////////////////

function addcourse(courseid){
coridelem.value = courseid;
var courseabout = "";

var course = document.getElementById(courseid+'temp');
var coursehead = course.getElementsByClassName('head')[0].cloneNode(true);
var courseinfo = course.getElementsByClassName('subjectinfo')[0].cloneNode(true);

var ccorcont = document.getElementById('ccourse');
ccorcont.innerHTML = "";
ccorcont.appendChild(coursehead);

  courseabout = course.getElementsByClassName('_aboutsub')[0].cloneNode(true);
  ccorcont.appendChild(courseabout);
ccorcont.appendChild(courseinfo);
confirmaddcont.style = "height:100vh;opacity:1";
}




function confirmadd(){
  courseidonly = coridelem.value;
  courseid='subject='+courseidonly;
  coursetoken ='token='+cortokenelem.value;
  var course = document.getElementById(courseidonly+'temp');

course.style.display='none';
  confirmaddcont.style = 'height:0;opacity:0';

  data = courseid+"&"+coursetoken;

  readyajax('/passstudentcourse.php',data,'add');
}

// for better syncronize scipt and content
document.getElementById('pagecontentcontainer').style.display = "block";

window.onload = getcourses();

// stream hideshow
function streamvis(){
  if(sclass.value === '12' || sclass.value === '11')
  {sstrcon.style="visibility:visible";
  sstream.toggleAttribute('disabled',false);
}
  else{
    sstrcon.style="visibility:hidden";
  sstream.toggleAttribute('disabled',true);
  }
}