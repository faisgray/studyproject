<?php
require_once 'profileheader.php';
?>

<style>
#courselogo{
  background-position:0px -125px;
}

</style>
<script src="script/studentcoursegetajax.js" defer></script>
      <!-- section part begains////////////// -->
      
  <section id="pagecontentcontainer"> 
        <div id= 'pagecontent'></div>

              <div id="createcourse" class="button" onclick="explorecourses()">
                <span><b> Explore Courses</b></span>
              </div>

                
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
<div id="indexdata">
<div id="lectures" class="coursedatacontainer">
                        <h4>lectures</h4>
                        <hr>
                        <div id='lecturescontainer'></div>
                          
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
                      <!-- indexdata closes -->
</div>
<!-- course content closes -->
</div>





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