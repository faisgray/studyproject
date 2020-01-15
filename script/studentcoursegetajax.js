var sesruoc = "";
var atadc ="";
var indelem = document.getElementById('indexcontents');
var indelemcont = document.getElementById('index');
var inddatacont = document.getElementById('indexdata');


scripts = document.getElementsByTagName('script')[0];
var ssheet0 = document.createElement('link');
ssheet0.setAttribute('rel','stylesheet');
 var url0 = 'style/savedcourses.css'
ssheet0.href = url0;
scripts.parentNode.insertBefore(ssheet0, scripts);

pccont = document.getElementById('pagecontentcontainer');
cccont = document.getElementById('coursecontentcontainer');


function explorecourses(id){
  readyajax('/explorecourses.php','datafetch='+id,'explore');
  document.getElementById('pagecontentcontainer').style.display = "none";

  }

function readyajax(url,data="",why){
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST",url,true);
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function(){
    if(this.readyState === 4 && this.status === 200){
      switch(why){
       case 'explore':
     gotexplorecourses(this.responseText);
     break;
     case 'got':
     placesavedcourses(this.responseText);
     break;
     case 'cdata':
      coursesdata(this.responseText)
      }
    }
  }
    xhttp.send(data);
}

window.onload= function(){
  readyajax('/studentcoursesplace.php','','got');
}

function gotexplorecourses(page){
  document.getElementById('pagecontentcontainer').innerHTML = page;

var url ="script/explorecoursesfilter.js";
var script = document.createElement('script');
script.toggleAttribute('defer',true);
script.src = url;
scripts.parentNode.insertBefore(script, scripts);

var ssheet = document.createElement('link');
ssheet.setAttribute('rel','stylesheet');
  url = 'style/explorecourses.css'
ssheet.href = url;
scripts.parentNode.insertBefore(ssheet, scripts);

}


function artback(where = "",what = "") {
  history.pushState(null, document.title, location.pathname);
  switch(what){
    
    case 'back':
      window.addEventListener("popstate", function(){
        history.replaceState(null, document.title, location.pathname);
        setTimeout(function(){
          location.replace('http://mahdi.com/'+where);
        },0);
      }, false);

        redirectonback(where);
        break;
        case 'transit':
            window.addEventListener("popstate",displaysavedcourses,false);
            console.log('transit');
            break;
            case 'tochaps':
            window.addEventListener("popstate",displaychaps,false);
              console.log('transitdisplaychaps');
              break;
          
              
    }


}






// place saved courses


function placesavedcourses(courses){
  console.log(courses);
  console.log(typeof(courses));
  courses = JSON.parse(courses);
  sesruoc = courses;
  if(courses.length === 0){
    var notidiv = document.createElement('div')
    notidiv.setAttribute('class','_light')
    var notinod = document.createTextNode('Explore to Add New Courses');
    
    var LOGOdiv = document.createElement('div')
    LOGOdiv.setAttribute('class','logocontainer _letterlc');
    var logospandiv = document.createElement('span');
    logospandiv.setAttribute('id','letterlogo');
    logospandiv.setAttribute('class','fnotify');
    
    LOGOdiv.appendChild(logospandiv);
    notidiv.appendChild(LOGOdiv);
    notidiv.appendChild(notinod);
    
    
    document.getElementById('pagecontent').appendChild(notidiv);
  
  }else{
    
  for(var x = 0;x < courses.length;x++){
    
    var newcourseelem = document.createElement('div');
    newcourseelem.setAttribute('id',x);
    var addrcontainer = document.createElement('div');
    addrcontainer.setAttribute('class','address');
    
    if(courses[x].board !== null){
      var addr = document.createElement('span');
  var addrtxt = document.createTextNode(courses[x].board);
  
  addr.appendChild(addrtxt);
  addrcontainer.appendChild(addr);
    }
    if(courses[x].class !== null){
      var addr = document.createElement('span');
      var addrtxt = document.createTextNode(" "+courses[x].class);
     
      addr.appendChild(addrtxt);
      addrcontainer.appendChild(addr);
          }
          if(courses[x].stream !== null){
            var addr = document.createElement('span');
            var addrtxt = document.createTextNode(" "+courses[x].stream);
            
            addr.appendChild(addrtxt);
            addrcontainer.appendChild(addr);
          }
          if(courses[x].year !== null){
            var addr = document.createElement('span');
            var addrtxt = document.createTextNode(" "+courses[x].year+' YEAR');
            addr.appendChild(addrtxt);
            addrcontainer.appendChild(addr);
          }
  
  
  
  
  //  append address in main;
  
  
  
  var subjectselem = document.createElement('div');
  subjectselem.setAttribute('class','subjects');
  
  var subjectelem = document.createElement('div');
  subjectelem.setAttribute('class','subject');
  subjectelem.setAttribute('id',courses[x].id);
  subjectelem.setAttribute('onclick','getcontent(this.id)');
  
  var tableelem = document.createElement('table');
  var trelem = document.createElement('tr');
  var tdelem =document.createElement('td');
  
  var ctitleelem =document.createElement('div');
  ctitleelem.setAttribute('class','coursetitle');
  var firstletter = courses[x].subject;
  var ctitletext = document.createTextNode(firstletter.charAt(0));
  ctitleelem.appendChild(ctitletext);
  tdelem.appendChild(ctitleelem);
  
  
  
  var td2elem = document.createElement('td');
  
  var snameelem =document.createElement('div');
  snameelem.setAttribute('class','subjectname');
  var snametext = document.createTextNode(courses[x].subject);
  snameelem.appendChild(snametext);
  
  
  
  var scountnameelem = document.createElement('div');
  scountnameelem.setAttribute('class','details');
  var scountnametext = document.createTextNode('Details');
  scountnameelem.setAttribute('id',courses[x].id+"d");
  scountnameelem.setAttribute('onclick','back(this.id,event)');
  scountnameelem.appendChild(scountnametext);
  
  var scountelem = document.createElement('span');
  var scounttext = document.createTextNode("\u27A4");
  scountelem.appendChild(scounttext);
  
  scountnameelem.appendChild(scountelem);
  
  
  snameelem.appendChild(scountnameelem);
  td2elem.appendChild(snameelem);
  
  trelem.appendChild(tdelem);
  trelem.appendChild(td2elem);
  tableelem.appendChild(trelem);
  
  subjectelem.appendChild(tableelem);
  
  // subcontainer creation;
  var subcontainerelem = document.createElement('div');
  subcontainerelem.setAttribute('class','subjectcontentcontainer');
  subcontainerelem.setAttribute('id',courses[x].id+'con');
  var subsubcontainerelem = document.createElement('div');
  subsubcontainerelem.setAttribute('class','subjectcontentsubcontainer');
  
  // {
  var subcontentelem = document.createElement('div');
  subcontentelem.setAttribute('class','subjectcontent');
  
  var teachername = document.createElement('div');
  teachername.setAttribute('class','teachername');
  
  var teachernode = JSON.parse(courses[x].teacher);
  var teachernamenode = document.createTextNode('Teacher : '+teachernode);
  teachername.appendChild(teachernamenode);
  // }
  
  // {
  
  var subcontentelem2 = document.createElement('div');
  subcontentelem2.setAttribute('class','subjectcontent');
  
  var scountnameelem = document.createElement('div');
  scountnameelem.setAttribute('class','studentcount');
  scountnameelem.setAttribute('title','students');
  
  var studentlogocontainer = document.createElement('div');
  studentlogocontainer.setAttribute('class','logocontainer _inlinef _slc')
  var studentlogo = document.createElement('span');
  studentlogo.setAttribute('class',"studentslogo")
  studentlogocontainer.appendChild(studentlogo);
  
  var studentcountnumber = document.createElement('span');
  studentcountnumber.setAttribute('class','scount');
  var studentcountnode = document.createTextNode(' '+courses[x].joined);
  studentcountnumber.appendChild(studentcountnode);
  
  scountnameelem.appendChild(studentlogocontainer);
  scountnameelem.appendChild(studentcountnumber);
  // }
  
  
  
  // {
  var subcontentelem1 = document.createElement('div');
  subcontentelem1.setAttribute('class','subjectcontent');
  
  var ccreatedelem = document.createElement('div');
  ccreatedelem.setAttribute('class','teachername');
  
  var ccreatednode = document.createTextNode('Course Created : '+courses[x].created.slice(0,-6));
  ccreatedelem.appendChild(ccreatednode);
  // }
  // {
  var subcontentelem3 = document.createElement('div');
  subcontentelem3.setAttribute('class','subjectcontent');
  
  var courserankelem = document.createElement('div');
  courserankelem.setAttribute('title','rank');
  courserankelem.setAttribute('class','rankcount');
  
  var ranklogocontainer = document.createElement('div');
  ranklogocontainer.setAttribute('class','logocontainer _inlinef _slc');
  var ranklogo = document.createElement('span');
  ranklogo.setAttribute('class',"ranklogo")
  ranklogocontainer.appendChild(ranklogo);
  
  var rankcountnumber = document.createElement('span');
  rankcountnumber.setAttribute('class','scount');
  var rankcountnode = document.createTextNode(' '+courses[x].rank);
  rankcountnumber.appendChild(rankcountnode);
  
  courserankelem.appendChild(ranklogocontainer);
  courserankelem.appendChild(rankcountnumber);
  
  
  // }
  
  subcontentelem.appendChild(teachername);
  subcontentelem1.appendChild(ccreatedelem);
  subcontentelem2.appendChild(scountnameelem);
  subcontentelem2.appendChild(courserankelem);
  
  
  
  // subcontentelem.setAttribute('onclick','load(this.id)');
  // subcontentelem.setAttribute('id','exercise');
  // var subcontenttext = document.createTextNode('Exercise');
  // subcontentelem.appendChild(subcontenttext);
  subsubcontainerelem.appendChild(subcontentelem);
  subsubcontainerelem.appendChild(subcontentelem1);
  subsubcontainerelem.appendChild(subcontentelem2);
  subsubcontainerelem.appendChild(subcontentelem3);
  subcontainerelem.appendChild(subsubcontainerelem);
  
  var address = document.getElementsByClassName('address');
  var pagesubjects = document.getElementsByClassName('subjects');
  var match = false;
  var matchfor = '';
  for(var y=0;y<address.length;y++){
  if(address[y].innerHTML == addrcontainer.innerHTML){
  match = true;
  matchfor = y;
  }
  }
  
  
  // adding subject and its content to subjects group
  if(match === true){
  pagesubjects[matchfor].appendChild(subjectelem);
  pagesubjects[matchfor].appendChild(subcontainerelem);
  }
  else{
  subjectselem.appendChild(addrcontainer);
  subjectselem.appendChild(subjectelem);
  newcourseelem.appendChild(subjectselem);
  
  subjectselem.appendChild(subcontainerelem);
  
    document.getElementById('pagecontent').appendChild(newcourseelem);
  }
  
    
  }
  
  }
  
  }






// saved courses requests script
function back(id = "",event){
  event.stopPropagation();
    id=id.slice(0,-1);
    var subjects = document.getElementsByClassName('subject');  
    var subject = document.getElementById(id+'con');
    var subjectcc = document.getElementsByClassName('subjectcontentcontainer');
    
    if(subject.style.height === '150px'){
      subjects[id].style = 'background-color:none';
      subject.style.height = '0px';
    
    }else{
     
   closeallcontents(subjects,subjectcc);
      // subject.style = 'background-color:rgb(239,239,239)';
      
      subjects[id].style = 'background-color:whitew'; 
      subject.style.height = '150px';
   
    }
    }
  function closeallcontents(subjects,subjectcc){
    for(var x=0;x<subjects.length;x++){
      subjects[x].style = 'background-color:none';
      subjectcc[x].style.height = '0px';
    }
  }
    
  function getcontent(id){
    artback("",'transit');
    var subjects = document.getElementsByClassName('subject');
    var subjectcc = document.getElementsByClassName('subjectcontentcontainer');  
   closeallcontents(subjects,subjectcc);
   cccont.style.display = 'block';
   pccont.style = "opacity:0";  
  setTimeout(() => {
    pccont.style.display = 'none'; 
    cccont.style.opacity = '1';
  },300);
   chapload(id);
  }
  function chapload(corid){
    indelem.innerHTML = '';
    console.log(sesruoc.length);
    console.log(corid);
    for(var x = 0;x< sesruoc.length;x++){
   if(sesruoc[x].id === corid){

    var chapters = JSON.parse(sesruoc[x].chapters);
    
    if(chapters === null){
      var notidiv = document.createElement('div')
      notidiv.setAttribute('class','_light')
      var notinod = document.createTextNode('No chapters Yet');
      
      var LOGOdiv = document.createElement('div')
      LOGOdiv.setAttribute('class','logocontainer _letterlc');
      var logospandiv = document.createElement('span');
      logospandiv.setAttribute('id','letterlogo');
      logospandiv.setAttribute('class','fnotify');
      
      LOGOdiv.appendChild(logospandiv);
      notidiv.appendChild(LOGOdiv);
      notidiv.appendChild(notinod);
      
      
      indelem.appendChild(notidiv);
      return false;
    }
    var chnames = Object.getOwnPropertyNames(chapters);
    
    for(y = 0;y<chnames.length;y++){
     var chnamecont = document.createElement('div');
     chnamecont.setAttribute('class','chapter');
     chnamecont.setAttribute('id',chapters[chnames[y]]);
     chnamecont.setAttribute('onclick','getchaps(this)');
     document.getElementById('chcount').innerHTML = chnames.length+' Chapters';
     var chname = document.createElement('a');
     chname.setAttribute('href','#');
     chname.setAttribute('class','chaptername');
     var chnamenode = document.createTextNode(chnames[y]);
     chname.appendChild(chnamenode);
chnamecont.appendChild(chname);
     indelem.appendChild(chnamecont);
     console.log('added');
    }
     break;
   }
    }
  }
  function getchaps(elem){
    indelemcont.style = 'display:none;opacity:0';
    inddatacont.style = 'display:block';
    setTimeout(function(){
      inddatacont.style.opacity ='1';
    },200);
    window.removeEventListener('popstate',displaysavedcourses,false);
    artback('','tochaps');
    var data = 'chapter='+elem.id;
    readyajax('/coursesdataget.php',data,'cdata');
      }
    
function coursesdata(data){
  data = JSON.parse(data);
  console.log('datais='+data);
  console.log('datais='+data[0]);
  console.log('datais='+data[1].lectures);
  if(data[0]){
  atadc = data;
  }
  if(!data[1].lectures){
    console.log('enters');
    var notidiv = document.createElement('div')
    notidiv.setAttribute('class','_light')
    var notinod = document.createTextNode('No lectures Yet');
    
    var LOGOdiv = document.createElement('div')
    LOGOdiv.setAttribute('class','logocontainer _letterlc');
    var logospandiv = document.createElement('span');
    logospandiv.setAttribute('id','letterlogo');
    logospandiv.setAttribute('class','fnotify');
    
    LOGOdiv.appendChild(logospandiv);
    notidiv.appendChild(LOGOdiv);
    notidiv.appendChild(notinod);
    
    var lc = document.getElementById('lecturescontainer')
    lc.innerHTML = "";
    lc.appendChild(notidiv);
    return false;
  }

  console.log(data);
  
}


  function displaysavedcourses(){
    pccont.style.display = 'block'; 
    cccont.style.opacity = '0';
   setTimeout(() => {
  
  
     cccont.style.display = 'none';
    pccont.style = "opacity:1";  
   },300);
  }
  function displaychaps(){
    inddatacont.style = 'display:none;opacity:0';
    indelemcont.style.display ='block';
setTimeout(function(){
  indelemcont.style.opacity ='1';
},200);
  }
// notify
function notify(note){
  notifyelem.innerHTML = note;
  notifyelemcont.setAttribute('ontouchmove','notifysh()');
  notifyelemcont.style = "height:100vh;opacity:1";
  
}
function notifysh(){
  notifyelemcont.style = "height:0px;opacity:0";
  notifyelemcont.toggleAttribute('ontouchmove',false);
}
