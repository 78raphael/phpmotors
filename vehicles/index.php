<?php
/** 
 *    Vehicles Controller
 */

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';

$classifications = getClassifications();
$classificationsList = getClassificationsList();
$inventory = getInventory();

// NAVIGATION BAR
$navList = '<ul class="nav-links">';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors homepage'>Home</a></li>";

foreach($classifications as $classification) {
  $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

// Vehicles list
$classList = '<option value="" disabled>Select a Vehicle</option>';
foreach($classificationsList as $class) {
  $classList .= "<option value='".$class['classificationId']."'>".$class['classificationName']."</option>";
}

// $action = (!$action || $action == NULL) ? filter_input(INPUT_GET, 'action') : filter_input(INPUT_POST, 'action');

$action = filter_input(INPUT_POST, 'action');
if($action == NULL) {
  $action = filter_input(INPUT_GET, 'action');
}

switch ($action)  {
  case 'addvehicle':
    include '../view/vehicles.php';
    break;
  case 'addclassification':
    include '../view/vehicles.php';
    break;
  default:
    include '../view/vehicle-management.php';
    break;
}

// echo $classList;
