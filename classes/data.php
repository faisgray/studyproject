<?php
class data{
  private $_contents,$_db,$_isloggedin =false,$_sessionName,$_cookieName;
  public function __construct($table = null,$id = null){
$this->_db = DB::getinstance();
if($id){
$data = $this->_db->get($table,array('id','=',$id)) ;
if($data->count()){
$this->_contents = $data->first();
return true;
}
}
 }
 public function putnewcourse($id,$data){
  
  // check already exists if courses found
  try{
   $teacherdata = $this->_db->get('teacherdata',array('id','=',$id));
  
  
   if($teacherdata->count()){
     $match = '1';
     $matchcoursearr = array();

    //  got ids

     $subjectids = $teacherdata->first()->subject;
     $subjectids = json_decode($subjectids);

     // got name

    
     
     
     if(count($subjectids) < 9){
     
     foreach($subjectids as $subjectid){
     $existingcoursesobj = $this->_db->get('courses',array('id','=',$subjectid));
     $existingcourse = $existingcoursesobj->first();
     foreach($data as $datakey => $datavalue){
       
       if($existingcourse->$datakey != $datavalue){  
         $match = '0';
       }
     } 
     $matchcoursearr[] = $match;
     $match = '1';
    }
    if(!in_array('0',$matchcoursearr)){
      $match = '1';
    }
    else if(!in_array('1',$matchcoursearr)){
      $match = '0';
    }

    if($match == '1'){
      return 'course already exists';
     }
    if($match == '0'){
      $teachernameobj = $this->_db->get('users',array('id','=',$id));
      $teachername = array($teachernameobj->first()->name);
      $teachername = array('teacher' => json_encode($teachername));

      $serialsubjectid = array(uniqid($id));
      $sid = array( 'id' => $serialsubjectid[0]);
      $data  = array_merge($sid,$data);
      $data  = array_merge($teachername,$data);

      $subjectids = array_merge($subjectids,$serialsubjectid);

      $dataarr = array('subject' => json_encode($subjectids));
      $data['created'] = date("Y/m/d");
      $this->_db->update('teacherdata',$id,$dataarr);
      if($this->_db->insert('courses',$data)){
        
        return 'created successfully';
      }
    }
  }else{
      return 'courses limit approached';
  }
  }
  else if(!$teacherdata->count()){
$serialsubjectid = array(uniqid($id));
$sid = array( 'id' => $serialsubjectid[0]);
$data  = array_merge($sid,$data);
$serialsubjectid = json_encode($serialsubjectid);
$teacherdataarr = array('id' =>$id,'subject' => $serialsubjectid);

if($this->_db->insert('teacherdata',$teacherdataarr)){
  $data['created'] = date("Y/m/d");
  $teachernameobj = $this->_db->get('users',array('id','=',$id));
      $teachername = array($teachernameobj->first()->name);
  $teachername = array('teacher' => json_encode($teachername));
  $data  = array_merge($teachername,$data);
  if($this->_db->insert('courses',$data)){
    return 'created successfully';
  }
  }
}
  }
  catch(exception $e){
    redirect::to(404);
  }  
}

  public function contents(){
    return $this->_contents;
  }
}
?>