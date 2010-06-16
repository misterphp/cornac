<?php

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
