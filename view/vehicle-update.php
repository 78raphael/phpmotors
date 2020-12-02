<?php
/** 
 *    Vehicle-Update View
 */

if($_SESSION['loggedin'] === true && $_SESSION['clientData']['clientLevel'] > 1)  {

  $root_snip = $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snip/';

  $message = (isset($_SESSION['message'])) ? $_SESSION['message'] : "";

  /** 
   *    Classification List
   */
  $classList = '<select name="classificationId" id="classificationId">';
  $classList .= '<option value="" selected disabled>Select a Classification</option>';
  foreach($classificationsList as $class)
  {
    $classList .= "<option value='$class[classificationId]'";
    if(isset($classificationId)) {
      if($class['classificationId'] === $classificationId)
        $classList .= " selected ";
    }
    elseif(isset($invInfo['classificationId']))  {
      if($class['classificationId'] === $invInfo['classificationId']) {
        $classList .= " selected ";
      }
    }
    $classList .= ">".$class['classificationName']."</option>";
  }
  $classList .= '</select>';

  /**
   *    Set Title && H1 Elements
   */
  if(isset($invInfo['invMake']) && isset($invInfo['invModel']))  {
    $makeModel = "Modify $invInfo[invMake] $invInfo[invModel]";
  } 
  elseif(isset($invMake) && isset($invModel))  {
    $makeModel = "Modify $invMake $invModel";
  }

  /**
   *    Set input values
   */
  // Hidden invId Value
  if(isset($invInfo['invId'])) {
    $invIdVal = "value='$invInfo[invId]'";
  } elseif(isset($invId))  {
    $invIdVal = "value='$invId'";
  }
  
  // Make Value
  if(isset($invMake)) {
    $invMakeVal = "value='$invMake'";
  } elseif(isset($invInfo['invMake']))  {
    $invMakeVal = "value='$invInfo[invMake]'";
  } else {
    $invMakeVal = "";
  }

  // Model Value
  if(isset($invModel)) {
    $invModelVal = "value='$invModel'";
  } elseif(isset($invInfo['invModel']))  {
    $invModelVal = "value='$invInfo[invModel]'";
  } else {
    $invModelVal = "";
  }

  // Description Value
  if(isset($invDescription)) {
    $invDescriptionVal = $invDescription;
  } elseif(isset($invInfo['invDescription']))  {
    $invDescriptionVal = $invInfo['invDescription'];
  } else {
    $invDescriptionVal = "";
  }

  // Price Value
  if(isset($invPrice)) {
    $invPriceVal = "value='$invPrice'";
  } elseif(isset($invInfo['invPrice']))  {
    $invPriceVal = "value='$invInfo[invPrice]'";
  } else {
    $invPriceVal = "";
  }

  // Stock Value
  if(isset($invStock)) {
    $invStockVal = "value='$invStock'";
  } elseif(isset($invInfo['invStock']))  {
    $invStockVal = "value='$invInfo[invStock]'";
  } else {
    $invStockVal = "";
  }

  // Color Value
  if(isset($invColor)) {
    $invColorVal = "value='$invColor'";
  } elseif(isset($invInfo['invColor']))  {
    $invColorVal = "value='$invInfo[invColor]'";
  } else {
    $invColorVal = "";
  }

  // Image Value
  if(isset($invImage)) {
    $invImageVal = "value='$invImage'";
  } elseif(isset($invInfo['invImage']))  {
    $invImageVal = "value='$invInfo[invImage]'";
  } else {
    $invImageVal = "";
  }

  // Thumbnail Value
  if(isset($invThumbnail)) {
    $invThumbnailVal = "value='$invThumbnail'";
  } elseif(isset($invInfo['invThumbnail']))  {
    $invThumbnailVal = "value='$invInfo[invThumbnail]'";
  } else {
    $invThumbnailVal = "";
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/phpmotors/css/main.css" media="screen">
  <link rel="stylesheet" href="/phpmotors/css/vehicles.css" media="screen">
  <title><?=$makeModel?> | PHP Motors
  </title>
</head>
<body>
  <div id="container">
    <header>
      <?php require $root_snip . 'header.php'; ?>
    </header>
    <nav>
    <?php echo $navList; ?>
    </nav>
    <main>
      <h1><?=$makeModel?></h1>

      <div class="back-btn-div">
        <a class="btn" href="?">
          <div class="back-btn">Back</div>
        </a>
      </div>

<?php
  if(isset($message))  {
    echo $message;
  }
?>
      <div class="vehicle-form">
      <form method="POST" action="/phpmotors/vehicles/" id="modifyVehicleForm">

        <div>
          <label>Enter a Make</label>
        </div>
        <div>
          <input type="text" name="invMake" id="invMake" placeholder="ex. Ford, Chevy, Toyota" <?=$invMakeVal?> required>
        </div>
        <div>
          <label>Enter a Model</label>
        </div>
        <div>
          <input type="text" name="invModel" id="invModel" placeholder="ex. Escape, Tahoe, Prius" <?=$invModelVal?> required>
        </div>
        <div>
          <label>Enter a Description</label>
        </div>
        <div>
          <textarea name="invDescription" id="invDescription" required><?=$invDescriptionVal?></textarea>
        </div>
        <div>
          <label>Enter a Price</label>
        </div>
        <div>
          $<input type="text" name="invPrice" id="invPrice" placeholder="ex. 1234.56" <?=$invPriceVal?> required>
        </div>
        <div>
          <label>Enter number in Stock</label>
        </div>
        <div>
          <input type="text" name="invStock" id="invStock" placeholder="Use Whole Numbers" <?=$invStockVal?> required>
        </div>
        <div>
          <label>Enter Color</label>
        </div>
        <div>
          <input type="text" name="invColor" id="invColor" placeholder="ex. Red, Green, Yellow" <?=$invColorVal?> required>
        </div>
        <div>
          <label>Upload an Image</label>
        </div>
        <div>
          <input type="text" name="invImage" id="invImage" value="/phpmotors/images/vehicles/no-image.png" <?=$invImageVal?> required>
        </div>
        <div>
          <label>Upload a Thumbnail image</label>
        </div>
        <div>
          <input type="text" name="invThumbnail" id="invThumbnail" value="/phpmotors/images/vehicles/no-image.png" <?=$invThumbnailVal?> required>
        </div>
        <div>
          <label>Select a Classification</label>
        </div>
        <div>
          <?php echo $classList; ?>
        </div>
        <div class="submit">
          <input class="submit-btn btn" type="submit" name="submit" id="modifyVehicle" value="Update Vehicle">
          <input type="hidden" name="action" value="updateVehicle">
          <input type="hidden" name="invId" value="<?=$invIdVal?>">
        </div>
      </form>
      </div>
    </main>
    <footer>
      <?php require $root_snip . 'footer.php'; ?>
    </footer>
  </div>  
</body>
</html>
<?php
  unset($_SESSION['message']);
}
else {
  header('Location: /phpmotors/');
}