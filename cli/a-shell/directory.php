<?php

function mk_dir()
{
 $arguments=func_get_args();
 
 $path=call('path',$arguments);
 
 if(!is_dir($path))
  check(mkdir($path,0777,true),$path);
  
 check(chmod($path,0777));
}

function rmk()
{
 $arguments=func_get_args();
 
 $path=call('path',$arguments);
 
 pass_thru('rm','-rfv',$path);
 mk_dir($path);
 
 return $path;
}

function cp_dir($source,$target)
{
 check(is_dir($source));
 
 rmk($target);
 
 $source=realpath($source);
 $target=realpath($target); 
 
 $paths=find($source);
 
 foreach($paths as $path)
 {
  $path_target=strip($path,$source);
  $path_target=path($target,$path_target);
  
  if(is_dir($path))
   mk_dir($path_target);
  elseif(is_file($path))
   cp($path,$path_target);
  else
   stop();
  
  println($path_target);
 }
}

?>
