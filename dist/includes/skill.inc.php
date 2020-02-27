<?php

// Prevent user from accessing this URL
if (isset($_POST['skill-submit'])) {

  require 'dbh.inc.php';

  $skill = $_POST['add-skill'];

  // If input field is empty, create error message and send user back to skill page
  if (empty($skill)) {
    header("Location: ../skill.php?error=emptyfield");
    exit();
  }
  // Check for a valid skill
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $skill)) {
    header("Location: ../skill.php?error=invalidskill");
    exit();
  }
  // Check if skill already exists in database
  else {
    // Create a prepared statement
    $sql = "SELECT skill_name FROM skills WHERE skill_name = ?";
    $stmt = mysqli_stmt_init($conn);

    // If SQL statement cannot be prepared
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../skill.php?error=sqlerror");
      exit();
    }
    else {
      // Bind the placeholder to the skill parameter as a string
      mysqli_stmt_bind_param($stmt, "s", $skill);

      // Execute prepared statement
      mysqli_stmt_execute($stmt);

      
      // Store result from prepared statement
      mysqli_stmt_store_result($stmt);

      // Store number of rows returned from a prepared statement
      $resultCheck = mysqli_stmt_num_rows($stmt);

      // If skill already exists, send error and return user back to skill page
      if ($resultCheck > 0) {
        header("Location: ../skill.php?error=skillalreadyexists");
        exit();
      }
      else {
        $sql = "INSERT INTO skills (skill_name) VALUES (?)";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../skill.php?error=sqlerror");
          exit();
        }
        else {

          mysqli_stmt_bind_param($stmt, "s", $skill);
          mysqli_stmt_execute($stmt);

          // Send success message and terminate the script
          header("Location: ../skill.php?addskill=success");
          exit();
        }
      }
    }
  }

  // Close prepared statement and db connection
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}

// When student uses resources page to find resources for a skill 
if (isset($_POST['skill'])) {
  require 'dbh.inc.php';

  // AJAX Params
  $skill = mysqli_real_escape_string($conn, $_POST['skill']);

  // Check if skill exists
  $sql = "SELECT skill_name FROM skills WHERE skill_name = ?";
  $stmt = mysqli_stmt_init($conn);

  // If SQL statement cannot be prepared
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../respources.html?error=sqlerror");
    exit();
  }
  else {
    // Bind the placeholder to the username and skillset parameter as strings
    mysqli_stmt_bind_param($stmt, "s", $skill);

    // Execute prepared statement
    mysqli_stmt_execute($stmt);

    
    // Store result from prepared statement
    mysqli_stmt_store_result($stmt);

    // Store number of rows returned from a prepared statement
    $resultCheck = mysqli_stmt_num_rows($stmt);

    // If skill exists, send back success
    if ($resultCheck > 0) {
      echo 'Success';
    }
    else {
      echo 'Failure';
    }
  }

}


// Redirect user back to skill if they do not use the submit button
else {
  header("Location: ../skill.php");
  exit();
}