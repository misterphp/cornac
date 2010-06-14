<?php

function is_s($mixed)
{
 if($mixed===null)
  return true;
 
 return is_string($mixed);  
}

function scalar($mixed)
{
 if(is_scalar($mixed))
  return true;

 if($mixed===null)
  return true;
  
 return false;
}

function is_word($mixed)
{
 $result=false;
 
 if(is_s($mixed))
 {
  $word=$mixed;
  $word=inline($word);
  $word=str_replace(' ',null,$word);
  
  if($mixed===$word)
   $result=true;
 }
 
 return $result;
}

?>
