<?php
/** 
 *    Image Admin View
 */

  $root_snip = $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snip/';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/phpmotors/css/main.css" media="screen">
  <link rel="stylesheet" href="/phpmotors/css/i-manage.css" media="screen">
  <title>Image Management | PHP Motors</title>
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
      <h1>Image Management</h1>
<?php
if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
}
?>
      <p>Welcome to the Image Management Page. Select an option below.</p>
      <h2>Add New Vehicle Image</h2>
<?php
if (isset($message)) {
  echo $message;
} 
?>
      <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
        <label for="invId">Vehicle</label>
        <?php echo $prodSelect; ?>
        <fieldset>
          <label>Is this the main image for the vehicle?</label>
          <label for="priYes" class="pImage">Yes</label>
          <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
          <label for="priNo" class="pImage">No</label>
          <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
        </fieldset>
        <label>Upload Image:</label>
        <input type="file" name="file1">
        <input type="submit" class="regbtn" value="Upload">
        <input type="hidden" name="action" value="upload">
      </form>
      <hr>
      <h2>Existing Images</h2>
      <p class="notice">
        If deleting an image, delete the thumbnail too and vice versa.
      </p>
<?php
if (isset($imageDisplay)) {
  echo $imageDisplay;
} 
?>
    </main>
    <footer>
      <?php require $root_snip . 'footer.php'; ?>
    </footer>
  </div>  
</body>
</html>
<?php 
  unset($_SESSION['message']); 
?>