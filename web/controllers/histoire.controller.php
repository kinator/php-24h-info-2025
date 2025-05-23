<?php
switch (GETPOST('action2')) {
  case null:
    $pageTitle = 'Histoire de la fête des lumières';
    include "$root/views/histoire.view.php";
    break;

  default:
    $pageTitle = 'Page not found';
    include "$root/views/404.view.php";
    break;
}