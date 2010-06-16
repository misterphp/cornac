<?php

function umod_dir($directory)
{
 $paths=find($directory);

 foreach($paths as $path)
 {
  if(umod($path))
   println($path);
 }
}

?>
