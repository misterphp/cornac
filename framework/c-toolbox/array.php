<?php

function get($array,$key)
{
 if(array_key_exists($key,$array))
  return $array[$key];
 
 return null;
}

function shift(&$array)
{
 return array_shift($array);
}

function unshift(&$array,$value)
{
 array_unshift($array,$value);
}

function push_array(&$array,$item)
{
 foreach($item as $key=>$value)
 {
  if(is_int($key))
   $array[]=$value;
  else
   $array[$key]=$value;
 }
}

?>
