<?php
$conn = mysqli_connect('localhost', 'root', 'hamza', 'produitss');
if (!$conn) {
  die('Error: ' . mysqli_connect_error());
}