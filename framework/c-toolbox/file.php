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

function umod($path)
{
 $normal=null;
 
 if(is_file($path))
  $normal='666';
 elseif(is_dir($path))
  $normal='777';
 else
  return false;
 
 $mod=fileperms($path);
 $mod=decoct($mod);
 $mod=right($mod,3);
 
 if($mod===$normal)
  return false;
   
 chmod($path,octdec($normal));
  
 clearstatcache();
 
 return true;
}

?>
