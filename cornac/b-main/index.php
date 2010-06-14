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
  
  echo $page->export();
/*  $html=new Tag;

  $html->name='html';
  
  $html->add('head')->add('title');
  $body=$html->add('body');

  $table=$body->add('table');
  
  $table->width('100%');
  
  $tr=$table->add('tr');
  
  $td=$tr->add('td');
  
  $td=$tr->add('td');
  
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
