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
