<?php
/**
 *    Index Controller
 */

require_once 'library/connections.php';
require_once 'model/main-model.php';

$classifications = getClassifications();

// NAVIGATION BAR
$navList = '<ul class="nav-links">';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors homepage'>Home</a></li>";

foreach($classifications as $classification) {
  $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

// forms input
$action = filter_input(INPUT_POST, 'action');

if($action == NULL) {
  // links input
  $action = filter_input(INPUT_GET, 'action');
}

switch($action) {
  case 'template':
    include 'view/template.php';
    break;
  case '500':
    include 'view/500.php';
    break;

  default:
    include 'view/home.php';
}