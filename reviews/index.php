<?php
/** 
 *    Reviews Controller
 */

session_start();

require_once '../library/connections.php';
require_once '../library/functions.php';
require_once '../model/reviews-model.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
require_once '../model/uploads-model.php';

$classifications = getClassifications();
// $classificationsList = getClassificationsList();
$navList = navList($classifications);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action)
{
  case 'addReview':
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
    $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);

    $reviewResult = storeReview($reviewText, $invId, $clientId);

    if($reviewResult) {
      $_SESSION['message'] = '<p class="success">Review was successfully added.<?p>';
    } else{
      $_SESSION['message'] = '<p class="failed">Error: review not added. Try again.</p>';
    }

    header("Location: /phpmotors/vehicles/?action=showVehicle&Id=$invId");
    break;
  case 'editReview':
    $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

    $prefix = "Update";
    $title = "Edit Review";

    $getReviews = getReviewById($reviewId);
    $invId = $getReviews[0]['invId'];
    $_SESSION['carData']['reviewId'] = $reviewId;

    $vehicleInfo = getVehicleDetailsById($invId);
    $vehicleThumbs = getThumbnailsById($invId);
    $showThumbs = showThumbnails($vehicleThumbs);
    $vehicleDetails = showVehicleDetails($vehicleInfo);

    $reviewEntries = buildEditReviewDisplay($getReviews, $invId, $prefix);

    include '../view/vehicle-detail.php';
    break;
  case 'updateReview':
    $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
    $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);

    $reviewResult = updateReview($reviewText, $reviewId);

    $invId = $_SESSION['carData']['invId'];
    $prefix = "Add";
    $title = "Review";

    $vehicleInfo = getVehicleDetailsById($invId);
    $vehicleThumbs = getThumbnailsById($invId);
    $showThumbs = showThumbnails($vehicleThumbs);
    $vehicleDetails = showVehicleDetails($vehicleInfo);

    $getReviews = getReviewByInvId($invId);
    $reviewEntries = buildReviewsDisplay($getReviews, $invId, $prefix);

    if($reviewResult) {
      $_SESSION['message'] = '<p class="success">Review was successfully updated.<?p>';
    } else{
      $_SESSION['message'] = '<p class="failed">Error: review not updated. Try again.</p>';
    }

    include '../view/vehicle-detail.php';
    break;
  case 'confirmDelete':
    $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

    $reviewResults = getReviewById($reviewId);

    include '../view/confirm-delete.php';
    break;
  case 'deleteReview':
    $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

    $deleteResult = deleteReview($reviewId);

    $invId = $_SESSION['carData']['invId'];
    $prefix = "Add";
    $title = "Review";

    $vehicleInfo = getVehicleDetailsById($invId);
    $vehicleThumbs = getThumbnailsById($invId);
    $showThumbs = showThumbnails($vehicleThumbs);
    $vehicleDetails = showVehicleDetails($vehicleInfo);

    $getReviews = getReviewByInvId($invId);
    $reviewEntries = buildReviewsDisplay($getReviews, $invId, $prefix);

    if($deleteResult) {
      $_SESSION['message'] = '<p class="success">Review was successfully deleted.<?p>';
    } else{
      $_SESSION['message'] = '<p class="failed">Error: review not deleted. Try again.</p>';
    }

    include '../view/vehicle-detail.php';
    break;
  default:
    include '';
    break;
}