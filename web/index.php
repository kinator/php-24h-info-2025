<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include_once "$root/vendor/autoload.php";
require_once "$root/lib/project.lib.php";

switch (GETPOST('action')) {
  case 'histoire':
    include dirname(__FILE__) . '/controllers/histoire.controller.php';
    break;

  case 'infos':
    include dirname(__FILE__) . '/controllers/info.controller.php';
    break;

  case 'photo':
    include dirname(__FILE__) . '/controllers/photo.controller.php';
    break;

  case null:
    include dirname(__FILE__) . "/inc/head.php";
    ?>

    <div class="w3-content margin w3-border w3-padding" style="background: lightgrey;">
      <h1>La fête des lumières de Lyon</h1>
    </div>

    <?php
    include dirname(__FILE__) . "/inc/footer.php";
    break;

  default:
    $pageTitle = 'Page not found';
    include dirname(__FILE__) . '/views/404.view.php';
    break;
}
