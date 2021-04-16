<?php

require __DIR__.'/vendor/autoload.php';

new TemplateEngine;

$smarty = TemplateEngine::$smarty; 
$reflector = new Mirror('DataConnection');


$reflector->initialClassIdentification();
$reflector->readComments();
$reflector->passCommentsToParser();
$reflector->passPropertiesToParser();

$smarty->assign('className', $reflector->class->name);
$smarty->assign('classComment', $reflector->classComment);
$smarty->assign('docComments', $reflector->class->parsedComments);
$smarty->assign('properties', $reflector->class->classProperties);
$smarty->assign('parent', $reflector->class->parent);
$smarty->display('header.tpl');
$smarty->display('classpanel.tpl');
$smarty->display('footer.tpl');