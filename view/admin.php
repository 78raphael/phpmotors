<?php
/** 
 *    Admin View
 */

  if(!$_SESSION['loggedin'])  {
    header('Location: /phpmotors/');
    exit;
  }

  $root_snip = $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snip/';
  $clientData = $_SESSION['clientData'];

  $accountLink = '<p><a href="/phpmotors/accounts/?action=client-update">Update Account Information</a></p>';
  $inventoryLink = "";
  $vehicleLink = "";

  if($clientData['clientLevel'] > 1) {
    $vehicleLink = '<p><a href="/phpmotors/vehicles/">Vehicle Management</a></p>';
    $inventoryLink = '
    <section>
      <h2>Inventory Management</h2>
      <p>Click link to manage inventory.</p><p><a href="/phpmotors/accounts/?action=vehicle-update">Update Account Information</a></p>
    </section>';
  }

  $sessionMessage = (isset($_SESSION['message'])) ? $_SESSION['message'] : "";

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
    <?=$navList; ?>
    </nav>
    <main>
      <h1>Welcome <?=$clientData['clientFirstname'] . ' ' . $clientData['clientLastname']; ?></h1>
      <?=$sessionMessage?>
      <p>You are logged in.</p>
      <ul>
        <li>First Name: <?=$clientData['clientFirstname']; ?></li>
        <li>Last Name: <?=$clientData['clientLastname']; ?></li>
        <li>Email: <?=$clientData['clientEmail']; ?></li>
      </ul>
      <?=$vehicleLink;?>
      <section>
        <h2>Account Management</h2>
        <p>Click link to update account information.</p>
        <?=$accountLink;?>
      </section>
      <?=$inventoryLink;?>
    </main>
    <footer>
      <?php require $root_snip . 'footer.php'; ?>
    </footer>
  </div>  
</body>
</html>
<?php
  unset($_SESSION['message']);