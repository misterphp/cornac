<?php

function un_link()
{
 $arguments=func_get_args();
 
 $path=call('path',$arguments);
 
 if(is_file($path))
 {
  check(unlink($path));   
  
  clearstatcache();
 }
}

function cp($source,$target)
{
 if(is_file($source))
 {
  if(is_dir($target))
  {
   $target=realpath($target);
   $target=path($target,basename($source));
  }  
  elseif(is_file($target))
   un_link($target);  
 
  check(copy($source,$target));
  chmod($target,0666);
 }
 elseif(is_dir($source))
 {
  cp_dir($source,$target);
 }
 else
  stop();
}

?>
