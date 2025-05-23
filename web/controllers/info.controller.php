<?php
switch (GETPOST('action2')) {
  case null:
    $pageTitle = 'Informations sur la fête des lumières';
    include "$root/views/info.view.php";
    break;

  default:
    $pageTitle = 'Page not found';
    include "$root/views/404.view.php";
    break;
}
