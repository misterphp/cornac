<?php

function find($directory)
{
 $result=array();
 $directory=realpath($directory);
 
 foreach(scandir($directory) as $file)
 {
  if($file==='.')
   continue;

  if($file==='..')
   continue;
   
  $path=path($directory,$file);
  
  $result[]=$path; 
    
  if(is_dir($path))  
   push_array($result,find($path));
 }
 
 return $result;
}

?>
