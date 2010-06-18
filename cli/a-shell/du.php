<?php

function du($path)
{
 $result=0; 
 
 if(is_file($path))
 {
  $result+=file_size($path);
 }
 elseif(is_dir($path))
 {
  $paths=ls($path);
 
  foreach($paths as $path=>$file)
  {     
   if(is_dir($path))
   {
    $result+=du($path);
   }   
   elseif(is_file($path))
   {
    $result+=file_size($path);
   }
   else
    stop();
  }
 }
 else
  stop();
 
 return $result;
}

?>
