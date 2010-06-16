<?php

function println()
{
 $arguments=func_get_args();
 
 foreach($arguments as $argument)
 {
  echo $argument.' ';
 }
 
 echo crlf;
}

?>
