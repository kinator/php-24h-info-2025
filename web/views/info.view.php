<?php
    $changeBackground = "#517cf3";
include "$root/inc/head.php";
?>

<!-- Conteneur principal -->
<div class="w3-content margin w3-border w3-padding" style="background: lightgrey;">
  <h1>INFO</h1>

  <!-- Formulaire pour les filtres, la recherche et l'itinéraire -->
  <div class="filter-container" style="margin-bottom: 20px; display: flex; flex-wrap: wrap; gap: 15px; align-items: center;">
    <div class="filter-item">
      <label for="filter-type" style="font-weight: bold; margin-right: 10px;">Type d'installation :</label>
      <select id="filter-type" onchange="applyFilters()" style="padding: 8px 12px; border: 1px solid #ccc; border-radius: 5px; font-size: 1em;">
        <option value="all">Toutes</option>
        <option value="historique">Historique</option>
        <option value="spectacle">Spectacle</option>
        <option value="parc">Parc</option>
      </select>
    </div>

    <div class="filter-item">
      <label for="search-installation" style="font-weight: bold; margin-right: 10px;">Rechercher :</label>
      <input type="text" id="search-installation" onkeyup="searchInstallation()" placeholder="Nom de l'installation..." 
        style="padding: 8px 12px; border: 1px solid #ccc; border-radius: 5px; font-size: 1em; width: 250px;">
    </div>
  </div>

  <!-- Formulaire pour choisir les points de départ et d'arrivée -->
  <div class="route-container" style="margin-bottom: 20px; display: flex; flex-wrap: wrap; gap: 15px; align-items: center;">
    <div class="route-item">
      <label for="start-point" style="font-weight: bold; margin-right: 10px;">Point de départ :</label>
      <select id="start-point" onchange="updateEndPoints()" style="padding: 8px 12px; border: 1px solid #ccc; border-radius: 5px; font-size: 1em;">
        <option value="">Utiliser ma position actuelle</option>
      </select>
    </div>

    <div class="route-item">
      <label for="end-point" style="font-weight: bold; margin-right: 10px;">Point d'arrivée :</label>
      <select id="end-point" style="padding: 8px 12px; border: 1px solid #ccc; border-radius: 5px; font-size: 1em;">
      </select>
    </div>

    <div class="route-item">
      <button onclick="calculateDynamicRoute()" style="padding: 10px 20px; background-color: #007BFF; color: white; border: none; border-radius: 5px; font-size: 1em; cursor: pointer;">
        Calculer un itinéraire
      </button>
    </div>
  </div>

  <!-- Conteneur pour la carte -->
  <div id="map" style="height: 500px; width: 100%; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);"></div>
</div>

<?php
include "$root/inc/footer.php";
?>