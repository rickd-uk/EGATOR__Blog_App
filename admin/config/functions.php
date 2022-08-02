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
{
?>
  <?php if ($_SESSION["$mode-success"] || $_SESSION["$mode"]) : ?>

    <?php $task_status =  isset($_SESSION["$mode-success"]) ? '-success' : '' ?>
    <?php $status = $task_status == '-success' ? 'success' : 'error' ?>

    <p class="alert__message   <?= $status ?> ">
      <?= $_SESSION["$mode$task_status"];
      unset($_SESSION["$mode$task_status"]);
      unset($_SESSION["$mode"]);
      ?>
    </p>

    <!-- Hide success or error message after 2 seconds -->
    <script>
      setTimeout(function() {
        document.querySelector('.alert__message').style.display = 'none';
      }, 2000);
    </script>
  <?php endif; ?>

  <?php
  $part = explode("-", $mode);
  if ($part[2] == "error") : ?>
    <p class="alert__message   error">
      <?= "Couldn't $part[0] $part[1] - Contact admin!";
      unset($_SESSION["mode"]);
      ?>
    </p>
  <?php endif; ?>
<?php } ?>