<?php
require_once 'tprofileheader.php';
if(token::check(input::get('token'))){
  
if($user->isloggedin()){
  $validate = new validate;
$dataval = array();
$dataarr = array();

if(isset($_POST['category'])){
  $dataval['category'] = array(
    'min' => 1,
    'max' => 2,
    'nameOrder1' => true
  );
  $category = strtoupper(trim(input::get('category')));
  $dataarr['category'] = $category;
  if($category == "AS" && !isset($_POST['year'])){
    $addmessage = 'please enter complete info';
    $yerror = "please select this";
  }
}
if(isset($_POST['board'])){
  $dataval['board'] = array(
    'min' =>1,
    'max'=>20,
    'required'=> true,
  );
  $dataarr['board'] = strtoupper(trim(input::get('board')));
}
if(isset($_POST['class'])){
  $dataval['class'] = array(
    'required' => true,
    'min'=>1,
    'max'=>20,
    'nameOrder1' => true
  );
$class = strtoupper(trim(input::get('class')));

  $dataarr['class'] = $class;

}
if(isset($_POST['stream'])){
  $dataval['stream'] = array(
    'min' => 3,
    'max'=> 10,
  'required'=>true,
  'nameOrder1' => true
  );
  $dataarr['stream'] = strtoupper(trim(input::get('stream')));
}
if(isset($_POST['year'])){
  $dataval['year'] = array(
    'min' => 2,
    'max' => 3,
    'nameOrder1' => true
  );
  $dataarr['year'] = strtoupper(trim(input::get('year')));
}
if(isset($_POST['subject'])){
  $dataval['subject'] = array(
    'required'=>true,
    'min' => 3,
    'max' => 20,
    'nameOrder2' => true
    );
    $dataarr['subject'] = strtoupper(trim(input::get('subject')));
}
if(!isset($addmessage)){
print_r($dataarr);
$validation = $validate->check($_POST,$dataval);
if($validation->passed()){
$data = new data();
$addmessage = $data->putnewcourse($user->data()->id,$dataarr);


}
  else{
    $addmessage="please enter valid info";
    
    $errors = $validation->errors();
    if(array_key_exists('category',$errors)){
      $caterror = implode(' ',$errors['category']);
    }
    if(array_key_exists('class',$errors)){
      $cerror = implode(' ',$errors['class']);
    }
    if(array_key_exists('board',$errors)){
      $berror = implode(' ',$errors['board']);
    }

    if(array_key_exists('stream',$errors)){
      $serror = implode(' ',$errors['stream']);
    }

    if(array_key_exists('subject',$errors)){
      $suerror = implode(' ',$errors['subject']);
    }
}
}
}
}
$token = token::generate();
?>

<link rel="stylesheet" href="style/teachercourse.css">
<script src="script/teacherscript.js" defer></script>
  <script src="script/teachercoursegetajax.js" defer></script>
<script defer>window.onload = function(){getcourses()};
</script>
<!-- notification -->
<?php if(isset($addmessage)){?>
<script>

      var note = '<?php echo $addmessage;?>';
      </script>
  
      <?php } ?>
            <!-- cousre query container -->
            <div class="querycontainer" id="newcourseform">
          <div class="coursequeryform">
              <div class="logocontainer _closelc" onclick="queryshfun('newcourseform')">
                  <span id=close></span>
                </div>
            <form action="" method="post" onsubmit="return submitcheck()" id="ccform">

            <div class="inputfield" id="categorycontainer">
            <label>Type</label>
            <select name="category"  class="inf" id="category" onchange="catchng()">
            <option for="category" value='' disabled hidden selected>select</option> 
                <option for="category" value='s'>schooling</option> 
                <option for="category" value='as'>after school</option> 
                <option for="category" value='g'>general</option>  
          </select>
          <div class="errors" id="categoryerror"><?php if(isset($caterror)){echo $caterror;} ?></div>
          </div>

          <div class="inputfield" id="boardcontainer" >
          <hr>
          <label>:Board</label>
            <select name="board"  class="inf" id="board" disabled onchange="inshfun()">
            <option for="board" value='none' disabled hidden selected disabled>select</option> 
            <option for="board" value="cbse">CBSE</option> 
            <option for="board" value="up" >UP</option> 
            <option for="board" value="forall">forall</option> 
          </select>
          <div class="errors" id="boarderror"><?php if(isset($berror)){echo $berror;} ?></div>
        </div>



          
              <div class="inputfield" id="classcontainer">
            <label>:Class</label>
            <select name="class"  class="inf" id="class" onchange="inshfun()" disabled>
            <option for="class" value='none' disabled hidden selected disabled>select</option> 
                <option for="class" value='12'>12th</option> 
                <option for="class" value='11'>11th</option> 
                <option for="class" value='10'>10th</option> 
                <option for="class" value='9'>9th</option> 
          </select>
        </div>

    

        <div class="inputfield" id="streamcontainer">
          <label>:stream</label>
          <select  class="inf" id="stream" onchange="inshfun()" name="stream"  disabled >
          <option for="stream" value='none' disabled hidden selected disabled>select</option> 
          <option for="stream" value="science">science</option> 
          <option for="stream" value="commerce">commerce</option> 
        </select>
        <div class="errors" id="streamerror"><?php if(isset($serror)){echo $serror;} ?></div>
      </div>
      

       
        <div class="inputfield" id="coursenamecontainer">
          <hr>
          <span class="cnote">write existing course name to <b>add new Subject</b></span>
          <label>:Course</label>
          <input type="text" placeholder="coursename" id="coursename" name="class" class="inf" disabled onfocus='cor.style="border:1px solid rgb(202, 202, 202);background-color:white;"'>
          <div id="courseerror" class="errors"><?php if(isset($cerror)){echo $cerror;} ?></div>
          </div>

          <div class="inputfield" id="yearcontainer">
            <label>:Year</label>
            <select name="year"  class="inf" id="year" onchange="inshfun()">
            <option for="year" value='none' disabled hidden selected disabled>select</option> 
                <option for="year" value='1st'>1st</option> 
                <option for="year" value='2nd'>2nd</option> 
                <option for="year" value='3rd'>3rd</option> 
                <option for="year" value='4th'>4th</option> 
                <option for="year" value='5th'>5th</option> 
          </select>
          <div class="errors" id="subjecterror"><?php if(isset($yerror)){echo $yerror;} ?></div>
        </div>

         <div class="inputfield" id="subjectnamecontainer">
           <hr>
        <label>:Subject</label>
          <input type="text" placeholder="Subject name" name="subject" id="subjectfield" class="inf" onfocus='statechange(sum,sum,true);sub.style="border:1px solid rgb(202, 202, 202);background-color:white;"'>
          <div class="errors" id="subjecterror"><?php if(isset($suerror)){echo $suerror;} ?></div>
          </div>



          <input type="hidden" name="token" class="token" value="<?php echo $token ?>">
          <input type="submit" value="Create" name="createcourse" class="button" id="submitbutton" disabled>
          </form>
        </div>
</div>


<!-- create a agreement later that confirms subject creation by sending otp to gmail -->

 <!-- section part begains////////////// -->
      <section id="pagecontentcontainer"> 
     <div id="pagecontent"></div>
     <div id="createcourse" class="button" onclick="queryshfun('newcourseform')"><b> + </b>Add Course/Subject</div>        
      </section>


      <!-- content section begins -->
      <section id="coursecontentcontainer" style="display:none">
                      <div id='coursecontent'>
                        <div id="index">
                        <h4>Index</h4>
                        <span id="chcount"></span>
                        <hr>
                        <div id="indexcontents">
                          </div>
                          <hr>
                          <!-- toggle class for logo conversion -->
                          <div class="button" id="addChapbtn" onclick="NQ()"><b>+</b> Add Chapter</div>
                          
</div>
<div id="indexdata">
<div id="lectures" class="coursedatacontainer">
                        <h4>lectures</h4>
                        <hr>
                        <div id='lecturescontainer'></div>
                        <div class="button" id="addlecbutton" onclick="NQL()"><b>+</b> Add Lecture</div>
                          
</div>
<div id="notes" class="coursedatacontainer">
                        <h4>Notes</h4>
                        <hr>

                          
</div>

<div id="exercise" class="coursedatacontainer">
                        <h4>Exercise</h4>
                        <hr>

                          
</div>

<div id="Tests" class="coursedatacontainer">
                        <h4>Test</h4>
                        <hr>
</div>
<div id="discussion" class="coursedatacontainer">
                        <h4>discussion</h4>
</div>
                        <div id="footnav">
                            <!-- <div class="logocontainer">  
                            <span onclick="displaysavedcourses()" class="coursesl"></span>
                            </div> -->
                            <div class="logocontainer">
                            <span onclick="getindexdata(this.id)" class="lecturesl indx" id="l"></span>
                            </div>
                            <div class="logocontainer">
                            <span onclick="getindexdata(this.id)" class="notesl indx" id="n"></span>
                            </div>
                            <div class="logocontainer">
                            <span class="exercisel"  onclick="getindexdata(this.id)"  id="e"></span>
                            </div>
                            <div class="logocontainer">
                            <span onclick="getindexdata(this.id)" class="testsl indx" id="t"></span>
                            </div>
                            <div class="logocontainer">
                            <span onclick="getindexdata(this.id)" class="discussionl indx" id="d"></span>
                            </div>
                      
                      </div>                    
</div>
</div>




<!-- new add chapter query -->
                          <div class="querycontainer" id="Ncontentquery">
          <div class="coursequeryform">
              <div class="logocontainer _closelc" onclick="queryshfun('Ncontentquery');">
                  <span id=close></span>
                </div>
            
         <div class="inputfield" id="namecontainer">
        <label id="modname">Chapter</label>
          <input type="text" name="chapter" placeholder="chapter name" id="chapterfield" class="inf" onfocus='statechange(sum,sum,true);sub.style="border:1px solid rgb(202, 202, 202);background-color:white;"' >
          <div class="errors" id="chaptererror"><?php if(isset($cherror)){echo $cherror;} ?></div>
          </div>
          <input type="hidden" name="token" id="chaptoken" class="token" value="<?php echo $token ?>">
          
          <input type="hidden" name="forcourse" id="forcourse" value="">
          <div  class="button ccbuttons" id="contentbutton" onclick="addchap()" ><b>+</b>Add</div>
          
        </div>
</div>
<!-- new chapter query add end -->
<!-- new lecture query add -->
<div class="querycontainer" id="NLcontentquery">
          <div class="coursequeryform">
              <div class="logocontainer _closelc" onclick="queryshfun('NLcontentquery');">
                  <span id=close></span>
                </div>
            
         <div class="inputfield" id="Lnamecontainer">
        <label id="modname">Lecture Title</label>
          <input type="text" name="chapter" placeholder="chapter name" id="titlefield" class="inf" >
          <div class="errors" id="lecerror"><?php if(isset($leerror)){echo $leerror;} ?></div>
          </div>
          
          <div class="inputfield" id="descontainer">
        <label id="modname">Description</label>
          <textarea  id="descriptionfield" class="inf" placeholder="Describe..." rows="8" ></textarea>
          <div class="errors" id="deserror"><?php if(isset($deserror)){echo $deserror;} ?></div>
          </div>
       
          <div class="inputfield" id="videocontainer">
        <div id="selvideo"><b> + </>Choose video</div>
          <div id="selectedfile">No video choosen</div>
          <div class="errors" id="viderror"><?php if(isset($viderror)){echo $viderror;}?></div>
          <hr>
          </div>
          <input type="file" name="file" id="videofield" class="inf" onchange="setselected()">

          <input type="hidden" name="token" id="chaptoken" class="token" value="<?php echo $token ?>">
          
          <input type="hidden" name="forchapter" id="forchapter" value="">
          
          <div  class="button ccbuttons" id="contentLbutton" onclick="addlect()" ><b>+</b>Add</div>
          
        </div>
</div>
<!-- new lecture query add end -->

                      </div>

            



                      <!-- new chapter query -->
                      
  </section>
  <div id="informcontainer" style="height:0px;opacity:0" onclick="notifysh()">
<div class="logocontainer _letterlc">
  <span id="letterlogo" class="fnotify"></span>
</div>
<div id="inform">
</div>
</div>
</body>
</html>
