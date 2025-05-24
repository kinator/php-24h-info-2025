<?php
switch (GETPOST('action2')) {
  case null:
    $pageTitle = 'Photos de la fête des lumières';
    include "$root/views/photo.view.php";
    break;

  default:
    $pageTitle = 'Page not found';
    include "$root/views/404.view.php";
    break;
}
?>

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

  img.parentNode.insertBefore(wrapper, img);
  wrapper.appendChild(img);
  wrapper.appendChild(circle);

  // Show circle only when brightness is low (initially)
  circle.style.display = 'block';

  img.addEventListener('mouseenter', function() {
    img.style.filter = 'brightness(1) grayscale(0)';
    circle.style.display = 'none';
  });
  img.addEventListener('resize', function() {
    if (screen.width < 900) {
      img.style.maxWidth = '300px'
      img.style.minWidth = '200px'
    } else {
      img.style.maxWidth = '700px'
      img.style.minWidth = '500px'
    }
  });
  img.addEventListener('load', function() {
    if (screen.width < 900) {
      img.style.maxWidth = '300px'
      img.style.minWidth = '200px'
    } else {
      img.style.maxWidth = '700px'
      img.style.minWidth = '500px'
    }
  });
  img.addEventListener('mouseleave', function() {
    img.style.filter = 'brightness(0.1) grayscale(1)';
    circle.style.display = 'block';
  });
});
</script>