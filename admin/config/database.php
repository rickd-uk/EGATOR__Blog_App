<?php
require 'constants.php';
require 'functions.php';

error_reporting(1);

// Connect to DB
$con = new mysqli(DB_HOST, DB_USER, DB_PW, DB_NAME);

if (mysqli_errno($con)) {
  die(mysqli_error($con));
}
