<?php

require_once dirname(__FILE__).'/cli.php';

$paths=array();

push_array($paths,scan_require(dirname(__FILE__).'/framework'));
push_array($paths,scan_require(dirname(__FILE__).'/cornac'));

$single=null;
 
foreach($paths as $path)
{
 $single.=load($path);
}

$path_stub=dirname(__FILE__).'/build/index.php';
$path_stub_debug=dirname(__FILE__).'/build/index-d.php';

save($path_stub,$single);
save($path_stub_debug,$single);

$single=php_strip_whitespace($path_stub);
$single=inline($single);
$single=str_replace(' ?> <?php ',crlf,$single);
$single=str_replace(' { ','{',$single);
$single=str_replace(' } ','}',$single);
$single=str_replace('( ','(',$single);
$single=str_replace(') ',')',$single);
$single=str_replace('; ',';',$single);
$single=trim($single);

save($path_stub,$single);

pass_thru('php','-l',$path_stub);
println();

pass_thru('php','-l',$path_stub_debug);
println();

println('compress',filesize($path_stub));
println('debug',filesize($path_stub_debug));
println('ratio',(int)((filesize($path_stub_debug)/filesize($path_stub)-1)*100),'%');

?>
