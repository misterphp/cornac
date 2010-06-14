<?php

function h()
{
 $arguments=func_get_args();
 
 $result=implode(' ',$arguments);
 $result=htmlspecialchars($result);
 
 return $result;
}

?>
