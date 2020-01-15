<?php 
class getteachercourses{
  private $_sessionname,$_DB,$_subdataarr=array(),$_jencoded;
public function __construct(){
  $this->_sessionname = config::get("session/session_name");
  $user = session::get($this->_sessionname);
  $this->data($user);
}
private function data($id){
  $this->_DB = DB::getInstance();
  $dataarr = $this->_DB->get('teacherdata',array('id','=',$id));
  if($dataarr->first()){
  $subidarr = json_decode($this->_DB->first()->subject);
  foreach($subidarr as $subid){
    $tempdataarrobj = $this->_DB->get('courses',array('id','=',$subid));
    $this->_subdataarr[] = $tempdataarrobj->first();
  }
  $this->_jencoded = json_encode($this->_subdataarr);
}
  
}
public function returnjencode(){
  return $this->_jencoded;
}
}