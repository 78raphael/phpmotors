<?php
/** 
 *    Reviews Controller
 */

session_start();

require_once '../library/connections.php';
// require_once '../library/functions.php';
require_once '../model/reviews-model.php';
// require_once '../model/main-model.php';
// require_once '../model/vehicles-model.php';
// require_once '../model/uploads-model.php';



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
  // case 'editReview':
  //   include '';
  //   break;
  // case 'updateReview':
  //   include '';
  //   break;
  // case 'deleteReview':
  //   include '';
  //   break;
  // case '':
  //   include '';
  //   break;
  // case '':
  //   include '';
  //   break;
  // case '':
  //   include '';
  //   break;
  default:
    include '';
    break;
}