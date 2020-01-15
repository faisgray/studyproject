<?php  
class addteachercoursecontents{
  private $_db,$_sessionName,$_user;

public function __construct(){
$this->_db = DB::getInstance();
$this->_sessionName = config::get("session/session_name");
$this->_user = session::get($this->_sessionName);
}

private function Paddchap($chap,$subj){
$this->_db->get('teacherdata',array('id','=',$this->_user));
if($this->_db->count() !== 0){
$tdata = $this->_db->first();
$tdatasub = json_decode($tdata->subject);

$match = false;
foreach($tdatasub as $tds){
  if($tds == $subj){
    $match = true;
  }
}
  if($match){
    $this->_db->get('courses',array('id','=',$subj));
    $tsubdata = $this->_db->first();
    // $tsubdata = json_encode($tsubdata);
    if($this->_db->count() !== 0){
$chaps = $tsubdata->chapters;
$id=uniqid($this->_user);

if($chaps == ''){
  $this->_db->insert('chapters',array('id'=> $id,'name'=>$chap,'created'=>date('y/m/d')));
  $this->_db->get('chapters',array('id','=',$id));
  $chapserial = $this->_db->first()->sno;
  $chap = json_encode(array($chap=>$chapserial));
  $this->_db->update('courses',$subj,array('chapters'=>$chap));
  return json_encode(array(true,'course successfully added',$chapserial));
}
else if($chaps != ''){
  $chaps = json_decode($chaps);
  
    $x=0;
  foreach($chaps as $chapkey => $chapvalue){
    if($chapkey == $chap){
      return json_encode(array(false,'chapter already exist'));
    }
    $x++;
  }  
  if($x < 30){
  $this->_db->insert('chapters',array('id'=> $id,'name'=>$chap,'created'=>date('y/m/d')));
  $this->_db->get('chapters',array('id','=',$id));
  $chapserial = $this->_db->first()->sno;

  $chaps->$chap = $chapserial;
  $chaps = json_encode($chaps); 
  $this->_db->update('courses',$subj,array('chapters'=>$chaps));

      
  return json_encode(array(true,'course successfully added',$chapserial));
    }else{
            return json_encode(array(false,'chapter limit approach for this course'));
    }
    }
  }
  }else{
    return json_encode(array(false,'chapter add fail please try again'));
  }
}
}


public function addchap($chap,$subject){
  return $this->Paddchap($chap,$subject);
}
}
?>