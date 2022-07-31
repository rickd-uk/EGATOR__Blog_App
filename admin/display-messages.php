<?php if (isset($_SESSION['add-category-success'])) : ?>
  <div id='info-message'>
    <p class="alert__message success container">
      <?= $_SESSION['add-category-success'];
      unset($_SESSION["add-category-success"]);
      ?>
    </p>
  </div>
<?php elseif (isset($_SESSION['add-category'])) : ?>
  <div id='info-message'>
    <p class="alert__message container">
      <?= $_SESSION['add-category'];
      unset($_SESSION["add-category"]);
      ?>
    </p>
  </div>
<?php elseif (isset($_SESSION['delete-category-success'])) : ?>
  <div id='info-message'>
    <p class="alert__message container">
      <?= $_SESSION['delete-category-success'];
      unset($_SESSION["delete-category-success"]);
      ?>
    </p>
  </div>
<?php endif; ?>

<!-- Hide success or error message after 2 seconds -->
<script>
  setTimeout(function() {
    document.getElementById('info-message').style.display = 'none';
  }, 2000);
</script>