<?php

function check()
{
 $arguments=func_get_args();
 
 if(!$arguments[0])
  throw new Exception;
}

function stop()
{
 $arguments=func_get_args();
 
 throw new Exception;
}

?>
