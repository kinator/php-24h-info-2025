<?php
include "$root/inc/head.php";
?>

<!-- Conteneur principal -->
<div class="margin w3-border w3-padding" style="background: white;">
  <h1>INFO</h1>

  <!-- Conteneur pour la carte -->
  <div id="map" style="height: 500px; width: 100%;"></div>
</div>

<!-- Ajout des fichiers Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
  // Initialisation de la carte
  var map = L.map('map').setView([45.764043, 4.835659], 13); // Coordonnées de Lyon

  // Ajout des tuiles OpenStreetMap
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
  }).addTo(map);

  // Données des installations lumineuses avec images
  var installations = [
    {
      name: "Cathédrale Saint-Jean",
      description: "Un magnifique spectacle de lumières projeté sur la façade de la cathédrale.",
      latitude: 45.761111,
      longitude: 4.827778,
      image: "/img/cathe.jpg"
    },
    {
      name: "Place des Terreaux",
      description: "Une installation lumineuse spectaculaire sur la fontaine Bartholdi.",
      latitude: 45.767299,
      longitude: 4.834329,
      image: "/img/terreaux.jpg"
    },
    {
      name: "Parc de la Tête d'Or",
      description: "Un parcours lumineux féérique dans le parc.",
      latitude: 45.779722,
      longitude: 4.852222,
      image: "/img/parc.jpg"
    },
    {
      name: "Basilique de Fourvière",
      description: "Un éclairage majestueux de la basilique visible depuis toute la ville.",
      latitude: 45.762222,
      longitude: 4.822222,
      image: "/img/basilique.jpeg"
    }
  ];

  // Ajout des marqueurs sur la carte avec des images redimensionnées
  installations.forEach(function(installation) {
    var marker = L.marker([installation.latitude, installation.longitude]).addTo(map);
    marker.bindPopup(
      `<b>${installation.name}</b><br>${installation.description}<br>
      <img src="${installation.image}" alt="${installation.name}" style="max-width:300px; height:auto; border-radius:5px;">`
    );
  });
</script>

<?php
include "$root/inc/footer.php";
?>