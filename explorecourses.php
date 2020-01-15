<?php
require_once "core/init.php";
?>



<div id="subnav">
<!-- cinfirmblock -->
<div id="confirmadd" >
  <div id="confirmfor">
  <div class="logocontainer _closelc" onclick="confirmsh()">
                  <span id=close></span>
                </div>
                <input type="hidden" id="corid" value="">
                <input type="hidden" id="cortoken" value="<?php echo token::generate() ?>">
  <div class="subjecttitle" id="confirmtitle">This subject will be added to your library!</div>
    <div id="ccourse">
</div>

    <div class="button _addbutton" id="confirmbutton" onclick="confirmadd()">Confirm</div>

  </div>
</div>
  <div id="subnavheading">
<h3 class="heading" >EXPLORE COURSES</h3>
<div class="logocontainer _inlinef" id="coursesfilter" title="courses filter" onclick="displayfilters()">
  <span id="filterlogo"></span>
</div>
<br style="clear:both">
</div>
<hr class="subnavbottom">
<!-- subnav close -->

</div>
<div id="filtercontainer" style="height:355px">
<h4 class="heading">Filter courses</h4>

  <div id="filters">


  <div id="scrolll" class="logocontainer" onclick="changefilter(this.id)">
  <div id="scrollleftlogo"></div>
  </div>
  
    <div id="filtersfloating"><div class="filtercategory" id="asc"  style="width:0px;opacity:0;">
    <div class="filtercategoryinside" id="as">
<input type="hidden" name="category" value="as" id="ascategory"> 
  <table>
  <tr><td colspan="2">College Courses<hr></td><td></td></tr>
    <tr><td>Course</td></tr>
    <tr><td><input type="text" name='coursename' class="inf"  id="ascourse"></td></tr>
    <tr><td>Subject</td></tr>
    <tr><td><input type="text" name='subjectname' class="inf"  id="assubject"></td></tr>
    <tr>
            <td>Year 
            <select name="year"  class="inf _filterfields" id="asyear">
            <option for="year" value='none' disabled hidden selected disabled>select</option> 
                <option for="year" value='1st'>1st</option> 
                <option for="year" value='2nd'>2nd</option> 
                <option for="year" value='3rd'>3rd</option> 
                <option for="year" value='4th'>4th</option> 
                <option for="year" value='5th'>5th</option> 
          </select>
</td>
</tr>
    <tr><td colspan="2"> <div class="button" id="asfa" onclick="getascourses()">apply</div></td><td></td>
</tr>
  </table>
</div>
</div><div class="filtercategory" id="sc"  style="width:200px;opacity:100;">
    <div class="filtercategoryinside" id="s">
  <table>
    <input type="hidden" name="category" value="s" id="scategory" > 
    <tr><td colspan="2" style="text-align:center">School courses<hr></td><td></td></tr>
    <tr><td>Board</td>
    <td><select class="inf filterselect" name="sboard"  id="sboard">
    <option value="none" selected>-</option>
      <option value="CBSE">CBSE</option>
      <option value="UP">UP</option>
      <option value="other">OTHER</option>
      
    </select></td>
  </tr>
    <tr>
      <td>Class</td>
    <td>
      <select class="inf filterselect" id="sclass" 
      onchange="streamvis()"
      >
    <option value="none" selected>-</option>
      <option value="12">12</option>
      <option value="11">11</option>
      <option value="10">10</option>
      <option value="9">9</option>
    </select>
  </td>
</tr>
<tr id="filterstreamcontainer">
          <td>Stream</td>
          <td>
          <select  class="inf _filterfields" id="sstream" name="stream" >
          <option for="stream" value='none' disabled hidden selected disabled>select</option> 
          <option for="stream" value="science">science</option> 
          <option for="stream" value="commerce">commerce</option> 
        </select>
        </td>
</tr>
    <!-- <tr><td>Teacher</td><td><input type="text" name='teachernamefilter' class="inf _filterfields"   id="steacher"></td></tr> -->
    <tr><td>Subject</td><td><input type="text" name='subjectfilter' class="_filterfields inf"   id="ssubject"></td></tr>
    <tr><td>chapter</td><td><input type="text" name='chapterfilter' class="inf _filterfields"   id="schapter"></td></tr>
    <tr><td colspan="2"> <div class="button" id="sfa" onclick="getscourses()">apply</div></td><td></td>
</tr>

  </table>
</div>
</div><div class="filtercategory" id="gc" style="width:0px;opacity:0;">
<div class="filtercategoryinside" id="g">

  <table>
  <input type="hidden" name="category" value="g" id="gcategory" >
  <tr><td colspan="2">General courses<hr></td><td></td></tr>
    <tr><td>Course</td></tr>
    <tr><td><input type="text" name='gcoursename' class="inf"   id="gcourse"></td></tr>
    <tr><td>Subject</td></tr>
    <tr><td><input type="text" name='gsubjectname' class="inf"  id="gsubject"></td></tr>
    <tr><td colspan="2"> <div class="button" id="gfa" onclick="getgcourses()">apply</div></td><td></td>

  </table>
</div>
</div>
<!-- close filterfloating -->
</div>


<div id="nscrolll" class="logocontainer" onclick="changefilter(this.id)">
<div id="scrollrightlogo"></div>
</div>

<!-- close filters -->
</div>

<!-- filtercontainer close -->
  </div>


<div id="recommandedhead">
<!-- <h4 class="heading">Recommended</h4> -->
<div class="button" id="clearfilterbutton" onclick="cleanfilters()"><b>X</b> Clear Filters</div>
<br style="clear:both;">
</div>
<div id="coursebox">
</div>
<hr>

