<?php

function scan_require($directory=null)
{
 $result=array();
 
 if($directory===null) 
  $directory=dirname(__FILE__).'/framework';
 
 $require=$directory;
 $require=realpath($directory);
 
 foreach(scandir($require) as $directory)
 {
  if($directory==='.')
   continue;

  if($directory==='..')
   continue;
   
  $directory=$require.'/'.$directory;
  
  foreach(scandir($directory) as $file)
  {
   if($file==='.')
    continue;

   if($file==='..')
    continue;
    
   $result[]=$directory.'/'.$file;   
  }
 }
 
 return $result;
}

function require_all($directory=null)
{
 $paths=scan_require($directory);
 
 foreach($paths as $path)
 {
  require_once $path;
 }
 
 return $paths;
}

?>
