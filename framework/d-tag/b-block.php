<?php

class BlockTag extends Tag
{
}

class PreTag extends BlockTag
{
 function initialize()
 {
  parent::initialize();
  
  $this->option='pre';
 }
 
 function import()
 {
  $arguments=func_get_args();
  
  if(count($arguments)===1)
   $arguments=$arguments[0];
   
  $this->text(var_export($arguments,true));
  
  return $this;  
 }
}

?>
