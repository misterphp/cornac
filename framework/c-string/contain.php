<?php

function contain($string,$search,$sensitive=true)
{
 check(is_s($string));
 check(is_s($search));
 
 $result=false;
 $index=null;
 
 if($sensitive) 
  $index=strpos($string,$search);
 else
  $index=stripos($string,$search);
  
 if($index===false)
 {
 }
 else
 {
  check($index>=0);
  
  $result=true;
 }
 
 return $result;
}

function start($string,$search,$sensitive=true)
{
 check(is_s($string),$string);
 check(is_s($search),$search);
 
 $result=false;
 $index=null;
 
 if($sensitive) 
  $index=strpos($string,$search);
 else
  $index=stripos($string,$search);
  
 if($index===false)
 {
 }
 else
 {
  check($index>=0);
  
  if($index===0)
   $result=true;
 }
 
 return $result;
}

function end_($string,$search,$sensitive=true)
{
 check(is_s($string));
 check(is_s($search));
 
 $result=false;
 $index=null;
 
 if($sensitive) 
  $index=strrpos($string,$search);
 else
  $index=strripos($string,$search);
  
 if($index===false)
 {
 }
 else
 {
  check($index>=0);
  
  $length=strlen($string);
  $length_search=strlen($search);
  $offset=$length-$length_search;  
  
  if($index===$offset)
   $result=true;
 }
 
 return $result;
}

?>
