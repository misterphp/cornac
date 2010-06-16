<?php

function left($string,$count)
{
 check(is_s($string)); 
 check($count>=0);
 
 $result=substr($string,0,$count);
 
 check(is_s($result));
 
 return $result;
}

function right($string,$count)
{
 check(is_s($string)); 
 check($count>=0);
 
 $result=null;
 
 if($count>0)
 {
  $count=$count*-1;
 
  $result=substr($string,$count);
 }
 
 check(is_s($result));
 
 return $result;
}

?>
