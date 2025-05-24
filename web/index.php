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

    <div>
      <img src="/img/wtf_city.png" style="width: 100%"/>
    </div>

    <div class="w3-content margin w3-border w3-padding" style="background: lightgrey;">
      <h1>La fête des lumières de Lyon</h1>
      <p class="w3-large">La Fête des Lumières de Lyon est un événement emblématique de Lyon, célébré chaque année autour du 8 décembre</p>
      <p class="w3-large">Elle est à la fois culturel et artistique, et consiste à illuminer la ville avec des créations lumineuses, tout en perpétuant une tradition religieuse et populaire</p>
    </div>

    <?php
    include dirname(__FILE__) . "/inc/footer.php";
    break;

  default:
    $pageTitle = 'Page not found';
    include dirname(__FILE__) . '/views/404.view.php';
    break;
}
