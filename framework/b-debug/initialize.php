<?php

function initialize()
{
 set_exception_handler('on_exception');

 error_reporting(-1);
 set_error_handler('on_error');

 date_default_timezone_set('Europe/Paris');
}

?>
