<?php
/**
 *    Index Controller
 */

session_start();

require_once 'library/connections.php';
require_once 'model/main-model.php';
require_once 'library/functions.php';

$classifications = getClassifications();
$navList = navList($classifications);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

if(isset($_COOKIE['firstname']))  {
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

switch($action) 
{
  case 'template':
    include 'view/template.php';
    break;
  case '500':
    include 'view/500.php';
    break;
  default:
    include 'view/home.php';
}