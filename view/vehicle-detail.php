<?php
/** 
 *    Individual Vehicle View
 */

  $root_snip = $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snip/';

  $makeModel = $vehicleInfo['invMake'] . " " . $vehicleInfo['invModel'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/phpmotors/css/main.css" media="screen">
  <link rel="stylesheet" href="/phpmotors/css/inventory.css" media="screen">
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
      <div class="main-details-div">
        <div class="details-div">
          <?=$vehicleDetails?>
        </div>
        <div class="thumb-div">
          <?=$showThumbs?>
        </div>
      </div>
    </main>
    <footer>
      <?php require $root_snip . 'footer.php'; ?>
    </footer>
  </div>  
</body>
</html>