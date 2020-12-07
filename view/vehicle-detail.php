<?php
/** 
 *    Individual Vehicle View
 */

// var_dump($_SESSION);
var_dump('GET REVIEWS', $getReviews);

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
  <link rel="stylesheet" href="/phpmotors/css/reviews.css" media="screen">
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
      <hr>
      <h2>Reviews</h2>
<?php
  if(isset($_SESSION['message'])) {
    echo $_SESSION['message'];
  }
?>
      <div class="reviews">
<?php
  echo $reviewEntries;
?>
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