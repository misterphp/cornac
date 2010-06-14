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
