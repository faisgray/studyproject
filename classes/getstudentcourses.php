<?php 
class getstudentcourses{
  private $_studentcoursesarr = array(),$_db;

  private function fetchstudentcourses($filter){
    $this->_db = DB::getInstance();
if(!$filter){ /*if filter not applied */
// get first 50 courses from database and back to javascript;
$this->_studentcoursesarr = $this->_db->get('courses',array(),array(),'joined',50);
$this->_studentcoursesarr = $this->_db->results();

return $this;
}
else if($filter){
  $this->_db->get('courses',$filter,array(),'joined');
  $this->_studentcoursesarr = $this->_db->results();

return $this;
}
  }

public function studentcourses($filter = null){
if($this->fetchstudentcourses($filter)){
return json_encode($this->_studentcoursesarr);
}
}



}
?>