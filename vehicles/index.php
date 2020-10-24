<?php
/** 
 *    Vehicles Controller
 */

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';

$classifications = getClassifications();
$classificationsList = getClassificationsList();

// NAVIGATION BAR
$navList = '<ul class="nav-links">';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors homepage'>Home</a></li>";

foreach($classifications as $classification)
{
  $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

// Vehicles list
$classList = '<select name="classificationId" id="classificationId">';
$classList .= '<option value="" selected disabled>Select a Vehicle</option>';
foreach($classificationsList as $class)
{
  $classList .= "<option value='".$class['classificationId']."'>".$class['classificationName']."</option>";
}
$classList .= '</select>';

// $action = (!$action || $action == NULL) ? filter_input(INPUT_GET, 'action') : filter_input(INPUT_POST, 'action');

$action = filter_input(INPUT_POST, 'action');
if($action == NULL)
{
  $action = filter_input(INPUT_GET, 'action');
}

switch ($action)  
{
  case 'addvehicle':
    include '../view/addvehicle.php';
    break;
  case 'addclassification':
    include '../view/addclassification.php';
    break;
  case 'addClass':
    $classificationName = filter_input(INPUT_POST, 'classificationName');

    if(empty($classificationName))
    {
      $message = "<p class='warning'>Please enter a valid car classification before proceeding</p>";
      include '../view/addclassification.php';
      exit;
    }

    $classifyOutcome = setClassification($classificationName);

    if($classifyOutcome > 0)
    {
      header("Location: /phpmotors/vehicles/index.php");
      exit;
    }
    else 
    {
      $message = "<p class='failed'>Classification was not added. Please try again.</p>";
      include '../view/addclassification.php';
      exit;
    }
    break;
  case 'addCar':
    $invMake = filter_input(INPUT_POST, 'invMake');
    $invModel = filter_input(INPUT_POST, 'invModel');
    $invDescription = filter_input(INPUT_POST, 'invDescription');
    $invPrice = filter_input(INPUT_POST, 'invPrice');
    $invStock = filter_input(INPUT_POST, 'invStock');
    $invColor = filter_input(INPUT_POST, 'invColor');
    $classificationId = filter_input(INPUT_POST, 'classificationId');

    if(empty($invMake) || empty($invModel) ||empty($invDescription) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId))
    {
      $message = "<p class='warning'>Please fill out all fields before proceeding</p>";
      include '../view/addvehicle.php';
      exit;
    }

    $vehicleOutcome = setVehicle($invMake, $invModel, $invDescription, $invPrice, $invStock, $invColor, $classificationId);

    if($vehicleOutcome > 0)
    {
      $message = "<p class='success'>Vehicle was added to inventory</p>";
      include '../view/addvehicle.php';
      exit;
    }
    else
    {
      $message = "<p class='failed'>Vehicle was not added. Please try again.</p>";
      include '../view/addvehicle.php';
      exit;
    }

    break;
  default:
    include '../view/vehicle_management.php';
    break;
}

// echo $classList;
