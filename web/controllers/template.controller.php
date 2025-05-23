<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include_once $root . '/vendor/autoload.php';
require_once $root . '/lib/security.lib.php';
require_once $root . '/lib/project.lib.php';


switch (GETPOST('action2')) {
  case 'enseignant':
    include $root . '/controllers/template/template.controller.php';
    include $root . '/views/template/template.view.php';
    break;

  case 'enseignement':
    include $root . '/controllers/template/template.controller.php';
    include $root . '/views/template/template.view.php';
    break;

  default:
    function getServicesByEnseignants() {
      try {
        $db = require $_SERVER['DOCUMENT_ROOT'] . '/lib/pdo.php';
        $fields = array(
          "E.id_ens as id_ens",
          "nom_ens",
          "prenom_ens",
        );
        $sql = "SELECT distinct ".implode(", ", $fields)." ";
        $sql .= "FROM enseignants E ";
        $sql .= "INNER JOIN seances A on E.id_ens=A.id_ens ";
        $sql .= "order by nom_ens ";
        $statement = $db->query($sql);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $list = array();
        foreach ($result as $row) {
          $list[] = [sanitize($row['id_ens']), sanitize($row['prenom_ens'] . ' ' . $row['nom_ens'])];
        }
        $list = json_encode($list);
        echo $list;

        $statement->closeCursor();
      } catch (Error|Exception $e) {
        echo 'Erreur' . $e->getMessage();
      }
    }
    
    $pageTitle = 'template';
    include $root . '/views/template/template.view.php';
    break;
}