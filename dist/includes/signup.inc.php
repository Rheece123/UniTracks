<?php

// Prevent user from signing up by typing in this URL
if (isset($_POST['signup-submit'])) {

  require 'dbh.inc.php';

  $username = $_POST['uid'];
  $email = $_POST['mail'];
  $password = $_POST['pwd'];
  $passwordRepeat = $_POST['pwd-repeat'];
  $accountType = $_POST['account-type'];

  // If input fields are empty, create error message and send user back to signup form
  if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat) || empty($accountType)) {
    header("Location: ../signup.php?error=emptyfields&uid=$username&mail=$email");
    exit();
  }
  // Check for a valid username and a valid email
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../signup.php?error=invaliduidmail");
    exit();
  }
  // Check for a valid email
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invalidmail&uid=$username");
    exit();
  }
  // Check for a valid username
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../signup.php?error=invaliduid&mail=$email");
    exit();
  }
  // Check if passwords match
  else if ($password !== $passwordRepeat) {
    header("Location: ../signup.php?error=passwordcheck&uid=$username&mail=$email");
    exit();
  }
  // Check if username is already taken
  else {
    // Create a prepared statement
    $sql = "SELECT username FROM users WHERE username = ?";
    $stmt = mysqli_stmt_init($conn);

    // If SQL statement cannot be prepared
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../signup.php?error=sqlerror");
      exit();
    }
    else {
      // Bind the placeholder to the username parameter as a string
      mysqli_stmt_bind_param($stmt, "s", $username);

      // Execute prepared statement
      mysqli_stmt_execute($stmt);

      
      // Store result from prepared statement
      mysqli_stmt_store_result($stmt);

      // Store number of rows returned from a prepared statement
      $resultCheck = mysqli_stmt_num_rows($stmt);

      // If user already exists, send error and return user back to sign up form
      if ($resultCheck > 0) {
        header("Location: ../signup.php?error=usertaken&mail=$email");
        exit();
      }
      else {
        $sql = "INSERT INTO users (username, email, account_type, user_password) VALUES (?, ?, ?, ?)";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../signup.php?error=sqlerror");
          exit();
        }
        else {
          // hash password before storing it in prepared statement parameter
          $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

          mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $accountType, $hashedPwd);
          mysqli_stmt_execute($stmt);

          // Send success message and terminate the script
          header("Location: ../signup.php?signup=success");
          exit();
        }
      }
    }
  }

  // Close prepared statement and db connection
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}

// Redirect user back to signup if they do not use the submit button
else {
  header("Location: ../signup.php");
  exit();
}