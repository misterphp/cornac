<?php

function build_number($value=null)
{
 $directory=real_path(dirname(__FILE__),'../../build');
 $path=path($directory,'build-number.txt');

 $result=1;

 if(is_file($path))
  $result=uncompress(load($path));
 
 if($value!==null)
  save($path,compress($value));

 return $result;
}

?>
