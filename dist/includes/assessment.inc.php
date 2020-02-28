<?php

session_start();

// Check for a POST Variable of score at end of assessment
if (isset($_POST['currentQuestion'])) {
  require 'dbh.inc.php';

  // Username from Session
  $username = $_SESSION['userName'];

  // AJAX Params
  $questionID = mysqli_real_escape_string($conn, $_POST['currentQuestion']);
  $moduleTitle = mysqli_real_escape_string($conn, $_POST['moduleTitle']);

  // Create table name by replacing space with underscore
  $table = strtolower(str_replace(' ', '_', $moduleTitle));

  // Select question from table using id
  $sql = "SELECT * FROM $table WHERE id = ?";
  $stmt = mysqli_stmt_init($conn);

  // If SQL statement cannot be prepared
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../assessment.php?error=sqlerror");
    exit();
  }
  else {
    // Bind the placeholder to the question id
    mysqli_stmt_bind_param($stmt, "i", $questionID);

    // Execute prepared statement
    mysqli_stmt_execute($stmt);

    // Store result from prepared statement
    mysqli_stmt_store_result($stmt);

    // Store query results in an array
    if (mysqli_stmt_fetch) {
      echo json_encode(array($question = "question",
                             $answer_a = "answer_a",
                             $answer_b = "answer_b",
                             $answer_c = "answer_c",
                             $answer_d = "answer_d",
                             $correct_answer = "correct_answer",
                             $category = "category"          
                            ));
    }

    
    
  }
}



// Check for a POST Variable of score at end of assessment
if (isset($_POST['score'])) {
  require 'dbh.inc.php';

  // Username from Session
  $username = $_SESSION['userName'];

  // AJAX Params
  $score = mysqli_real_escape_string($conn, $_POST['score']);
  $skillset = mysqli_real_escape_string($conn, $_POST['skillset']);

  // Check score for skillset already exists
  $sql = "SELECT username, skillset FROM scores WHERE username = ? AND skillset = ?";
  $stmt = mysqli_stmt_init($conn);

  // If SQL statement cannot be prepared
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../assessment.php?error=sqlerror");
    exit();
  }
  else {
    // Bind the placeholder to the username and skillset parameter as strings
    mysqli_stmt_bind_param($stmt, "ss", $username, $skillset);

    // Execute prepared statement
    mysqli_stmt_execute($stmt);

    
    // Store result from prepared statement
    mysqli_stmt_store_result($stmt);

    // Store number of rows returned from a prepared statement
    $resultCheck = mysqli_stmt_num_rows($stmt);

    // If score for skillset already exists, update the current score
    if ($resultCheck > 0) {
      $sql = "UPDATE scores SET score = ? WHERE username = ? AND skillset = ?";
      
      $stmt = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../assessment.php?error=sqlerror");
        exit();
      }

      else {
        mysqli_stmt_bind_param($stmt, "sss", $score, $username, $skillset);
        mysqli_stmt_execute($stmt);
      }
    }
    // Else insert a new score record into DB
    else {
      $sql = "INSERT INTO scores (username, skillset, score) VALUES (?, ?, ?)";

      $stmt = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../assessment.php?error=sqlerror");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "sss", $username, $skillset, $score);
        mysqli_stmt_execute($stmt);
      }
    }
  }
}



