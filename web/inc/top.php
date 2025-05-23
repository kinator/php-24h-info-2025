<!-- Navbar -->
<div class="w3-display-container top_header" style="min-height: 150px; max-height: 200px;">
  <div class="w3-padding w3-display-left logo-container">
    <img src="/img/logo.png" alt="Logo" class="logo" style="height: 150px">
  </div>
  <div class="w3-padding w3-display-middle w3-center">
    <p class="title"><b><?= isset($pageTitle) ? sanitize($pageTitle) : 'Les lumières de Lyon' ?></b></p>
  </div>
</div>

<div class="navig-bar">
  <nav class="w3-bar w3-card w3-large">
    <form method='GET'>
      <button type='submit' class='space-nav w3-bar-item w3-button headButton'>Accueil</button>
    </form>
    <form method='GET'>
      <input type='hidden' name='action' value='histoire'>
      <button type='submit' class='space-nav w3-bar-item w3-button headButton'>Histoire</button>
    </form>
    <form method='GET'>
      <input type='hidden' name='action' value='photo'>
      <button type='submit' class='space-nav w3-bar-item w3-button headButton'>Aperçus</button>
    </form>
    <form method='GET'>
      <input type='hidden' name='action' value='infos'>
      <button type='submit' class='space-nav w3-bar-item w3-button headButton'>Infos</button>
    </form>
  </nav>
</div>

<script>
  // document.getElementById('disconnectImg').addEventListener('click', function() {
  //     window.location.href = '/disconnect.php';
  // });

  document.querySelectorAll('.headButton').forEach(button => {
    button.addEventListener('click', function () {
      const pageUrl = this.getAttribute('data-url')
      window.location.href = pageUrl;
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
      fontSize = '28px';
    } else {
      fontSize = '38px';
    }

    textElements.forEach(element => {
      element.style.fontSize = fontSize;
    });
  }

  window.addEventListener('load', adjustTextSize);
  window.addEventListener('resize', adjustTextSize);
</script>