<!-- Navbar -->
<div class="w3-display-container top_header" style="min-height: 140px; max-height: 200px;">
  <div class="w3-padding w3-display-left logo-container">
    <img src="/img/logo.png" alt="Logo" class="logo" style="height: 130px">
  </div>
  <div class="w3-padding w3-display-middle w3-center">
    <p class="title"><b><?= isset($pageTitle) ? sanitize($pageTitle) : 'Les lumières de Lyon' ?></b></p>
  </div>
  <audio id="bg-music" src="/audio/755983__marvin_chiriguaya__autumn.mp3" autoplay loop></audio>
  <button id="toggle-music" class="w3-button w3-larger w3-round-large" style="position:fixed;top:10px;right:10px;z-index:1000;">
    <i id="music-icon" class="fa fa-volume-up" style="color: white;"></i>
  </button>
</div>

<div class="navig-bar">
  <nav class="w3-bar w3-card w3-large" style="display: flex; justify-content: space-between;">
    <form method='GET'>
      <button type='submit' class='w3-bar-item w3-button headButton'>Accueil</button>
    </form>
    <form method='GET'>
      <input type='hidden' name='action' value='histoire'>
      <button type='submit' class='w3-bar-item w3-button headButton'>Histoire</button>
    </form>
    <form method='GET'>
      <input type='hidden' name='action' value='photo'>
      <button type='submit' class='w3-bar-item w3-button headButton'>Aperçus</button>
    </form>
    <form method='GET'>
      <input type='hidden' name='action' value='infos'>
      <button type='submit' class='w3-bar-item w3-button headButton'>Infos</button>
    </form>
  </nav>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const audio = document.getElementById('bg-music');
    const btn = document.getElementById('toggle-music');
    const icon = document.getElementById('music-icon');
    btn.addEventListener('click', function() {
      if (audio.paused) {
        audio.play();
        icon.className = 'fa fa-volume-up';
      } else {
        audio.pause();
        icon.className = 'fa fa-volume-mute';
      }
    });
  });

  function adjustTextSize() {
    const textElements = document.querySelectorAll('.title');
    const screenWidth = window.innerWidth;

    let fontSize;
    if (screenWidth < 700) {
      fontSize = '0px';
    } else if (screenWidth < 800) {
      fontSize = '20px';
    } else if (screenWidth < 1100) {
      fontSize = '24px';
    } else {
      fontSize = '30px';
    }

    textElements.forEach(element => {
      element.style.fontSize = fontSize;
    });
  }

  window.addEventListener('load', adjustTextSize);
  window.addEventListener('resize', adjustTextSize);
</script>