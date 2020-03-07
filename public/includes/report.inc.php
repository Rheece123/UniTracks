<?php

if (isset($_POST['submit'])) {

  require 'dbh.inc.php';

  $student = $_POST['search-report'];

  // If input field is empty, create error message and send user back to skill page
  if (empty($student)) {
    header("Location: ../report.php?error=emptyfield");
    exit();
  }
  // Check for a valid student
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $student)) {
    header("Location: ../report.php?error=invalidstudent");
    exit();
  }
  else {
    // Check if student exists in database
    $sql = "SELECT * FROM scores WHERE username = ?;";
    $stmt = mysqli_stmt_init($conn);

    // If SQL statement cannot be prepared
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../report.php?error=sqlerror");
      exit();
    }
    else {
      // Bind the placeholder to the username parameter as a string
      mysqli_stmt_bind_param($stmt, "s", $student);

      // Execute prepared statement
      mysqli_stmt_execute($stmt);

      // Get result from prepared statement
      $result = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($result)) {
        session_start();

        // Create session variables
        $_SESSION['username'] = $row['username'];
        $_SESSION['skillset'] = $row['skillset'];
        $_SESSION['score'] = $row['score'];
        $_SESSION['dateCompleted'] = date( "d/m/Y", strtotime($row['date_completed']));

        header("Location: ../report.php?report=success");
        exit();
        

        
      }

      else {
        header("Location: ../report.php?error=nostudent");
        exit();
      }
    }
  }

  // Close prepared statement and db connection
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}

// Redirect user back to report page if they do not use the submit button
else {
  header("Location: ../report.php");
  exit();
}