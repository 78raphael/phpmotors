<?php
/** 
 *    Accounts Controller
 */

session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/accounts-model.php';
require_once '../model/vehicles-model.php';
require_once '../model/reviews-model.php';
require_once '../library/functions.php';

$classifications = getClassifications();
$navList = navList($classifications);
$classificationsList = getClassificationsList();

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch($action) 
{
  case 'login':
    include '../view/login.php';
    break;
  case 'registration':
    include '../view/registration.php';
    break;
  case 'admin':
    $reviewsData = getReviewsByClientId($_SESSION['clientData']['clientId']);
    $clientReviews = buildClientReviewsDisplay($reviewsData);

    include '../view/admin.php';
    break;
  case 'client-update':
    include '../view/client-update.php';
    break;
  case 'vehicle-update':
    include '../view/vehicle-update.php';
    break;
  case 'register':
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

    $clientEmail = checkEmail($clientEmail);
    $existingEmail = checkExistingEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);

    // Check for existing email address in the table
    if($existingEmail)  {
      $message = '<p class="warning">That email address already exists. Do you want to login instead?</p>';
      include '../view/login.php';
      exit;
    }

    if( empty($clientFirstname) || 
        empty($clientLastname) || 
        empty($clientEmail) || 
        empty($checkPassword)
      )  
    {
      $message = "<p class='warning'>Please provide information for all empty form fields.</p>";
      include '../view/registration.php';
      exit;
    }

    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

    $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

    if($regOutcome === 1)  
    {
      setcookie('firstName', $clientFirstname, strtotime('+1 year'), '/');
      $_SESSION['message'] = "<p class='success'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";

      header('Location: /phpmotors/accounts/?action=login');
      exit;
    } 
    else 
    {
      $_SESSION['message'] = "<p class='failed'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";

      header('Location: /phpmotors/accounts/?action=login');
      exit;
    }
    break;
  case 'validate':
    $clientEmail = checkEmail(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    $checkPassword = checkPassword($clientPassword);

    if(empty($clientEmail) || empty($checkPassword))  
    {
      $message = "<p class='warning'>Please provide a valid email address and password.</p>";
      include '../view/login.php';
      exit;
    }

    $clientData = getClient($clientEmail);
    $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);

    if(!$hashCheck) {
      $_SESSION['message'] = '<p class="warning">Please check your password and try again.</p>';
      include '../view/login.php';
      exit;
    }

    setcookie("firstName", "", time()-3600, '/');
    $_SESSION['loggedin'] = TRUE;
    array_pop($clientData);
    $_SESSION['clientData'] = $clientData;

    $reviewsData = getReviewsByClientId($_SESSION['clientData']['clientId']);
    $clientReviews = buildClientReviewsDisplay($reviewsData);

    include '../view/admin.php';
    exit;

    break;
  case 'logout':
    session_destroy();
    setcookie("firstName", "", time()-3600, '/');
    header('Location: /phpmotors/');
    break;
  case 'updateAccount':
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

    $clientEmail = checkEmail($clientEmail);
    if(!$clientEmail) {
      $_SESSION['clientMessage'] = "<p class='warning'>Please enter a valid email before submitting. Try again.</p>";
      header('Location: /phpmotors/accounts/?action=client-update');
      exit;
    }

    if($_SESSION['clientData']['clientEmail'] != $clientEmail)  {
      if(checkExistingEmail($clientEmail))  {
        $_SESSION['clientMessage'] = '<p class="warning">That email address already exists. Please enter a different email.</p>';
        header('Location: /phpmotors/accounts/?action=client-update');
        exit;
      }
    }

    if( empty($clientFirstname) || 
        empty($clientLastname) || 
        empty($clientEmail)
      )
    {
      $_SESSION['clientMessage'] = "<p class='warning'>Empty fields are not allowed. Please try again.</p>";
      header('Location: /phpmotors/accounts/?action=client-update');
      exit;
    }

    $updateResult = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

    if($updateResult)
    {
      $_SESSION['message'] = "<p class='success'>Account info was updated successfully.</p>";

      $clientData = getClientById($clientId);

      $_SESSION['loggedin'] = TRUE;
      $_SESSION['clientData'] = $clientData;

      header('Location: /phpmotors/accounts/?action=admin');
      exit;
    }
    else  {
      $_SESSION['clientMessage'] = "<p class='failed'>An error occured. Check fields and try again.</p>";
      header('Location: /phpmotors/accounts/?action=client-update');
      exit;
    }

    break;
  case 'changePassword':
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

    $checkPassword = checkPassword($clientPassword);
    if(!$checkPassword) {
      $_SESSION['passwordMessage'] = "<p class='warning'>Password does not fit requirements. Please try again.</p>";
      header('Location: /phpmotors/accounts/?action=client-update');
      exit;
    }

    if(empty($checkPassword))
    {
      $_SESSION['passwordMessage'] = "<p class='warning'>Password field cannot be blank. Please submit a password.</p>";
      header('Location: /phpmotors/accounts/?action=client-update');
      exit;
    }

    $updateResult = updatePassword(password_hash($clientPassword, PASSWORD_DEFAULT), $clientId);

    if($updateResult === 1)
    {
      $_SESSION['message'] = "<p class='success'>Success! Password was updated.</p>";
    }
    else
    {
      $_SESSION['message'] = "<p class='failed'>An error occured. Please re-submit password.</p>";
    }
    header('Location: /phpmotors/accounts/?action=admin');
    exit;

    break;
  default:
    include '../view/500.php';
    break;
}