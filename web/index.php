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

    
    <div class="w3-content margin w3-padding"">
    <div class="w3-content margin w3-border w3-padding" style="background: lightgrey;">
      <h1>🌟 Fête des Lumières 2025 — Lyon s’illumine du 5 au 8 décembre 🌃</h1>
      <p class="w3-large">Chaque année autour du 8 décembre, Lyon devient la capitale mondiale de la lumière !</p>
      <p class="w3-large">En 2025, retrouve l’événement du vendredi 5 au lundi 8 décembre, dès la tombée de la nuit, dans toute la ville.</p>

      <p>🔍 <strong>1 à 2 millions de visiteurs :</strong> C’est l’un des événements les plus populaires d’Europe.</p>
      <p>🎨 <strong>Des œuvres d’art du monde entier :</strong> Installations immersives, interactives, mapping, poésie visuelle.</p>
      <p>📱 <strong>Une appli mobile</strong> (souvent dispo selon l’édition) te guide en temps réel avec carte interactive et programme : cherche Lyon Lumières sur les stores.</p>

      <h2>📍 Top des lieux à ne pas rater :</h2>
      <ul>
        <li><strong>Place Bellecour :</strong> Grosse œuvre centrale ou installation interactive</li>
        <li><strong>Fourvière :</strong> Superbe vue + projections grandioses</li>
        <li><strong>Parc de la Tête d'Or :</strong> Balade féerique dans la nature</li>
        <li><strong>Cathédrale Saint-Jean :</strong> Mapping vidéo iconique</li>
        <li><strong>Place des Terreaux :</strong> Show lumière sur l’Hôtel de Ville</li>
      </ul>
    </div>
    <div>
      <img src="/img/wtf_city.png" style="width: 100%"/>
    </div>
  </div>


    <?php
      $changeBackground = "#517cf3";
    include dirname(__FILE__) . "/inc/footer.php";
    break;

  default:
    $pageTitle = 'Page not found';
    include dirname(__FILE__) . '/views/404.view.php';
    break;
}
