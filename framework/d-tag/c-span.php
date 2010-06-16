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
