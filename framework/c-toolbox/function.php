<?php

function call()
{
 $arguments=func_get_args();
 
 $object=shift($arguments);
 $function=null;
 
 if(is_string($object))
 {
  $function=$object;
  $object=null;
 }
 else 
  $function=shift($arguments);
 
 if(count($arguments)===1)
 {
  if(is_array($arguments[0]))
  {
   $arguments=$arguments[0];
  }
 }
 
 if($object===null)
  return call_user_func_array($function,$arguments);
  
 return call_user_func_array(array($object,$function),$arguments);
}

?>
