<?php

class Tag
{
 public $name;
 public $text;
 public $option;
 
 public $attributes=array();
 public $styles=array();
 public $children=array(); 
 
 function initialize()
 {
 }
 
 function add($name)
 {
  $class=$name.'Tag';
  
  if(!class_exists($class))
   $class='Tag';
   
  $result=new $class;
    
  $result->name=$name;
  $result->initialize();
  
  $this->children[]=$result;
  
  return $result;
 }
 
 function text()
 {
  $arguments=func_get_args();
  
  if(count($arguments)===0)
   return $this->text;
   
  $this->text=implode(' ',$arguments);
  
  return $this;
 }
 
 function attr()
 {
  $arguments=func_get_args();
  
  if(count($arguments)===0)
   return $this->attributes;
  elseif(count($arguments)===1)
   return get($this->attributes,$arguments[0]);
  elseif(count($arguments)===2)
  {
   $this->attributes[$arguments[0]]=$arguments[1];
   
   return $this;
  }
  else
   stop();
 }

 function width()
 {
  $arguments=func_get_args();
  
  unshift($arguments,'width');
  
  return call($this,'attr',$arguments);
 }
 
 function height()
 {
  $arguments=func_get_args();
  
  unshift($arguments,'height');
  
  return call($this,'attr',$arguments);
 }
 
 function align()
 {
  $arguments=func_get_args();
  
  unshift($arguments,'align');
  
  return call($this,'attr',$arguments);
 }

 function valign()
 {
  $arguments=func_get_args();
  
  unshift($arguments,'valign');
  
  return call($this,'attr',$arguments);
 }
 
 function export($depth=0)
 {
  $indent=str_repeat(' ',$depth);
  $attributes=$this->export_attributes();
  $text=$this->export_text();
    
  $open='<'.$this->name.$attributes.'>';
  $close='</'.$this->name.'>';
  
  $inner=null;
  
  foreach($this->children as $child)
  {
   $inner.=$child->export($depth+1);   
  }
  
  $result=null;
  
  if($this->option===null)
  {
   $result=$indent.$open.crlf;
  
   if(!nil($text))
    $result.=' '.$indent.$text.crlf;
  
   $result.=$inner;
   $result.=$indent.$close.crlf;
  }
  elseif($this->option==='inline')
  {
   $result=$indent.$open.inline($text.$inner).$close.crlf;
  }
  elseif($this->option==='pre')
  {
   $result=$indent.$open.h($this->text).$inner.$close.crlf;
  }
  else
   stop();
   
  return $result;
 }

 function export_attributes()
 {
  $result=null;
  
  foreach($this->attributes as $name=>$value)
  {
   $attribute=quote(h($value));
      
   $result.=$name.'='.quote($value).' ';
  }
  
  $result=trim($result);
  
  if(!nil($result))
   $result=' '.$result;
  
  return $result;
 } 

 function export_text()
 {
  $result=$this->text;
  $result=inline($result);
  $result=h($result);
  
  return $result;
 }
}

?>
