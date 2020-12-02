<?php
/** 
 *    Vehicles View
 */
if($_SESSION['loggedin'] === true && $_SESSION['clientData']['clientLevel'] > 1)  {

 $root_snip = $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snip/';

/** 
 *    Vehicles List
 */
$classList = '<select name="classificationId" id="classificationId">';
$classList .= '<option value="" selected disabled>Select a Vehicle</option>';
foreach($classificationsList as $class)
{
  $classList .= "<option value='".$class['classificationId']."'";
  if(isset($classificationId)) {
    if($class['classificationId'] === $classificationId)
      $classList .= " selected ";
  }
  $classList .= ">".$class['classificationName']."</option>";
}
$classList .= '</select>';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/phpmotors/css/main.css" media="screen">
  <link rel="stylesheet" href="/phpmotors/css/vehicles.css" media="screen">
  <title>Add Vehicle</title>
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
      <h1>Add Vehicle</h1>

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
      <form method="POST" action="/phpmotors/vehicles/index.php" id="addVehicleForm">

        <div>
          <label>Enter a Make</label>
        </div>
        <div>
          <input type="text" name="invMake" id="invMake" placeholder="ex. Ford, Chevy, Toyota" <?php if(isset($invMake)){echo "value='$invMake'";} ?> required>
        </div>
        <div>
          <label>Enter a Model</label>
        </div>
        <div>
          <input type="text" name="invModel" id="invModel" placeholder="ex. Escape, Tahoe, Prius" <?php if(isset($invModel)){echo "value='$invModel'";} ?> required>
        </div>
        <div>
          <label>Enter a Description</label>
        </div>
        <div>
          <textarea name="invDescription" id="invDescription" required><?php if(isset($invDescription)){echo $invDescription;} ?></textarea>
        </div>
        <div>
          <label>Enter a Price</label>
        </div>
        <div>
          $<input type="text" name="invPrice" id="invPrice" placeholder="ex. 1234.56" <?php if(isset($invPrice)){echo "value='$invPrice'";} ?> required>
        </div>
        <div>
          <label>Enter number in Stock</label>
        </div>
        <div>
          <input type="text" name="invStock" id="invStock" placeholder="Use Whole Numbers" <?php if(isset($invStock)){echo "value='$invStock'";} ?> required>
        </div>
        <div>
          <label>Enter Color</label>
        </div>
        <div>
          <input type="text" name="invColor" id="invColor" placeholder="ex. Red, Green, Yellow" <?php if(isset($invColor)){echo "value='$invColor'";} ?> required>
        </div>
        <div>
          <label>Upload an Image</label>
        </div>
        <div>
          <input type="text" name="invImage" id="invImage" value="/phpmotors/images/vehicles/no-image.png" <?php if(isset($invImage)){echo "value='$invImage'";} ?> required>
        </div>
        <div>
          <label>Upload a Thumbnail image</label>
        </div>
        <div>
          <input type="text" name="invThumbnail" id="invThumbnail" value="/phpmotors/images/vehicles/no-image.png" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} ?> required>
        </div>
        <div>
          <label>Select a Classification</label>
        </div>
        <div>
          <?php echo $classList; ?>
        </div>
        <div class="submit">
          <input class="submit-btn btn" type="submit" name="submit" id="addVehicle" value="Add Vehicle">
          <input type="hidden" name="action" value="addCar">
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
}
else {
  header('Location: /phpmotors/');
}