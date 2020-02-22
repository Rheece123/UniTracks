<?php

// Prevent user from getting to login page by typing path into URL
if (isset($_POST['login-submit'])) {

  require 'dbh.inc.php';

  // Get username and password from input fields
  $mailuid = $_POST['mailuid'];
  $password = $_POST['pwd'];

  // Check if username or password fields are empty
  if (empty($mailuid) || empty($password)) {
    header("Location: ../login.php?error=emptyfields");
    exit();
  }
  else {
    // Check if username or email exists in database
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
    $stmt = mysqli_stmt_init($conn);

    // If SQL statement cannot be prepared
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../login.php?error=sqlerror");
      exit();
    }
    else {
      // Bind the placeholder to the username parameter as a string
      mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);

      // Execute prepared statement
      mysqli_stmt_execute($stmt);

      // Get result from prepared statement
      $result = mysqli_stmt_get_result($stmt);

      // Check if there is anything stored inside result from prepared statement
      if ($row = mysqli_fetch_assoc($result)) {
        // if user exists, check if password inputted is the same as the hashed password from the database
        $pwdCheck = password_verify($password, $row['user_password']);

        // If password inputted does not match the hashed password from the database
        if ($pwdCheck === false) {
          header("Location: ../login.php?error=wrongpwd");
          exit();
        }
        // Log user in by starting a session
        else if ($pwdCheck === true) {
          session_start();

          // Create session variables
          $_SESSION['userId'] = $row['id'];
          $_SESSION['userName'] = $row['username'];
          $_SESSION['accountType'] = $row['account_type'];

          if ($row['account_type'] === 'student') {
            header("Location: ../student.php?login=success");
            exit();
          }
          else if ($row['account_type'] === 'instructor') {
            header("Location: ../instructor.php?login=success");
            exit();
          }

          
        }

        else {
          header("Location: ../login.php?error=wrongpwd");
          exit();
        }
      }
      
      else {
        header("Location: ../login.php?error=nouser");
        exit();
      }


    }


  }

}

// Redirect user back to index page if they do not use the login button
else {
  header("Location: ../index.php");
  exit();
}

