<?php

function ssh()
{
 $arguments=func_get_args(); 
 
 $function='pass_thru';
 
 if($arguments[0]==='shell')
  $function=shift($arguments);
 
 $login=$arguments[0];
 
 check(contain($login,'@'));
 
 shift($arguments);
 
 $command=implode(' ',$arguments);
 
 return $function('ssh',$login,quote($command));
}

?>
