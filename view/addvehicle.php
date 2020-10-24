<?php
/** 
 *    Vehicles View
 */

 $root_snip = $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snip/';
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
          <input type="text" name="invMake" id="invMake" placeholder="ex. Ford, Chevy, Toyota">
        </div>
        <div>
          <label>Enter a Model</label>
        </div>
        <div>
          <input type="text" name="invModel" id="invModel" placeholder="ex. Escape, Tahoe, Prius">
        </div>
        <div>
          <label>Enter a Description</label>
        </div>
        <div>
          <textarea name="invDescription" id="invDescription"></textarea>
        </div>
        <div>
          <label>Enter a Price</label>
        </div>
        <div>
          $<input type="text" name="invPrice" id="invPrice" placeholder="ex. 1234.56">
        </div>
        <div>
          <label>Enter number in Stock</label>
        </div>
        <div>
          <input type="text" name="invStock" id="invStock" placeholder="Use Whole Numbers">
        </div>
        <div>
          <label>Enter Color</label>
        </div>
        <div>
          <input type="text" name="invColor" id="invColor" placeholder="ex. Red, Green, Yellow">
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