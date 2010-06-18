<?php

function tgz($directory,$path)
{
 check(is_dir($directory),$directory);
 check(!file_exists($path),$path);
 
 $parent=real_path($directory,'..');
 $name=basename($directory);
 
 shell('cd',$parent,'&&','tar','cvzfh',$path,$name);
 
 check(is_file($path));
 umod($path);
}

?>
