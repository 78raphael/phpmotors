<?php

/**
 *    Check submitted email is in the form for an email
 *      @param string
 */
function checkEmail($clientEmail)
{
  return filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
}

/**
 *    Check password fits requirements
 *      @param string
 *      - at least (1):
 *        - Digit
 *        - Special Character
 *        - Uppercase letter
 *      - at least 8 characters long
 */
function checkPassword($clientPassword)
{
  $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
  return preg_match($pattern, $clientPassword);
}

/**
 *    Create Navigation menu
 *      @param array
 */
function navList($classifications)
{
  $navList = '<ul class="nav-links">';
  $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors homepage'>Home</a></li>";

  foreach($classifications as $classification) 
  {
    $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
  }
  $navList .= '</ul>';

  return $navList;
}

/**
 *    Create Classification drop-down menu
 *      @param array
 */
function buildClassificationList($classifications)
{
  $classificationList = '<select name="classificationId" id="classificationList">';
  $classificationList .= '<option disabled selected>Choose a Classification</option>';

  foreach($classifications as $option)  {
    $classificationList .= "<option value='$option[classificationId]'>$option[classificationName]</option>";
  }

  $classificationList .= '</select>';

  return $classificationList;
}

/**
 *    Generate HTML for Vehicle Display view
 *      @param array
 */
function buildVehiclesDisplay($vehicles)
{
  $dv = '<ul id="inv-display">';

  foreach ($vehicles as $vehicle) {
    $dv .= "<li><a href='/phpmotors/vehicles/?action=showVehicle&Id=$vehicle[invId]' title='Display vehicle'>";
    $dv .= "<img src='$vehicle[imgPath]' title='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
    $dv .= '<hr>';
    $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
    $dv .= "<span>$ $vehicle[invPrice]</span>";
    $dv .= '</a></li>';
  }

  $dv .= '</ul>';
  return $dv;
}

/**
 *    Create Vehicle Details html to show
 *      @param array
 */
function showVehicleDetails($vehicleInfo)
{
  $vh = '<div class="vehicleContainer">';
  $vh .= "<div class='vh-image'><img class='car-image' src='$vehicleInfo[imgPath]' alt='Vehicle Image'></div>";
  $vh .= "<div class='vh-price'>Price: $$vehicleInfo[invPrice]</div>";
  $vh .= "<div class='vh-color'>Color: $vehicleInfo[invColor]</div>";
  $vh .= "<div class='vh-stock'>Number in Stock: $vehicleInfo[invStock]</div>";
  $vh .= "<div class='vh-description'>Description: $vehicleInfo[invDescription]</div>";

  $vh .= '</div>';

  return $vh;
}

/**
 *    Generate HTML for showing Thumbnail images
 *      @param array
 */
function showThumbnails($vehicleThumbs)
{
  $tn = '<ul id="thumbs">';

  foreach($vehicleThumbs as $thumb) {
    $tn .= "<li class='list-thumb'>";
    $tn .= "<img src='$thumb[imgPath]' alt='Image of $thumb[imgName]'>";
    $tn .= "</li>";
  }

  $tn .= '</ul>';
  
  return $tn;
}

/* * ********************************
*  Functions for working with images
* ********************************* */

/**
 *    Add "-tn" to the image file name
 */
function makeThumbnailName($image)
{
  $i = strrpos($image, '.');

  $image_name = substr($image, 0, $i);
  $ext = substr($image, $i);
  $image = $image_name . '-tn' . $ext;

  return $image;
}

/**
 *    Create HTML for displaying image
 */
function buildImageDisplay($imageArray) {
  $id = '<div id="image-display">';

  foreach ($imageArray as $image) {
    $id .= '<div class="image-div">';
    $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
    $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
    $id .= '</div>';
  }

  $id .= '</div>';

  return $id;
}

/**
 *    Build vehicles drop-down menu
 */
function buildVehiclesSelect($vehicles)
{
  $prodList = '<select name="invId" id="invId">';
  $prodList .= "<option>Choose a Vehicle</option>";

  foreach ($vehicles as $vehicle) {
    $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
  }

  $prodList .= '</select>';

  return $prodList;
}

/**
 *    Upload file to server
 */
function uploadFile($name)
{
  global $image_dir, $image_dir_path;

  if (isset($_FILES[$name])) {

    $filename = $_FILES[$name]['name'];
    if (empty($filename)) {
      return;
    }

    $source = $_FILES[$name]['tmp_name'];
    $target = $image_dir_path . '/' . $filename;

    move_uploaded_file($source, $target);
    processImage($image_dir_path, $filename);

    $filepath = $image_dir . '/' . $filename;

    return $filepath;
  }
}

/**
 *    Create new images at 200px & 500px sizes
 */
function processImage($dir, $filename)
{
  $dir = $dir . '/';
  $image_path = $dir . $filename;

  $image_path_tn = $dir.makeThumbnailName($filename);

  resizeImage($image_path, $image_path_tn, 200, 200);
  resizeImage($image_path, $image_path, 500, 500);
}

/**
 *    //
 */
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height)
{
  $image_info = getimagesize($old_image_path);
  $image_type = $image_info[2];

  switch ($image_type) {
    case IMAGETYPE_JPEG:
      $image_from_file = 'imagecreatefromjpeg';
      $image_to_file = 'imagejpeg';
      break;
    case IMAGETYPE_GIF:
      $image_from_file = 'imagecreatefromgif';
      $image_to_file = 'imagegif';
      break;
    case IMAGETYPE_PNG:
      $image_from_file = 'imagecreatefrompng';
      $image_to_file = 'imagepng';
      break;
    default:
      return;
  }

  $old_image = $image_from_file($old_image_path);
  $old_width = imagesx($old_image);
  $old_height = imagesy($old_image);
 
  $width_ratio = $old_width / $max_width;
  $height_ratio = $old_height / $max_height;
 

  if ($width_ratio > 1 || $height_ratio > 1) {

    $ratio = max($width_ratio, $height_ratio);
    $new_height = round($old_height / $ratio);
    $new_width = round($old_width / $ratio);

    $new_image = imagecreatetruecolor($new_width, $new_height);

    if ($image_type == IMAGETYPE_GIF) {
      $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
      imagecolortransparent($new_image, $alpha);
    }

    if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
      imagealphablending($new_image, false);
      imagesavealpha($new_image, true);
    }

    $new_x = 0;
    $new_y = 0;
    $old_x = 0;
    $old_y = 0;
    imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

    $image_to_file($new_image, $new_image_path);

    imagedestroy($new_image);
  } 
  else {
    $image_to_file($old_image, $new_image_path);
  }

  imagedestroy($old_image);
}

/* * ********************************
*  Functions for Reviews
* ********************************* */

/**
 *    Create HTML for all reviews
 */
function buildReviewsDisplay($reviewsArr, $invId, $prefix)
{
  $reviewsDisplay = "";

  if(!isset($_SESSION) || $_SESSION['loggedin'] == false)  {
    $reviewsDisplay .= '<p>To leave a review, please <a href="/phpmotors/accounts/?action=login" class="default-link">log in</a>.</p>';

  } else {
    $clientId = $_SESSION['clientData']['clientId'];
    $reviewsDisplay .= buildForm($clientId, $invId, $prefix);
  }

    foreach($reviewsArr as $review) {
      
      $reviewerName = substr($review['clientFirstname'], 0, 1) . ". " . $review['clientLastname'];
      // $reviewStamp = date("M. j, Y - g:i:s A", strtotime($review['reviewDate']));
      $reviewStamp = $review['reviewDate'];

      $reviewsDisplay .= "
        <div class='reviews-div'>
          <div class='reviews-main'>";
      $reviewsDisplay .= "$review[reviewText]<hr>$reviewStamp";

      $reviewsDisplay .= "</div>
          <div class='reviews-side'>
            <span class='title-review'>$reviewerName</span>
          </div>
        </div>";
    }


  return $reviewsDisplay;
}

/**
 *    Build HTML to edit review
 */
function buildEditReviewDisplay($reviewsArr, $invId, $prefix)
{
  $reviewsDisplay = "";
  $clientId = $_SESSION['clientData']['clientId'];

  if($_SESSION['loggedin'] == false || !isset($_SESSION))  {
    $reviewsDisplay = '<p>To leave a review, please <a href="/phpmotors/accounts/?action=login" class="default-link">log in</a>.</p>';
  } else {
    $reviewsDisplay .= buildForm($clientId, $invId, $prefix, $reviewsArr[0]['reviewText'], $reviewsArr[0]['reviewId']);
  }

  return $reviewsDisplay;
}

/**
 *    Build HTML for admin view client reviews
 */
function buildClientReviewsDisplay($reviewsData)
{
  $reviewsCount = count($reviewsData);

  $reviewsDisplay = "<div class='adminReviews'>";
  if( $reviewsCount == 0 || $reviewsCount == NULL )  {
    $reviewsDisplay .= "There are no reviews.";
    $reviewsDisplay .= "</div>";
    
    return $reviewsDisplay;
    exit;
  }

  foreach($reviewsData as $review)  {
    $reviewsDisplay .= "<div class='admin-review-title'><span class='review-title'>$review[invMake] $review[invModel]</span><span class='review-date'>$review[reviewDate]</span></div>";


    $reviewsDisplay .= "<div class='admin-review'>";
    $reviewsDisplay .= "<p>$review[reviewText]</p><hr>";

    $reviewsDisplay .= "<div class='admin-buttons'>
    <a href='/phpmotors/reviews/?action=editReview&reviewId=$review[reviewId]' title='Admin review edit button'>
    <div class='review-btn'>Edit</div>
    </a>";
    $reviewsDisplay .= " <a href='/phpmotors/reviews/?action=confirmDelete&reviewId=$review[reviewId]' title='Admin review delete button'>
    <div class='review-btn'>Delete</div>
    </a></div>";

    $reviewsDisplay .= "</div>";
  }

  $reviewsDisplay .= "</div>";

  return $reviewsDisplay;
}

/**
 *    Build HTML for form
 */
function buildForm($clientId, $invId, $prefix, $reviewText = '', $reviewId = 0) {
  switch($prefix) {
    case 'Add':
      $actionValue = 'addReview';
      $hiddenInputs = "<input type='hidden' name='clientId' value='$clientId'>
      <input type='hidden' name='invId' value='$invId'>";
      break;
    case 'Update':
      $actionValue = 'updateReview';
      $hiddenInputs = "<input type='hidden' name='reviewId' value='$reviewId'>";
      break;
    default:
      $actionValue = 'addReview';
      break;
  }

  return "<form id='review-form' method='POST' action='/phpmotors/reviews/'>
      <div class='reviews-form-div'>
        <div class='reviews-form-main'>
          <div class='review-area'>
            <textarea class='review-box' name='reviewText' id='reviewText' placeholder='Add review here' required>$reviewText</textarea>
          </div>
        </div>
        <div class='reviews-form-side'>
          <div class='submit'>
            <input class='submit-btn btn' type='submit' name='submit' id='submitBtn' value='$prefix Review'>
            <input type='hidden' name='action' value='$actionValue'>
            $hiddenInputs
          </div>
        </div>
      </div>
    </form>";
}