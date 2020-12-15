<?php
/** 
 *    Vehicles Controller
 */

session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
require_once '../library/functions.php';
require_once '../model/uploads-model.php';
require_once '../model/reviews-model.php';

$classifications = getClassifications();
$classificationsList = getClassificationsList();
$navList = navList($classifications);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
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
    $classificationName = filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING);

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
    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
    $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
    $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
    $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
    $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
    $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);

    if( empty($invMake) || empty($invModel) ||
        empty($invPrice) || empty($invStock) || 
        empty($invColor) || empty($invImage) || 
        empty($invThumbnail) || empty($invDescription) ||
        empty($classificationId)
    )
    {
      $message = "<p class='warning'>Please fill out all fields before proceeding</p>";
      include '../view/addvehicle.php';
      exit;
    }

    $vehicleOutcome = setVehicle($invMake, $invModel, $invDescription, $invPrice, $invStock, $invColor, $invImage, $invThumbnail, $classificationId);

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
  case 'mod':
    $invInfo = getInvItemInfo(filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT));
    if(count($invInfo) < 1) {
      $message = 'Sorry, no vehicle information could be found.';
    }
    include '../view/vehicle-update.php';
    exit;
    break;
  case 'del':
    $invInfo = getInvItemInfo(filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT));
    if(count($invInfo) < 1) {
      $message = 'Sorry, no vehicle information could be found.';
    }
    include '../view/vehicle-delete.php';
    exit;
    break;
  case 'getInventoryItems':
    $inventoryArray = getInventoryByClassification(filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
    
    echo json_encode($inventoryArray);
    break;
  case 'updateVehicle':
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
    $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
    $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
    $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
    $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
    $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);

    if( empty($invMake) || empty($invModel) ||
        empty($invPrice) || empty($invStock) || 
        empty($invColor) || empty($invImage) || 
        empty($invThumbnail) || empty($invDescription) ||
        empty($classificationId)
    )
    {
      $_SESSION['message'] = "<p class='warning'>Please complete all information for the updated item! Double check the classification of the item.</p>";
      include '../view/vehicle-update.php';
      exit;
    }

    $updateResult = updateVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $invId);

    if($updateResult) 
    {
    	$_SESSION['message'] = "<p class='success'>Cool Beans! $invMake $invModel was updated successfully.</p>";
      header('location: /phpmotors/vehicles/');
	    exit;
    } 
    else {
    	$_SESSION['message'] = "<p class='failed'>D'Oh! There was a problem with the update. Try again.</p>";
	    include '../view/vehicle-update.php';
	    exit;
    }
    
    break;
  case 'deleteVehicle':
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);

    $deleteResult = deleteVehicle($invId);

    $_SESSION['message'] = ($deleteResult) ? "<p class='success'>Success! $invMake $invModel was deleted.</p>" : "<p class='failed'>Failed. $invMake $invModel was not deleted.</p>";

    header('location: /phpmotors/vehicles/');
    exit;
    break;
  case 'showVehicle':
    $invId = filter_input(INPUT_GET, 'Id', FILTER_SANITIZE_NUMBER_INT);
    $_SESSION['carData']['invId'] = $invId;

    $prefix = "Add";
    $title = "Reviews";

    $vehicleInfo = getVehicleDetailsById($invId);
    $vehicleThumbs = getThumbnailsById($invId);
    $showThumbs = showThumbnails($vehicleThumbs);
    $vehicleDetails = showVehicleDetails($vehicleInfo);

    $getReviews = getReviewByInvId($invId);
    $reviewEntries = buildReviewsDisplay($getReviews, $invId, $prefix);
    // var_dump('get Reviews', $getReviews);

    include '../view/vehicle-detail.php';
    break;
  case 'classification':
    $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
    $vehicles = getVehiclesByClassification($classificationName, 1);

    if(!count($vehicles)) {
      $message = "<p class='notice'>Sorry, no $classificationName vehicles could be found.</p>";
    } else {
      $vehicleDisplay = buildVehiclesDisplay($vehicles);
    }

    include '../view/classification.php';
    break;
  default:
    $classificationList = buildClassificationList($classificationsList);
    include '../view/vehicle_management.php';
    break;
}

// echo $classList;
