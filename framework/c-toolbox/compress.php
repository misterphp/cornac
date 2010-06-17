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
