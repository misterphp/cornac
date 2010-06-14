<?php

function s()
{
 $arguments=func_get_args();
 
 return implode(' ',$arguments);
}

function quote()
{
 $arguments=func_get_args();
 
 $result=implode(' ',$arguments);
 $result='"'.$result.'"';
 
 return $result;
}

function inline()
{
 $arguments=func_get_args();
 
 $result=implode(' ',$arguments); 
 $result=str_replace("\n",' ',$result);
 $result=str_replace("\r",' ',$result);
 $result=str_replace("\t",' ',$result);
 $result=str_replace('  ',' ',$result);
 $result=trim($result);
 
 return $result;
}

?>
