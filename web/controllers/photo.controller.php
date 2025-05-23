<?php
switch (GETPOST('action2')) {
  case null:
    $pageTitle = 'Photos de la fête des lumières';
    include "$root/views/photo.view.php";
    break;

  default:
    $pageTitle = 'Page not found';
    include "$root/views/404.view.php";
    break;
}