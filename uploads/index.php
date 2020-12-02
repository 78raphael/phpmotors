<?php
/** 
 *    Image Uploads Controller
 */

session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
require_once '../model/uploads-model.php';
require_once '../library/functions.php';

$classifications = getClassifications();
$navList = navList($classifications);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

$image_dir = '/phpmotors/images/vehicles';
$image_dir_path = $_SERVER['DOCUMENT_ROOT'] . $image_dir;

switch ($action) {
  case 'upload':

    $invId = filter_input(INPUT_POST, 'invId', FILTER_VALIDATE_INT);
    $imgPrimary = filter_input(INPUT_POST, 'imgPrimary', FILTER_VALIDATE_INT);

    $imgName = $_FILES['file1']['name'];
    $imageCheck = checkExistingImage($imgName);

    if($imageCheck) {
      $message = '<p class="warning">An image by that name already exists.</p>';
    }
    elseif (empty($invId) || empty($imgName)) {
      $message = '<p class="warning">You must select a vehicle and image file for the vehicle.</p>';
    } else {
      $imgPath = uploadFile('file1');
      var_dump($imgPath);
      $result = storeImages($imgPath, $invId, $imgName, $imgPrimary);

      if ($result) {
        $message = '<p class="success">The upload succeeded.</p>';
      } else {
        $message = '<p class="failed">Sorry, the upload failed.</p>';
      }
    }

    $_SESSION['message'] = $message;
    header('location: .');
    break;

  case 'delete':
    $filename = filter_input(INPUT_GET, 'filename', FILTER_SANITIZE_STRING);
    $imgId = filter_input(INPUT_GET, 'imgId', FILTER_VALIDATE_INT);

    $target = $image_dir_path . '/' . $filename;

    if (file_exists($target)) {
      $result = unlink($target); 
    }

    if ($result) {
      $remove = deleteImage($imgId);
    }

    if ($remove) {
      $message = "<p class='success'>$filename was successfully deleted.</p>";
    } else {
      $message = "<p class='failed'>$filename was NOT deleted.</p>";
    }

    $_SESSION['message'] = $message;
    header('location: .');

    break;
  default:
    $imageArray = getImages();

    if (count($imageArray)) {
      $imageDisplay = buildImageDisplay($imageArray);
    } else {
      $imageDisplay = '<p class="failed">Sorry, no images could be found.</p>';
    }

    $vehicles = getVehicles();
    $prodSelect = buildVehiclesSelect($vehicles);

    include '../view/image-admin.php';
    exit;
    break;
 }