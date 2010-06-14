<?php

function strip($string,$search,$sensitive=true)
{
 check(is_s($string));
 check(is_s($search));
 
 $result=null;
 $index=null;
 
 if($sensitive) 
  $index=strpos($string,$search);
 else
  $index=stripos($string,$search);
  
 if($index===false)
 {
  $result=$string;
 }
 else
 {
  assert($index>=0);
  
  $length=strlen($string);
  $length_search=strlen($search);
  $offset=$length-$length_search;  
  
  if($index===0)
   $result=right($string,$offset);
  else
   $result=$string;
 }
 
 return $result;
}

function strip_end($string,$search,$sensitive=true)
{
 check(is_s($string));
 check(is_s($search));
 
 $result=null;
 $index=null;
 
 if($sensitive) 
  $index=strrpos($string,$search);
 else
  $index=strripos($string,$search);
  
 if($index===false)
 {
  $result=$string;
 }
 else
 {
  check($index>=0);
  
  $length=strlen($string);
  $length_search=strlen($search);
  $offset=$length-$length_search;  
  
  if($index===$offset)
   $result=left($string,$offset);
  else
   $result=$string;
 }
 
 return $result;
}

?>
