<?php
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
    $pageTitle = 'Page not found';
    include $root . '/views/404.view.php';
    break;
}