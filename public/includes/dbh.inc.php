<?php

// $servername = "us-cdbr-iron-east-04.cleardb.net";
// $dBUsername = "bf4661d4fc4b24";
// $dBPassword = "8b3c2ae4";
// $dBName = "heroku_111920bb25220e5";

// $conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

// // If db connection failed, kill the connection and output an error message
// if (!$conn) {
//   echo "Error: Unable to connect to MySQL." . PHP_EOL;
//   echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
//   echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
//   exit;
//   die("Connection failed: ".mysql_connect_error());
// }

$url = parse_url(getenv("mysql://bf4661d4fc4b24:8b3c2ae4@us-cdbr-iron-east-04.cleardb.net/heroku_111920bb25220e5?reconnect=true"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);