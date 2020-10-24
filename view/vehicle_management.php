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
      <div class="add-vehicle-div">
          <a class="btn" href="?action=addvehicle">
            <div class="add-vehicle-btn">Add Vehicle</div>
          </a>
        </div>
        <div class="add-classification-div">
          <a class="btn" href="?action=addclassification">
            <div class="add-classification-btn">Add Classification</div>
          </a>
        </div>
    </main>
    <footer>
      <?php require $root_snip . 'footer.php'; ?>
    </footer>
  </div>  
</body>
</html>