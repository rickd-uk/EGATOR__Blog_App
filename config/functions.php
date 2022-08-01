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
