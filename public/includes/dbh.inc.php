<?php

$servername = "us-cdbr-iron-east-04.cleardb.net";
$dBUsername = "bf4661d4fc4b24";
$dBPassword = "8b3c2ae4";
$dBName = "heroku_111920bb25220e5";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

// If db connection failed, kill the connection and output an error message
if (!$conn) {
  die("Connection failed: ".mysql_connect_error());
}
