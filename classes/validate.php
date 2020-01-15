<?php
class validate{
  private $_passed = false,
          $_errors = array(),
          $_temp=array(),
          $_db = null;
  public function __construct(){
    $this->_db = DB::getInstance();
  }
  public function check($source,$items = array()){
foreach($items as $item => $rules){
  $this->_temp = array();
foreach($rules as $rule => $rule_value){
  $value = trim($source[$item]);
  $item = escape($item);
  if($rule === 'required' && empty($value)){
    $this ->addError("{$item}","please fill this field");
  }
  else if(!empty($value)){
    switch($rule){
      case 'min':
if(strlen($value) < $rule_value){
  $this->addError("{$item}","this must be a minimum of {$rule_value}");
}
      break;
      case 'max':
      if(strlen($value) > $rule_value){
        $this->addError("{$item}","this must be a maximum of {$rule_value}");
      }
      break;
      case 'correction':
      if(preg_match("$rule_value",$source[$item])){
$source[$item] = preg_replace("$rule_value",'.com',$source[$item]);

      }
      break;
      case 'matches':
      if($value != $source[$rule_value]){
$this->addError("{$item}","please enter same password");
      }
      break;
      case 'unique':
        $check = $this->_db->get($rule_value,array('username','=',$value));
        if($check->count()){
          $this->addError("{$item}","already exists,please enter another email");
        }
        break;
        case 'order':
        if(!filter_var($value,$rule_value)){
          $this->addError("{$item}",'please enter valid email');
        }
        break;
        case 'correct':
 if(strlen($value)<5 || strlen($value) > 20){
 $this->addError("{$item}","please enter correct password");}
 break;
        case 'nameOrder':
        if(!preg_match('/^[A-Za-z ]+$/',$value)){
$this->addError("{$item}",'please use letters only');
        }
        break;
        case 'nameOrder1':
        if(!preg_match('/^[A-Za-z1-90. ]+$/',$value)){
$this->addError("{$item}",'please use letters and numbers only');
        }
        break;
        case 'digits':
        if(!preg_match('/^[0-9]+$/',$value)){
          $this->addError("{$item}",'please enter numbers only');
        }
        break;
        case 'nameOrder2':
        if(!preg_match('/^[A-Za-z1-90+. ]+$/',$value)){
$this->addError("{$item}",'please use letters and numbers only');
        }
        break;
    }
  } 
}
// first loop closes here after;
}
if(empty($this->_errors)){
  $this->_passed = true;
}
return $this;
}

private function addError($item,$error){
  $this->_temp[]=$error;
  $this->_errors[$item]=$this->_temp;
}
public function errors(){
  return $this->_errors;
}
public function passed(){
  return $this->_passed;
}



    }
?>