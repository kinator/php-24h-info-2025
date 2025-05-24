<?php
include "$root/inc/head.php";
?>
<div style='background: black;'>
  <div class="margin w3-padding w3-center w3-responsive">
    <div class="w3-padding-32 light-circle w3-circle w3-center" style="width: 250px; height: 250px; margin: auto;">
      <h1>Votre souris illuminera la voie</h1>
    </div>
    <?php
    $folder = '/img';
    $images = glob($folder . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

    foreach ($images as $image) {
      echo $image;
    }
    ?>
    <img class="reveal-img" src="/img/basilique.jpeg"/>
    <img class="reveal-img" src="/img/gerland.jpg"/>
    <img class="reveal-img" src="/img/parc.jpg"/>
    <img class="reveal-img" src="/img/place_celestins.jpeg"/>
    <img class="reveal-img" src="/img/hotel_dieu.jpeg"/>
    <img class="reveal-img" src="/img/jacobins.jpg"/>
    <img class="reveal-img" src="/img/guillotiere.jpg"/>
    <img class="reveal-img" src="/img/logo.png"/>
  </div>
</div>

<script>
document.querySelectorAll('.reveal-img').forEach(function(img) {
  // Create the gradient circle
  var circle = document.createElement('div');
  circle.className = 'light-circle';
  Object.assign(circle.style, {
    position: 'absolute',
    width: '60px',
    height: '60px',
    borderRadius: '50%',
    pointerEvents: 'none',
    left: '50%',
    top: '50%',
    transform: 'translate(-50%, -50%)',
    zIndex: 2,
    display: 'block'
  });

  // Wrap the image in a relative container
  var wrapper = document.createElement('div');
  wrapper.style.position = 'relative';
  wrapper.style.display = 'inline-block';
  img.style.maxWidth = '700px'
  img.style.minWidth = '400px'

  img.parentNode.insertBefore(wrapper, img);
  wrapper.appendChild(img);
  wrapper.appendChild(circle);

  // Show circle only when brightness is low (initially)
  circle.style.display = 'block';

  img.addEventListener('mouseenter', function() {
    img.style.filter = 'brightness(1) grayscale(0)';
    circle.style.display = 'none';
  });
  img.addEventListener('mouseleave', function() {
    img.style.filter = 'brightness(0.1) grayscale(1)';
    circle.style.display = 'block';
  });
});
</script>

<style>
  .reveal-img {
    filter: brightness(0.1) grayscale(1);
    transition: filter 0.2s;
    will-change: filter;
  }

  .light-circle {
    background: radial-gradient(circle, #FFFFFFE0, #FFFFFF4F, #FFFFFF00);
  }
</style>

<?php
$changeBackground = 'black';
include "$root/inc/footer.php";
?>