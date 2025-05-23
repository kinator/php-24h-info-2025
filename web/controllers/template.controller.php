<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include_once $root . '/vendor/autoload.php';
require_once $root . '/lib/project.lib.php';


switch (GETPOST('action2')) {
  case 'enseignant':
    include $root . '/controllers/template.controller.php';
    include $root . '/views/template.view.php';
    break;

  case 'enseignement':
    include $root . '/controllers/template.controller.php';
    include $root . '/views/template.view.php';
    break;

  default:
    $pageTitle = 'template';
    include $root . '/views/template.view.php';
    break;
}