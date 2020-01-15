<?php
class addstudentcourses{
 private $_id,$_sessionName,$_db;
 public function __construct(){
   $this->_db = DB::getInstance();
   $this ->_sessionName = config::get('session/session_name');
   $this->_id =session::get($this->_sessionName);
   
 }
private function paddscourse($data){
  $courseid = $this->_id.$data;
  $date = date("y/m/d");
  $this->_db->get('studentdata',array('id','=',$this->_id));
if($this->_db->count() == 0){
  $data = array($data);
  $data = json_encode($data);
  // var_dump($data);
  // var_dump($this->_id);
$this->_db->insert('studentdata',array('id' => $this->_id,'subject' => $data));

$this->_db->insert('studentcourses',array('id' => $courseid,'joined' => $date));
return true;
}
else if($this->_db->count() != 0){
  $existingsdata = $this->_db->first()->subject;
  $existingsdata = json_decode($existingsdata);
  
  if(!in_array($data,$existingsdata)){
  $existingsdata[] = $data;
  $existingsdata = json_encode($existingsdata);
 $this->_db->update('studentdata',$this->_id,array('subject' => $existingsdata));
  $this->_db->insert('studentcourses',array('id' => $courseid,'joined' => $date));
return true;
  }else{
   return false;
  }
}
}

public function addscourse($data){
return $this->paddscourse($data);
}
}