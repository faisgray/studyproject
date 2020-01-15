<?php
class coursesdata{

private $_db;

public function __construct(){
  $this->_db = DB::getInstance();

}
private function fetchdata($chapter){
$this->_db->get('chapters',array('sno','=',$chapter));
if($this->_db->count() != 0){
  return json_encode(array(true,$this->_db->first()));

}
else return json_encode(array(false,'no data found for chapter',$chapter));
}
public function cdataget($chapter){
  return $this->fetchdata($chapter);
}
}