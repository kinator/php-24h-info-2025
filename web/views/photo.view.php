<?php
include "$root/inc/head.php";
?>
<div style='background: black;'>
  <div class="margin w3-padding w3-center w3-responsive">
    <div class="w3-padding-32 w3-grey w3-circle w3-center" style="width: 230px; height: 230px; margin: auto;">
      <h1>Votre souris illuminera la voie</h1>
    </div>
    <img class="reveal-img" src="/img/logo.png"/>
    <img class="reveal-img" src="/img/logo.png"/>
  </div>
</div>

<style>
  .reveal-img {
    filter: brightness(0.1) grayscale(1);
    transition: filter 0.2s;
    will-change: filter;
  }

  .light-circle {
    background: radial-gradient(circle, #FFFFFFFF, #FFFFFF86, #FFFFFF00);
  }
</style>

<script>
document.querySelectorAll('.reveal-img').forEach(function(img) {
  img.addEventListener('mousemove', function(e) {
    img.style.filter = 'brightness(1) grayscale(0)';
    img.classList.remove()
  });
  img.addEventListener('mouseleave', function(e) {
    img.style.filter = 'brightness(0.1) grayscale(1)';
    img.classList.remove()
  });
  img.addEventListener('mouseenter', function(e) {
    img.style.filter = 'brightness(1) grayscale(0)';
    img.classList.add('w3-circle')
  });
});
</script>

<?php
$changeBackground = 'black';
include "$root/inc/footer.php";
?>