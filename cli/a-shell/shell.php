<?php

function shell()
{
 $arguments=func_get_args(); 
 $result=array();
 
 $command=implode(' ',$arguments);
 
 println($command);
 
 exec($command,$result);
 
 clearstatcache(); 
 
 return $result;
}

function pass_thru()
{
 $arguments=func_get_args();
 
 $command=implode(' ',$arguments);
 
 println($command);
 passthru($command);
 
 clearstatcache(); 
}

?>
