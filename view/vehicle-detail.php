<?php
/** 
 *    Individual Vehicle View
 */

// var_dump($_SESSION);

  $show = (isset($_SESSION['loggedin'])) ? true : false;

  $root_snip = $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snip/';

  $makeModel = $vehicleInfo['invMake'] . " " . $vehicleInfo['invModel'];

  $clientId = 24;
  $invId = 6;

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
  if(!$show)  {
?>
        <!-- Message when not logged in -->
        <p>To leave a review, please <a href="/phpmotors/accounts/?action=login" class="default-link">log in</a>.</p>
<?php
  } else {
?>
        <!-- Block when logged in -->
        <div class="reviewer-name">Client Name</div>
        <form id="review-form" method="POST" action="/phpmotors/reviews/">
          <div class="reviews-form-div">
            <div class="reviews-form-main">
              <div class="review-area">
                <textarea class="review-box" name="reviewText" id="reviewText" placeholder="Add review here"></textarea>
              </div>
            </div>
            <div class="reviews-form-side">
              <div class="submit">
                <input class="submit-btn btn" type="submit" name="submit" id="updateAccount" value="Add Review">
                <input type="hidden" name="action" value="addReview">
                <input type="hidden" name="clientId" value="<?=$clientId?>">
                <input type="hidden" name="invId" value="<?=$invId?>">
              </div>
            </div>
          </div>
        </form>
        <div class="reviews-div">
          <div class="reviews-main">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In congue consequat risus et maximus. Vestibulum ultrices a tortor in dapibus. Duis tellus risus, ornare vitae enim quis, imperdiet faucibus purus. Donec vel arcu sit amet turpis sagittis gravida a quis augue. Duis ac leo sed quam elementum eleifend eu in diam. Nam elementum semper turpis et vehicula. Pellentesque at consequat felis.
          </div>
          <div class="reviews-side">
            <span class="title-review">A.User : 2020-12-04 11:35:00</span>
            <div class="title-btns">
              <span class="edit-review"><button class="submit-btn">Edit</button></span>
              <span class="delete-review"><button>Delete</button></span>
            </div>
          </div>
        </div>
        <div class="reviews-div">
          <div class="reviews-main">
            Reviews are here.
          </div>
          <div class="reviews-side">
            <span class="title-review">B.User : 2020-12-02 15:03:00</span>
            <div class="title-btns">
              <span class="edit-review"><button>Edit</button></span>
              <span class="delete-review"><button>Delete</button></span>
            </div>
          </div>
        </div>
        <!-- End of Block -->
<?php
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
<?php
  // unset($_SESSION['message']);
// }
// else {
//   header('Location: /phpmotors/accounts/?action=login');
//   exit;
// }