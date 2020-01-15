<?php
class DB{
  private static $_instance = null;
  private $_pdo,
  $_query,
  $_error = false,
  $_results,
  $_count = 0;

  private function __construct(){
    try{
      $this->_pdo = new PDO('mysql:host='.config::get('mysql/host').';dbname='.config::get('mysql/db'),config::get('mysql/username'),config::get('mysql/password'));
     
    }
    catch(PDOException $e){
      die($e->getMessage());
    }
  }

  public static function getInstance(){
    if(!isset(self::$_instance)){
      self::$_instance = new DB();
    }
    return self::$_instance;
  }
// query execution
  public function query($sql,$params = array()){
    $this->_error = false;
    if($this->_query = $this->_pdo->prepare($sql)){
    
      $x = 1;
      if(count($params)){
        foreach($params as $param){
          $this->_query->bindValue($x,$param);
          $x++;
        }
      }
      if($this->_query->execute()){
        $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
        $this->_count = $this->_query->rowCount();
        
      }
      else {
        foreach($this->_query->errorInfo() as $err){
          echo $err;
         }
        $this->_error = true;
   
      }

    }
    return $this;
  }
  private function action($action,$table,$where,$group,$order,$limit){

    $wherequery ="";
    $groupvar = "";
    $ordervar="";
    $limitvar = "";

    $valuearr = array();
    $operator = array();

    $operators = array('=','<','>','>=','<=');
    if(count($where)%3 == 0 && count($where) != 0){
      
      $y=0;
      $wherequery=" WHERE ";
    for($x = 0;$x <count($where)/3 ; $x++){

      if($x != 0){
        $wherequery = $wherequery." and ";
      }
      
      $wherequery =$wherequery."{$where[0+$y]} {$where[1+$y]} ?";
      $operator[] = $where[1+$y];
      $valuearr[] = $where[2+$y];
      $y += 3;
    }
  }
    if(!empty($group)){
      $groupvar = ' GROUP BY ';
      foreach($group as $groupfor){
$groupvar = $groupvar.$groupfor.',';
      }
      $groupvar = substr($groupvar,0,-1);
    }
if($order){
  $ordervar = ' ORDER BY '.$order;
}
    if($limit){
      $limitvar = " LIMIT ".$limit;
    }
      if(count(array_intersect($operator,$operators))==count($operator)){
        $sql = "{$action} FROM {$table}{$wherequery}{$groupvar}{$ordervar}{$limitvar}";
        if(!$this->query($sql,$valuearr)->error()){
          return $this;
        }
      }
  }


  public function get($table,$where=array(),$group= array(),$order = false,$limit = false){
    return $this->action('select *',$table,$where,$group,$order,$limit);
  }

  


  public function delete($table,$where){
    return $this->action('DELETE',$table,$where,array(),'','');
  }

  public function insert($table,$fields=array()){
    $keys = array_keys($fields);
    $values = '';
    $x = 1;
    foreach($fields as $field){
    $values .= '?';
    if($x < count($fields)){
    $values .= ', ';
    }
    $x++;
    }
    $sql = "INSERT INTO {$table} (`" . implode('`,`',$keys) . "`) VALUES ({$values}) ";
    if(!$this->query($sql,$fields)->error()){

      return true;
    }
    
    return false;
  }
public function update($table,$id,$fields){
$set ='';
$x = 1;
foreach($fields as $name => $value){
$set .="{$name} = ?";
if($x < count($fields)){
  $set .=', ';
}
$x++;
}
$sql = "UPDATE {$table} SET {$set} WHERE id = '{$id}'";
if(!$this->query($sql,$fields)->error()){
  return true;
}
return false;
}


public function error(){
  return $this->_error;
}
public function count(){
  return $this->_count;
}
public function results(){
  if(empty($this->_results)){
    return false;
  }
  else{
  return $this->_results;
  }
}
public function first(){
  if(empty($this->_results[0])){
    return false;
  }
  else{
  return $this->_results[0];
  }
}


}