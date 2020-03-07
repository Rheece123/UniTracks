<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "unitracks";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

// If db connection failed, kill the connection and output an error message
if (!$conn) {
  die("Connection failed: ".mysql_connect_error());
}
