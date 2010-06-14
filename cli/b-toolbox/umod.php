<?php

function umod_dir($directory)
{
 $paths=find($directory);

 foreach($paths as $path)
 {
  $mod_new=null;
  
  if(is_file($path))
  {
   $mod_new='666';
  }
  elseif(is_dir($path))
  {
   $mod_new='777';
  }
  
  if($mod_new===null)
   continue;
  
  $mod=fileperms($path);
  $mod=decoct($mod);
  $mod=right($mod,3);
  
  if($mod===$mod_new)
   continue;
   
  println($path);
  
  chmod($path,octdec($mod_new));
  
  clearstatcache();
 }
}

?>
