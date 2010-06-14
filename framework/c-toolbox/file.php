<?php

function load($path)
{
 return file_get_contents($path);
}

function save($path,$content)
{
 file_put_contents($path,$content);
 chmod($path,0666);
}

function path()
{
 $arguments=func_get_args();
 
 $result=implode('/',$arguments);
 $result=str_replace('//','/',$result);
 
 return $result;
}

?>
