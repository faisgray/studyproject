<?php
class placestudentcourses{
private $_db,$_coursesarr = array(),$_id,$_sessionName;
  public function __construct(){
$this->_db = DB::getInstance();
$this->_sessionName = config::get('session/session_name');
$this->_id = session::get($this->_sessionName);
  }
  private function fetchcourses(){
$this->_db->get('studentdata',array('id','=',$this->_id));
if($this->_db->count() == 0){
  return false;
}else{
  $subjectsarr = $this->_db->first()->subject;
  $subjectsarr = json_decode($subjectsarr);

          foreach($subjectsarr  as $subject){
            if($this->_db->get('courses',array('sno','=',$subject))){
            $this->_coursesarr[] = $this->_db->first();
            }

          }
          return $this->_coursesarr;
}


  }
  public function getsavecourses(){
return $this->fetchcourses();
  }

}