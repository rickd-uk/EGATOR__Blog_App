<?php

function show($stuff)
{
  echo "<pre>";
  print_r($stuff);
  echo "</pre>";
}

function show_and_freeze($stuff)
{
  echo "<pre>";
  print_r($stuff);
  echo "</pre>";
  die();
}

?>

<?php function display_message($mode)
{ ?>

  <?php if (isset($mode)) : ?>

    <?php $task_status =  isset($_SESSION["$mode-success"]) ? '-success' : 'error' ?>
    <?php $status = $task_status == '-success' ? 'success' : '' ?>

    <div id='info-message'>
      <p class="alert__message <?= $status ?> container">
        <?= $_SESSION["$mode$task_status"];
        unset($_SESSION["$mode$task_status"]);
        unset($_SESSION["mode"]);
        ?>
      </p>
    </div>

    <!-- Hide success or error message after 2 seconds -->
    <script>
      setTimeout(function() {
        document.getElementById('info-message').style.display = 'none';
      }, 2000);
    </script>

  <?php endif; ?>
<?php } ?>