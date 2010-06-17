<?php

require_once dirname(__FILE__).'/cli.php';

$build_number=build_number();
$build_number++;

$build_php=path(dirname(__FILE__),'cornac/a/build.php');

$lines=array();

$lines[]='<?php';
$lines[]='$_build_number='.$build_number.';';
$lines[]='?>';

save($build_php,implode(crlf,$lines));

$build=path(dirname(__FILE__),'build');

rmk($build);

build_number($build_number);

$paths=array();

push_array($paths,scan_require(dirname(__FILE__).'/framework'));
push_array($paths,scan_require(dirname(__FILE__).'/cornac'));

$single=null;
 
foreach($paths as $path)
{
 $single.=load($path);
}

$path_stub=path($build,'index.php');
$path_stub_debug=path($build,'index-d.php');

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
