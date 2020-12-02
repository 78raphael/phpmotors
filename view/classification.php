<?php
/** 
 *    Classification View
 */

  $root_snip = $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snip/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/phpmotors/css/main.css" media="screen">
  <link rel="stylesheet" href="/phpmotors/css/inventory.css" media="screen">
  <title><?=$classificationName?> Vehicles | PHP Motors, Inc.</title>
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
      <h1><?=$classificationName?> vehicles</h1>
      <div class="displayView">
<?php 
  if(isset($message)) {
    echo $message; 
  }
  if(isset($vehicleDisplay))  {
    echo $vehicleDisplay;
  } 
?>
      </div>
    </main>
    <footer>
      <?php require $root_snip . 'footer.php'; ?>
    </footer>
  </div>  
</body>
</html>