<?php
/** 
 *    Home View
 */

  $root_snip = $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snip/';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/phpmotors/css/main.css" media="screen">
  <link rel="stylesheet" href="/phpmotors/css/home.css" media="screen">
  <title>PHP Motors</title>
</head>
<body>
  <div id="container">
    <header>
      <?php require $root_snip . 'header.php'; ?>
    </header>
    <nav>
      <?php 
      // require $root_snip . 'nav.php';
        echo $navList;
      ?>
    </nav>

    <main>
      <h1>Welcome to PHP Motors</h1>
      <div class="pic">
        <span class="delorian"><img class="car" src="/phpmotors/images/delorean.jpg" alt="Delorean"></span>
        <div class="info">
          <h2>DMC Delorean</h2>
          <div class="info-list">
            <ul class="list">
              <li>3 Cup holders</li>
              <li>Superman doors</li>
              <li>Fuzzy Dice!</li>
            </ul>
          </div>
        </div>
        <span class="own-btn">
          <img class="btn" src="/phpmotors/images/site/own_today.png" alt="Own Today">
        </span>
      </div>
      <div class="review-upgrade-box">
        <div class="review-box">
          <h2>DMC Delorean Reviews</h2>
          <div class="review">
            <ul>
              <li>"So fast its almost like traveling in time." (4/5)</li>
              <li>"Coolest ride on the road." (4/5)</li>
              <li>"I'm feeling Marty McFly!" (5/5)</li>
              <li>"The most futuristic ride of our day." (4.5/5)</li>
              <li>"80's livin and I love it!" (5/5)</li>
            </ul>
          </div>
        </div>
        <div class="upgrades-box">
          <h2>Delorean Upgrades</h2>
          <div class="upgrades">
            <div class="select-upgrade">
              <div class="image-box">
                <img src="/phpmotors/images/upgrades/flux-cap.png" alt="Flux Capacitor">
              </div>
              <div class="box">
                Flux Capacitor
              </div>
            </div>
            <div class="select-upgrade">
              <div class="image-box">
                <img src="/phpmotors/images/upgrades/flame.jpg" alt="Flame Decal">
              </div>
              <div class="box">
                Flame Decal
              </div>
            </div>
            <div class="select-upgrade">
              <div class="image-box">
                <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="Bumper Sticker">
              </div>
              <div class="box">
                Bumper Stickers
              </div>
            </div>
            <div class="select-upgrade">
              <div class="image-box">
                <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="Hub Caps">
              </div>
              <div class="box">
                Hub Caps
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <footer>
      <?php require $root_snip . 'footer.php'; ?>
    </footer>
  </div>  
</body>
</html>