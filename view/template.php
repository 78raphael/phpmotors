<?php
/** 
 *    Template View
 */

  $root_snip = $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snip/';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/phpmotors/css/main.css" media="screen">
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
      <h1>Content Title Here</h1>
    </main>
    <footer>
      <?php require $root_snip . 'footer.php'; ?>
    </footer>
  </div>  
</body>
</html>