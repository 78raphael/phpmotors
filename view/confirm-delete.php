<?php
/** 
 *    Confirm Delete View
 */

  $root_snip = $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snip/';

  // var_dump('reviewId: ', $reviewId);
  // var_dump('reviewResults: ', $reviewResults);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/phpmotors/css/main.css" media="screen">
  <link rel="stylesheet" href="/phpmotors/css/confirm.css" media="screen">
  <title>PHP Motors</title>
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
      <h1>Confirm Delete</h1>
      <div class="confirm-div">
        <div class="confirm-text-div">
          <?=$reviewResults[0]['reviewText']?>
        </div>
      </div>
      <div class='confirmation-div'>
        <div class='confirm-submit'>
          <a href="/phpmotors/accounts/?action=admin" alt="Cancel delete button">  
            <button class='confirm-submit-btn' name='cancel-btn' id='cancelBtn'>Cancel</button>
          </a>
        </div>
        <div class='confirm-submit'>
          <a href="/phpmotors/reviews/?action=deleteReview&reviewId=<?=$reviewId?>" alt="Confirm delete button">
            <button class='confirm-submit-btn' name='confirm-btn' id='confirmBtn'>Confirm</button>
          </a>
        </div>
      </div>
      
    </main>
    <footer>
      <?php require $root_snip . 'footer.php'; ?>
    </footer>
  </div>  
</body>
</html>