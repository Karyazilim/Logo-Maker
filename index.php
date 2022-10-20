<?php 
$f3 = require('lib/base.php');
$f3->set('UI','ui/');
$f3->set('AUTOLOAD', 'class/');
$f3->set("IMAGES", "images/");
$f3->set("UPLOADS", "uploads/");

$f3->set("SERVER_WINDOWS", true);
$f3->set("FOLDER_WINDOWS", __DIR__."\\font");

$f3->route('GET /', 'Home->show'); 
$f3->route('POST /logo/preview [ajax]', 'LogoAjax->preview'); 

$f3->run();
?>