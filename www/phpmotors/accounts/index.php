<?php

// Create or access a Session
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/accounts-model.php';
require_once '../library/functions.php';

buildNavBar();

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action) {
  case 'login':
    include '../view/login.php';
    break;
  case 'registration':
    include '../view/registration.php';
    break;
  case 'register':
    // Filter and store the data
    $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
    $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);

    $emailExists = checkExistingEmail($clientEmail);

    // Check for existing email address in the table
    if($emailExists){
      $_SESSION['message'] = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
      include '../view/login.php';
      exit;
    }

    // Check for missing data
    if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
      $_SESSION['message'] = '<p>Please provide information for all empty form fields.</p>';
      include '../view/registration.php';
      exit; 
    }

    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

    // Send the data to the model
    $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

    // Check and report the result
    if($regOutcome === 1) {
      $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
      header('Location: /phpmotors/accounts/?action=login');
      exit;
    } else {
      $_SESSION['message'] = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
      include '../view/registration.php';
      exit;
    }
    break;
  case 'Login':
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

    $emailCheck = checkEmail($clientEmail);
    $passwordCheck = checkPassword($clientPassword);

    // Run basic checks, return if errors
    if (empty($emailCheck) || empty($passwordCheck)) {
      $_SESSION['message'] = '<p class="notice">Please provide a valid email address and password.</p>';
      include '../view/login.php';
      exit;
    }
      
    // A valid password exists, proceed with the login process
    // Query the client data based on the email address
    $clientData = getClient($clientEmail);
    // Compare the password just submitted against
    // the hashed password for the matching client
    $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
    // If the hashes don't match create an error
    // and return to the login view
    if(!$hashCheck) {
      $_SESSION['message'] = '<p class="notice">Please check your password and try again.</p>';
      include '../view/login.php';
      exit;
    }
    // A valid user exists, log them in
    $_SESSION['loggedin'] = TRUE;
    // Remove the password from the array
    // the array_pop function removes the last
    // element from an array
    array_pop($clientData);
    // Store the array into the session
    $_SESSION['clientData'] = $clientData;
    // Send them to the home view
    include '../view/admin.php';
    exit;

  case 'admin':
    include '../view/admin.php';
    break;

  case 'client':
    $clientId = filter_input(INPUT_GET, 'clientId', FILTER_VALIDATE_INT);
    $clientInfo = getClientById($clientId);

    $_SESSION['clientData'] = $clientInfo;
    
    include '../view/update-client.php';
    exit;
    break;

  case 'password':
    $clientId = filter_input(INPUT_GET, 'clientId', FILTER_VALIDATE_INT);

    include '../view/update-password.php';
    exit;
    break;

  case 'updateClient':
    // Filter and store the data
    $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
    $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

    $clientEmail = checkEmail($clientEmail);

    if(isset($clientEmail) && $clientEmail != $_SESSION['clientData']['clientEmail']) {
      $emailExists = checkExistingEmail($clientEmail);

      // Check for existing email address in the table
      if($emailExists){
        $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
        include '../view/update-client.php';
        exit;
      }
    }
    
    // Check for missing data
    if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
      $_SESSION['message'] = '<p>Please provide information for all empty form fields.</p>';
      include '../view/update-client.php';
      exit; 
    }

    // Send the data to the model
    $updateResult = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

    // Check and report the result
    if($updateResult === 1) {
      $message = "<p class='success'>Success, You have updated your information.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/accounts?action=admin');
      exit;
    } else {
      $message = "<p class='error'>Sorry, something went wrong, your info was not updated. Please try again.</p>";
      include '../view/update-client.php';
      exit;
    }
    break;

  case 'updatePassword':
    // Filter and store the data
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

    $checkPassword = checkPassword($clientPassword);

    // Check for missing data
    if(empty($checkPassword)){
      $message = '<p>Please provide information for all empty form fields.</p>';
      include '../view/update-password.php';
      exit; 
    }

    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

    // Send the data to the model
    $updateResult = updatePassword($hashedPassword, $clientId);

    // Check and report the result
    if($updateResult === 1) {
      $message = "<p class='success'>Success, You have changed your password.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/accounts?action=admin');
      exit;
    } else {
      $message = "<p class='error'>Sorry, something went wrong, your password was not changed. Please try again.</p>";
      include '../view/update-client.php';
      exit;
    }
    break;

  case 'logout':
    session_start();
    session_destroy();
    header("Location: /phpmotors/index.php");
    break;
  
  default:
    include '../view/login.php';
 }