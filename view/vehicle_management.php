<?php
/** 
 *    Vehicle Management View
 */

if($_SESSION['loggedin'] === true && $_SESSION['clientData']['clientLevel'] > 1)  {

  $root_snip = $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snip/';

  $message = (isset($_SESSION['message'])) ? $_SESSION['message'] : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/phpmotors/css/main.css" media="screen">
  <link rel="stylesheet" href="/phpmotors/css/vehicles.css" media="screen">
  <title>Vehicle Management</title>
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
      <h1>Vehicle Management</h1>
<?php
  if(isset($message)){
    echo $message;
  }
?>
      <div class="add-vehicle-div">
          <a class="lnk" href="?action=addvehicle">
            <div class="add-vehicle-btn">Add Vehicle</div>
          </a>
        </div>
        <div class="add-classification-div">
          <a class="lnk" href="?action=addclassification">
            <div class="add-classification-btn">Add Classification</div>
          </a>
        </div>
<?php
  if(isset($classificationList)){
    echo '<h2>Vehicles By Classification</h2>';
    echo '<p>Choose a classification to see those vehicles</p>';
    echo $classificationList;
  }
?>
      <noscript>
        <p><strong>JavaScript must be Enabled to use this page.</strong></p>
      </noscript>
      <table id="inventoryDisplay"></table>
    </main>
    <footer>
      <?php require $root_snip . 'footer.php'; ?>
    </footer>
  </div>  
</body>
<script src="../js/inventory.js"></script>
</html>
<?php
  unset($_SESSION['message']);
}
else {
  header('Location: /phpmotors/');
}