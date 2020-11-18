<?php
/** 
 *    Vehicles View
 */

if($_SESSION['loggedin'] === true && $_SESSION['clientData']['clientLevel'] > 1)  {

 $root_snip = $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snip/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/phpmotors/css/main.css" media="screen">
  <link rel="stylesheet" href="/phpmotors/css/vehicles.css" media="screen">
  <title>Add Classification</title>
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
      <h1>Add Classification</h1>

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
      <form method="POST" action="/phpmotors/vehicles/index.php" id="addClassificationForm">

        <div>
          <label>Enter a new Classification</label>
        </div>
        <div>
          <input type="text" name="classificationName" id="classificationName" size="50" placeholder="ex. Coupe, Custom, Street" <?php if(isset($classificationName)){echo "value='$classificationName'";} ?> required>
        </div>
        <div class="submit">
          <input class="submit-btn btn" type="submit" name="submit" id="addClassification" value="Add Classifiction">
            <input type="hidden" name="action" value="addClass">
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
<?php
}
else {
  header('Location: /phpmotors/');
}