<?php

function nil($mixed)
{
 if($mixed===null)
  return true;
  
 if($mixed==='')
  return true;
  
 return false;
}

?>
