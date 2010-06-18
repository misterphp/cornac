<?php

function byte($size)
{
 check(is_numeric($size));
 
 $result=null;
 $size=(float)$size;
 
 check($size>=0);
 
 if($size>1024*1024*1024)
  $result=sprintf('%.02f Gb',$size/1024/1024/1024);
 elseif($size>1024*1024)
  $result=sprintf('%.02f Mb',$size/1024/1024);
 elseif($size>1024)
  $result=sprintf('%.02f Kb',$size/1024);
 else
  $result=sprintf('%.02f b',$size);
 
 $result=str_replace('.00','',$result);
 $result=inline($result);
 
 return $result;
}

?>
