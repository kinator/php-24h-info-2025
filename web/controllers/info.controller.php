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
?>

<!-- Ajout des fichiers Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

<script>
  // Initialisation de la carte
  var map = L.map('map').setView([45.764043, 4.835659], 13); // Coordonnées de Lyon
  var routingControl;


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
      image: "/img/confluences.jpg",
      type: "historique"
    },
    {
      name: "Parc de Gerland",
      description: "Un parc urbain avec des installations artistiques et des espaces verts.",
      latitude: 45.724333662329336,
      longitude: 4.827056443693007,
      image: "/img/gerland.jpg",
      type: "parc"
    },
    {
      name: "Place des Jacobins",
      description: "Une place emblématique de Lyon, connue pour sa fontaine et son ambiance animée.",
      latitude: 45.76050869736537,
      longitude: 4.833472271635074,
      image: "/img/jacobins.jpg",
      type: "historique"
    },
    {
      name: "Place des Célestins",
      description: "Une place animée avec des cafés et des restaurants.",
      latitude: 45.7651,
      longitude: 4.8343,
      image: "/img/place_celestins.jpeg",
      type: "historique"
    },
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

    routingControl = L.Routing.control({
      waypoints: [startPoint, endPoint],
      routeWhileDragging: true,
      lineOptions: {
        styles: [
          { color: 'white', opacity: 1, weight: 12 },
          { color: 'blue', opacity: 0.8, weight: 6 } // Ligne bleue, légèrement transparente, épaisseur 6
        ]
      }
    }).addTo(map);

    routingControl.on('routesfound', function() {
      var container = document.querySelector('.leaflet-routing-container');
      container.style.maxHeight = '480px';
      container.style.maxWidth = '480px';
      container.style['overflow-y'] = 'scroll';
      container.style.color = 'black';
      if (container) {
          // Ajout du bouton de fermeture
          var closeButton = document.createElement('button');
          closeButton.textContent = '×'; // Utilisation de textContent pour éviter les problèmes avec &times;
          closeButton.style.position = 'absolute';
          closeButton.style.top = '5px';
          closeButton.style.right = '10px';
          closeButton.style.background = 'transparent';
          closeButton.style.border = 'none';
          closeButton.style.fontSize = '20px';
          closeButton.style.cursor = 'pointer';

          // Ajout de l'événement pour fermer le conteneur
          closeButton.onclick = function() {
              map.removeControl(routingControl);
          };

          // Ajout du bouton au conteneur
          container.style.position = 'relative';
          container.appendChild(closeButton);
      }
    });
  }

  function applyFilters() {
    var filterType = document.getElementById('filter-type').value;

    // Filtrer les installations en fonction du type sélectionné
    var filteredInstallations = installations.filter(function(installation) {
      return filterType === 'all' || installation.type === filterType;
    });

    // Afficher les marqueurs filtrés
    displayMarkers(filteredInstallations);
  }

  // Fonction pour rechercher une installation par nom
  function searchInstallation() {
    var searchQuery = document.getElementById('search-installation').value.toLowerCase();

    // Filtrer les installations en fonction du nom recherché
    var filteredInstallations = installations.filter(function(installation) {
      return installation.name.toLowerCase().includes(searchQuery);
    });

    // Afficher les marqueurs filtrés
    displayMarkers(filteredInstallations);
  }

  // Initialisation des points au chargement
  initializePoints();
</script>