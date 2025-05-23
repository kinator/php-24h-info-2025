<?php
// require_once dirname(__FILE__) . '/lib/security.lib.php';
require_once dirname(__FILE__) . '/lib/project.lib.php';

switch (GETPOST('action')) {
  case 'template':
    include dirname(__FILE__) . '/controllers/template.controller.php';
    break;

  default:
    include dirname(__FILE__) . "/inc/head.php";
    ?>

    <div class="w3-content margin w3-border w3-padding" style="background: lightgrey;">
      <h1>Bienvenu sur le GDI du département informatique de Calais</h1>
    </div>

    <?php
    include dirname(__FILE__) . "/inc/footer.php";
    break;
}
