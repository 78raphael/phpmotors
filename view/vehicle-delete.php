<?php
/** 
 *    Vehicle-Delete View
 */

if($_SESSION['loggedin'] === true && $_SESSION['clientData']['clientLevel'] > 1)  {

  $root_snip = $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snip/';

  $message = (isset($_SESSION['message'])) ? $_SESSION['message'] : "";

  /**
   *    Set Title && H1 Elements
   */
  if(isset($invInfo['invMake']) && isset($invInfo['invModel']))  {
    $makeModel = "Delete $invInfo[invMake] $invInfo[invModel]";
  }

  /**
   *    Set input values
   */
  // Hidden invId Value
  if(isset($invInfo['invId'])) {
    $invIdVal = "value='$invInfo[invId]'";
  }
  
  // Make Value
  if(isset($invInfo['invMake']))  {
    $invMakeVal = "value='$invInfo[invMake]'";
  }

  // Model Value
  if(isset($invInfo['invModel']))  {
    $invModelVal = "value='$invInfo[invModel]'";
  }

  // Description Value
  if(isset($invInfo['invDescription']))  {
    $invDescriptionVal = $invInfo['invDescription'];
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/phpmotors/css/main.css" media="screen">
  <link rel="stylesheet" href="/phpmotors/css/vehicles.css" media="screen">
  <title><?=$makeModel?> | PHP Motors</title>
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
      <p class="warning">Confirm Vehicle Deletion. This is a permanent action.</p>

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
      <form method="POST" action="/phpmotors/vehicles/" id="deleteVehicleForm">

        <div>
          <label for="invMake">Vehicle Make</label>
        </div>
        <div>
          <input type="text" name="invMake" id="invMake" readonly <?=$invMakeVal?>>
        </div>
        <div>
          <label for="invModel">Vehicle Model</label>
        </div>
        <div>
          <input type="text" name="invModel" id="invModel" readonly <?=$invModelVal?>>
        </div>
        <div>
          <label for="invDescription">Vehicle Description</label>
        </div>
        <div>
          <textarea name="invDescription" id="invDescription" readonly><?=$invDescriptionVal?></textarea>
        </div>
        <div class="submit">
          <input class="submit-btn btn" type="submit" name="submit" id="deleteVehicle" value="Delete Vehicle">
          <input type="hidden" name="action" value="deleteVehicle">
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