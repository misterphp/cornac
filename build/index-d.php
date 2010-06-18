<?php

$GLOBALS['_start']=microtime(true);

define('crlf',"\r\n");

ini_set('display_errors','1');

?>
<?php

function check()
{
 $arguments=func_get_args();
 
 if(!$arguments[0])
  throw new Exception;
}

function stop()
{
 $arguments=func_get_args();
 
 throw new Exception;
}

?>
<?php

function on_exception($exception)
{
 if(php_sapi_name()!=='cli')
 {  
  if(!headers_sent())
  {
   header('Content-Type: text/plain; charset=utf-8');
  }
 }

 $lines=array();
 
 $lines[]=null;
 $lines[]=$exception->getMessage();
 $lines[]=null;
 $lines[]=$exception->getFile().':'.$exception->getLine();
 $lines[]=null;
 $lines[]=$exception->getTraceAsString();
 $lines[]=null;
 
 if($exception instanceof LibraryException)
 {
  $lines[]=$exception->name;
  $lines[]=var_export($exception->arguments,true);
 }
 
 $lines=implode(crlf,$lines);
  
 echo $lines;
 
 die;
}

function on_error($number,$message,$file,$line,$context)
{
 $exception=new ErrorException($message,$number,0,$file,$line);
 
 $exception->context=$context;

 throw $exception;
}

?>
<?php

function initialize()
{
 set_exception_handler('on_exception');

 error_reporting(-1);
 set_error_handler('on_error');

 date_default_timezone_set('Europe/Paris');
}

?>
<?php

function println()
{
 $arguments=func_get_args();
 
 foreach($arguments as $argument)
 {
  echo $argument.' ';
 }
 
 echo crlf;
}

?>
<?php

function contain($string,$search,$sensitive=true)
{
 check(is_s($string));
 check(is_s($search));
 
 $result=false;
 $index=null;
 
 if($sensitive) 
  $index=strpos($string,$search);
 else
  $index=stripos($string,$search);
  
 if($index===false)
 {
 }
 else
 {
  check($index>=0);
  
  $result=true;
 }
 
 return $result;
}

function start($string,$search,$sensitive=true)
{
 check(is_s($string),$string);
 check(is_s($search),$search);
 
 $result=false;
 $index=null;
 
 if($sensitive) 
  $index=strpos($string,$search);
 else
  $index=stripos($string,$search);
  
 if($index===false)
 {
 }
 else
 {
  check($index>=0);
  
  if($index===0)
   $result=true;
 }
 
 return $result;
}

function end_($string,$search,$sensitive=true)
{
 check(is_s($string));
 check(is_s($search));
 
 $result=false;
 $index=null;
 
 if($sensitive) 
  $index=strrpos($string,$search);
 else
  $index=strripos($string,$search);
  
 if($index===false)
 {
 }
 else
 {
  check($index>=0);
  
  $length=strlen($string);
  $length_search=strlen($search);
  $offset=$length-$length_search;  
  
  if($index===$offset)
   $result=true;
 }
 
 return $result;
}

?>
<?php

function s()
{
 $arguments=func_get_args();
 
 return implode(' ',$arguments);
}

function quote()
{
 $arguments=func_get_args();
 
 $result=implode(' ',$arguments);
 $result='"'.$result.'"';
 
 return $result;
}

function brace()
{
 $arguments=func_get_args();
 
 $result=implode(' ',$arguments);
 $result='['.$result.']';
 
 return $result;
}

function inline()
{
 $arguments=func_get_args();
 
 $result=implode(' ',$arguments); 
 $result=str_replace("\n",' ',$result);
 $result=str_replace("\r",' ',$result);
 $result=str_replace("\t",' ',$result);
 $result=str_replace('  ',' ',$result);
 $result=trim($result);
 
 return $result;
}

?>
<?php

function strip($string,$search,$sensitive=true)
{
 check(is_s($string));
 check(is_s($search));
 
 $result=null;
 $index=null;
 
 if($sensitive) 
  $index=strpos($string,$search);
 else
  $index=stripos($string,$search);
  
 if($index===false)
 {
  $result=$string;
 }
 else
 {
  assert($index>=0);
  
  $length=strlen($string);
  $length_search=strlen($search);
  $offset=$length-$length_search;  
  
  if($index===0)
   $result=right($string,$offset);
  else
   $result=$string;
 }
 
 return $result;
}

function strip_end($string,$search,$sensitive=true)
{
 check(is_s($string));
 check(is_s($search));
 
 $result=null;
 $index=null;
 
 if($sensitive) 
  $index=strrpos($string,$search);
 else
  $index=strripos($string,$search);
  
 if($index===false)
 {
  $result=$string;
 }
 else
 {
  check($index>=0);
  
  $length=strlen($string);
  $length_search=strlen($search);
  $offset=$length-$length_search;  
  
  if($index===$offset)
   $result=left($string,$offset);
  else
   $result=$string;
 }
 
 return $result;
}

?>
<?php

function get($array,$key)
{
 if(array_key_exists($key,$array))
  return $array[$key];
 
 return null;
}

function shift(&$array)
{
 return array_shift($array);
}

function unshift(&$array,$value)
{
 array_unshift($array,$value);
}

function push_array(&$array,$item)
{
 foreach($item as $key=>$value)
 {
  if(is_int($key))
   $array[]=$value;
  else
   $array[$key]=$value;
 }
}

?>
<?php

function compress()
{
 $arguments=func_get_args();
 $result=null;

 if(count($arguments)===0)
  return $result;

 if(count($arguments)===1)
  $arguments=$arguments[0];

 $result=serialize($arguments);
 $result=gzcompress($result,9);
 $result=base64_encode($result);
 $result=rawurlencode($result);

 return $result;
}

function uncompress($compressed)
{
 if(!is_s($compressed))
  return false;

 $result=$compressed;
 $result=rawurldecode($result);
 $result=base64_decode($result);

 try
 {
  $result=@gzuncompress($result);
 }
 catch(Exception $exception)
 {
  $result=false;
 }

 if($result===false)
  return $result;

 $result=unserialize($result);

 return $result;
}

?>
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

function real_path()
{
 $arguments=func_get_args();
 
 $path=call('path',$arguments);
 
 $result=realpath($path);
 
 check(is_s($result));
 
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
<?php

function call()
{
 $arguments=func_get_args();
 
 $object=shift($arguments);
 $function=null;
 
 if(is_string($object))
 {
  $function=$object;
  $object=null;
 }
 else 
  $function=shift($arguments);
 
 if(count($arguments)===1)
 {
  if(is_array($arguments[0]))
  {
   $arguments=$arguments[0];
  }
 }
 
 if($object===null)
  return call_user_func_array($function,$arguments);
  
 return call_user_func_array(array($object,$function),$arguments);
}

?>
<?php

function h()
{
 $arguments=func_get_args();
 
 $result=implode(' ',$arguments);
 $result=htmlspecialchars($result);
 
 return $result;
}

?>
<?php

function is_s($mixed)
{
 if($mixed===null)
  return true;
 
 return is_string($mixed);  
}

function scalar($mixed)
{
 if(is_scalar($mixed))
  return true;

 if($mixed===null)
  return true;
  
 return false;
}

function is_word($mixed)
{
 $result=false;
 
 if(is_s($mixed))
 {
  $word=$mixed;
  $word=inline($word);
  $word=str_replace(' ',null,$word);
  
  if($mixed===$word)
   $result=true;
 }
 
 return $result;
}

?>
<?php

function left($string,$count)
{
 check(is_s($string)); 
 check($count>=0);
 
 $result=substr($string,0,$count);
 
 check(is_s($result));
 
 return $result;
}

function right($string,$count)
{
 check(is_s($string)); 
 check($count>=0);
 
 $result=null;
 
 if($count>0)
 {
  $count=$count*-1;
 
  $result=substr($string,$count);
 }
 
 check(is_s($result));
 
 return $result;
}

?>
<?php

function nil($mixed)
{
 if($mixed===null)
  return true;
  
 if($mixed==='')
  return true;
  
 return false;
}

?>
<?php

class Tag
{
 public $name;
 public $text;
 public $option;
 
 public $attributes=array();
 public $styles=array();
 public $children=array(); 
 
 function initialize()
 {
 }
 
 function add($name)
 {
  $class=$name.'Tag';
  
  if(!class_exists($class))
   $class='Tag';
   
  $result=new $class;
    
  $result->name=$name;
  $result->initialize();
  
  $this->children[]=$result;
  
  return $result;
 }
 
 function text()
 {
  $arguments=func_get_args();
  
  if(count($arguments)===0)
   return $this->text;
   
  $this->text=implode(' ',$arguments);
  
  return $this;
 }
 
 function attr()
 {
  $arguments=func_get_args();
  
  if(count($arguments)===0)
   return $this->attributes;
  elseif(count($arguments)===1)
   return get($this->attributes,$arguments[0]);
  elseif(count($arguments)===2)
  {
   $this->attributes[$arguments[0]]=$arguments[1];
   
   return $this;
  }
  else
   stop();
 }

 function width()
 {
  $arguments=func_get_args();
  
  unshift($arguments,'width');
  
  return call($this,'attr',$arguments);
 }
 
 function height()
 {
  $arguments=func_get_args();
  
  unshift($arguments,'height');
  
  return call($this,'attr',$arguments);
 }
 
 function align()
 {
  $arguments=func_get_args();
  
  unshift($arguments,'align');
  
  return call($this,'attr',$arguments);
 }

 function valign()
 {
  $arguments=func_get_args();
  
  unshift($arguments,'valign');
  
  return call($this,'attr',$arguments);
 }
 
 function export($depth=0)
 {
  $indent=str_repeat(' ',$depth);
  $attributes=$this->export_attributes();
  $text=$this->export_text();
    
  $open='<'.$this->name.$attributes.'>';
  $close='</'.$this->name.'>';
  
  $inner=null;
  
  foreach($this->children as $child)
  {
   $inner.=$child->export($depth+1);   
  }
  
  $result=null;
  
  if($this->option===null)
  {
   $result=$indent.$open.crlf;
  
   if(!nil($text))
    $result.=' '.$indent.$text.crlf;
  
   $result.=$inner;
   $result.=$indent.$close.crlf;
  }
  elseif($this->option==='inline')
  {
   $result=$indent.$open.inline($text.$inner).$close.crlf;
  }
  elseif($this->option==='pre')
  {
   $result=$indent.$open.h($this->text).$inner.$close.crlf;
  }
  else
   stop();
   
  return $result;
 }

 function export_attributes()
 {
  $result=null;
  
  foreach($this->attributes as $name=>$value)
  {
   $attribute=quote(h($value));
      
   $result.=$name.'='.quote($value).' ';
  }
  
  $result=trim($result);
  
  if(!nil($result))
   $result=' '.$result;
  
  return $result;
 } 

 function export_text()
 {
  $result=$this->text;
  $result=inline($result);
  $result=h($result);
  
  return $result;
 }
}

?>
<?php

class BlockTag extends Tag
{
}

class PreTag extends BlockTag
{
 function initialize()
 {
  parent::initialize();
  
  $this->option='pre';
 }
 
 function import()
 {
  $arguments=func_get_args();
  
  if(count($arguments)===1)
   $arguments=$arguments[0];
   
  $this->text(var_export($arguments,true));
  
  return $this;  
 }
}

?>
<?php

class TitleTag extends Tag
{
 function initialize()
 {
  parent::initialize();
  
  $this->option='inline';
 }
}

?>
<?php

class InlineTag extends Tag
{
 function initialize()
 {
  parent::initialize();
  
  $this->option='inline';
 } 
}

class BTag extends InlineTag
{
}

class ITag extends InlineTag
{
}

class StrongTag extends InlineTag
{
}

class EMTag extends InlineTag
{
}

?>
<?php

class ATag extends InlineTag
{
 function href()
 {
  $arguments=func_get_args();
  
  unshift($arguments,'href');
  
  return call($this,'attr',$arguments);
 }
}

?>
<?php

class SpanTag extends InlineTag
{
}

class SeparatorTag extends SpanTag
{
 function initialize()
 {
  parent::initialize();
  
  $this->name='span';
 }
}

class PipeTag extends SeparatorTag
{
 function initialize()
 {
  parent::initialize();
  
  $this->text('|');
 }
}

?>
<?php
$_build_number=6;
?><?php

class Page
{
 public $html;
 public $layout;
 public $head_title;
 public $logo;
 public $title;
 public $slogan;
 public $profile;
 public $menu_main;
 public $menu_quick;
 public $menu_up;
 public $menu_left;
 public $menu_right; 
 public $crumb;
 public $crumb_pager;
 public $content;
 
 public $column_width='140px';
 
 function initialize()
 {
  $this->html=new Tag;

  $this->html->name='html';
  
  $this->head_title=$this->html->add('head')->add('title');
  
  $body=$this->html->add('body');

  $this->layout=$body->add('table');
  
  $this->layout->width('100%');
  
  $this->header();
  $this->main_menu();
  $this->crumb();
  $this->content();
  $this->footer();  
  
  $this->head_title->text('head_title');  
  $this->logo->text('logo');  
  $this->title->text('title');
  $this->slogan->text('slogan');  
  
  $this->menu_main->text('main');
  $this->menu_quick->text('quick');
  $this->menu_up->text('up');
  $this->menu_left->text('left');
  $this->menu_right->text('right');
  
  $this->crumb->text('crumb');
  $this->crumb_pager->text('pager');
  
  $this->content->text('content');
 }
 
 function header()
 {
  $tr=$this->layout->add('tr');
  
  $this->logo=$tr->add('td');
  
  $this->logo->width($this->column_width);
  $this->logo->align('right');
  
  $td=$tr->add('td');
  
  $table=$td->add('table')->width('100%');  
  $tr=$table->add('tr');
  $td=$tr->add('td');  
  
  $this->title=$td->add('div');
  $this->slogan=$td->add('div');
    
  $this->menu_quick=$tr->add('td');
  
  $this->menu_quick->align('right');
 }

 function main_menu()
 {
  $tr=$this->layout->add('tr');

  $td=$tr->add('td');  
  
  $td->width($this->column_width);
  
  $td=$tr->add('td');  

  $table=$td->add('table')->width('100%');  
  $tr=$table->add('tr');
  
  $this->menu_main=$tr->add('td');  
  $this->profile=$tr->add('td');
  
  $this->profile->align('right')->text('__profile__s');
 }
 
 function crumb()
 {
  $tr=$this->layout->add('tr');
  
  $this->menu_up=$tr->add('td');
  $this->menu_up->width($this->column_width);
  $this->menu_up->align('center');
  
  $td=$tr->add('td');  
  
  $table=$td->add('table')->width('100%');  
  $tr=$table->add('tr');
  
  $this->crumb=$tr->add('td');  
  $this->crumb_pager=$tr->add('td');
  
  $this->crumb_pager->align('right');
 }
 
 function content()
 {
  $tr=$this->layout->add('tr');
  
  $this->menu_left=$tr->add('td');  
  $this->menu_left->width($this->column_width);
    
  $td=$tr->add('td');
  $table=$td->add('table')->width('100%');  
  $tr=$table->add('tr');
  
  $this->content=$tr->add('td');
  $this->menu_right=$tr->add('td');  
  
  $this->menu_right->width($this->column_width);  
 }
 
 function footer()
 {
 }
 
 function export()
 {
  $html=$this->html->export();
  
  $profile=microtime(true)-$GLOBALS['_start'];
  $profile=sprintf('%.3f',$profile);
  
  $html=str_replace('__profile__',$profile,$html);
  
  return $html;
 } 
}

?>
<?php

function main()
{
 $path=get($_GET,'pp');
 
 if($path=='info')
 {
  phpinfo();
 }
 else
 {
  $page=new Page;
  
  $page->initialize();

  $page->menu_quick->add('a')->href('http://11.traviole.fr/')->text('11');
  $page->menu_quick->add('pipe');
  $page->menu_quick->add('a')->href('http://datz.free.fr/')->text('datz');
  $page->menu_quick->add('pipe');
  $page->menu_quick->add('a')->href('http://abiven.marc.free.fr/')->text('abiven');

  $page->content->add('h1')->text('coucou');
  $page->content->add('div')->text('build',$GLOBALS['_build_number']);
  
  echo $page->export();
/*  
  $td->add('a')->href('http://11.traviole.fr/')->text('11');
  $td->add('pipe');
  $td->add('a')->href('http://datz.free.fr/')->text('datz');
  $td->add('pipe');
  $td->add('a')->href('http://abiven.marc.free.fr/')->text('abiven');
  $td->add('pipe');
  $td->add('b')->text('__profile__');
  
  $tr=$table->add('tr');
  
  $td=$tr->add('td');
  
  $td->add('h1')->text('coucou');
  $td->add('a')->href('/?pp=info')->text('info');
  $td->add('a')->href('/?pp=db')->text('db');
  
  if($path==='db')
  {
   $form=$td->add('form');
   
   $td->add('pre')->import(pdo_drivers());
   //$form->add('t
  }
  else
  {
   //$td->add('pre')->import($_SERVER);
   $td->add('pre')->import($_GET);
  }
  
  $td=$tr->add('td');
   
  $html=$html->export();
  
  $profile=microtime(true)-$GLOBALS['_start'];
  $profile=sprintf('%.3f',$profile);
  
  $html=str_replace('__profile__',$profile,$html);
  
  echo $html;*/
 }
}

initialize(); 
main();

?>
