<?php
include "$root/inc/head.php";
?>

<!-- Conteneur principal -->
<div class="margin w3-border w3-padding" style="background: white;">
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

<!-- Ajout des fichiers Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

<script>
  // Initialisation de la carte
  var map = L.map('map').setView([45.764043, 4.835659], 13); // Coordonnées de Lyon

  // Ajout des tuiles OpenStreetMap
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
  }).addTo(map);

  // Données des installations lumineuses avec images et types
  var installations = [
    {
      name: "Cathédrale Saint-Jean",
      description: "Un magnifique spectacle de lumières projeté sur la façade de la cathédrale.",
      latitude: 45.761111,
      longitude: 4.827778,
      image: "/img/cathe.jpg",
      type: "historique"
    },
    {
      name: "Place des Terreaux",
      description: "Une installation lumineuse spectaculaire sur la fontaine Bartholdi.",
      latitude: 45.767299,
      longitude: 4.834329,
      image: "/img/terreaux.jpg",
      type: "spectacle"
    },
    {
      name: "Parc de la Tête d'Or",
      description: "Un parcours lumineux féérique dans le parc.",
      latitude: 45.779722,
      longitude: 4.852222,
      image: "/img/parc.jpg",
      type: "parc"
    },
    {
      name: "Basilique de Fourvière",
      description: "Un éclairage majestueux de la basilique visible depuis toute la ville.",
      latitude: 45.762222,
      longitude: 4.822222,
      image: "/img/basilique.jpeg",
      type: "historique"
    },
    {
      name: "Place Bellecour",
      description : "Le Roi-Soleil, dont la statue a été restaurée, est sous son dôme de neige directement connecté à notre époque.",
      latitude: 45.75788063428689, 
      longitude: 4.832405876882979,
      image: "/img/place_bellecour.jpg",
      type: "historique"
    },
    {
      name: "Hôtel-Dieu",
      description: "L'Hôtel-Dieu est un ancien hôpital, aujourd'hui un centre commercial et culturel, qui a été construit au XVIIe siècle.",
      latitude: 45.759205280707526, 
      longitude: 4.8361549627863845,
      image: "/img/hotel_dieu.jpeg",
      type: "historique"
    },
    {
      name: "la Guillotière",
      description: "Un quartier animé de Lyon, connu pour sa diversité culturelle et ses restaurants.",
      latitude: 45.75497713954937,
      longitude: 4.839286070873936,
      image: "/img/guillotiere.jpg",
      type: "spectacle"
    },
    {
      name: "Musée des Confluences",
      description: "Un musée d'histoire naturelle et d'anthropologie, avec une architecture moderne.",
      latitude: 45.4333,
      longitude: 4.8333,
      image: "/img/confluences.jpg"
      type: "historique"
    }
     

  ];

  // Fonction pour afficher les marqueurs
  function displayMarkers(filteredInstallations) {
    map.eachLayer(function (layer) {
      if (layer instanceof L.Marker) {
        map.removeLayer(layer);
      }
    });

    filteredInstallations.forEach(function(installation) {
      var marker = L.marker([installation.latitude, installation.longitude]).addTo(map);
      marker.bindPopup(
        `<b>${installation.name}</b><br>${installation.description}<br>
        <img src="${installation.image}" alt="${installation.name}" style="max-width:300px; height:auto; border-radius:5px;">`
      );
    });
  }

  // Affiche tous les marqueurs au chargement initial
  displayMarkers(installations);

  // Initialisation des menus déroulants
  function initializePoints() {
    var startSelect = document.getElementById('start-point');
    var endSelect = document.getElementById('end-point');

    installations.forEach(function(installation) {
      var option = document.createElement('option');
      option.value = `${installation.latitude},${installation.longitude}`;
      option.textContent = installation.name;
      startSelect.appendChild(option);

      var endOption = option.cloneNode(true); // Clone l'option pour le menu d'arrivée
      endSelect.appendChild(endOption);
    });
  }

  // Met à jour les points d'arrivée en excluant le point de départ sélectionné
  function updateEndPoints() {
    var startSelect = document.getElementById('start-point');
    var endSelect = document.getElementById('end-point');
    var selectedStart = startSelect.value;

    // Réinitialise les options du point d'arrivée
    endSelect.innerHTML = '';
    installations.forEach(function(installation) {
      var option = document.createElement('option');
      option.value = `${installation.latitude},${installation.longitude}`;
      option.textContent = installation.name;

      // Exclut le point de départ sélectionné
      if (option.value !== selectedStart) {
        endSelect.appendChild(option);
      }
    });
  }

  // Fonction pour calculer un itinéraire dynamique
  function calculateDynamicRoute() {
    var startCoords = document.getElementById('start-point').value;
    var endCoords = document.getElementById('end-point').value;

    // Si aucun point de départ n'est sélectionné, utiliser la géolocalisation
    if (!startCoords) {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          startCoords = `${position.coords.latitude},${position.coords.longitude}`;
          calculateRoute(startCoords, endCoords);
        }, function() {
          alert("La géolocalisation a été refusée ou n'est pas disponible.");
        });
      } else {
        alert("La géolocalisation n'est pas prise en charge par votre navigateur.");
      }
    } else {
      calculateRoute(startCoords, endCoords);
    }
  }

  // Fonction pour calculer un itinéraire
  function calculateRoute(startCoords, endCoords) {
    var startPoint = L.latLng(...startCoords.split(',').map(parseFloat));
    var endPoint = L.latLng(...endCoords.split(',').map(parseFloat));

    L.Routing.control({
      waypoints: [startPoint, endPoint],
      routeWhileDragging: true
    }).addTo(map);
  }

  // Initialisation des points au chargement
  initializePoints();
</script>

<?php
include "$root/inc/footer.php";
?>