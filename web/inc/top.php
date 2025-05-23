<!-- Navbar -->
<div class="w3-display-container top_header" style="min-height: 100px; max-height: 200px;">
  <div class="w3-padding w3-display-left logo-container">
    <img src="/img/exit.png" alt="Logo" class="logo" style="height: 75px">
  </div>
  <div class="w3-padding w3-display-middle w3-center">
    <p class="title"><b><?= isset($pageTitle) ? sanitize($pageTitle) : 'Stack_Underflow BABYYYYYY' ?></b></p>
  </div>
  <!-- <div class="w3-padding w3-display-topright w3-margin" style="display:flex; flex-direction: row; justify-content: center; align-items: center">
    <h4 class="title" style="padding-right: 20px"><?= $_SESSION['user']['nom_ens'] == 'admin_nom' ? 'admin' : sanitize($_SESSION['user']['nom_ens']) . " " . sanitize($_SESSION['user']['prenom_ens'])?></h4>
    <img src="/img/exit.png" alt="exit" id="disconnectImg" style="height: 50px">
  </div> -->
</div>

<div>
  <nav class="w3-bar w3-card">
    <form method='GET'>
      <button type='submit' class='w3-bar-item w3-button headButton'>Accueil</button>
    </form>
    <form method='GET'>
      <input type='hidden' name='action' value='template'>
      <button type='submit' class='w3-bar-item w3-button headButton'>Template</button>
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
      fontSize = '12px';
    } else if (screenWidth < 1100) {
      fontSize = '16px';
    } else {
      fontSize = '24px';
    }

    textElements.forEach(element => {
      element.style.fontSize = fontSize;
    });
  }

  window.addEventListener('load', adjustTextSize);
  window.addEventListener('resize', adjustTextSize);
</script>