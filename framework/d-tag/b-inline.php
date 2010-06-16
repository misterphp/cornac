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
