<?php

// FreeSQLDatabase no longer works

// $servername = "sql2.freesqldatabase.com";
// $dBUsername = "sql2326579";
// $dBPassword = "jK9*cV6*";
// $dBName = "sql2326579";

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "unitracks";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

// If db connection failed, kill the connection and output an error message
if (!$conn) {
  die("Connection failed: ".mysql_connect_error());
}

