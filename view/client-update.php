<?php
/** 
 *    Client Update View
 */

  if(!$_SESSION['loggedin'])  {
    header('Location: /phpmotors/');
    exit;
  }

  $root_snip = $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snip/';

  if(isset($_SESSION['clientData']))  {
    $clientFirstname = $_SESSION['clientData']['clientFirstname'];
    $clientLastname = $_SESSION['clientData']['clientLastname'];
    $clientEmail = $_SESSION['clientData']['clientEmail'];
    $clientId = $_SESSION['clientData']['clientId'];
  }

  $clientMessage = (isset($_SESSION['clientMessage'])) ? $_SESSION['clientMessage'] : "";
  $passwordMessage = (isset($_SESSION['passwordMessage'])) ? $_SESSION['passwordMessage'] : "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/phpmotors/css/main.css" media="screen">
  <link rel="stylesheet" href="/phpmotors/css/account.css" media="screen">
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
      <div class="back-btn-div">
        <a class="btn" href="/phpmotors/accounts/?action=admin">
          <div class="back-btn">Back to Admin</div>
        </a>
      </div>
      <h1>Update Account Information</h1>
      <div>
        <p>Update your account information in this section</p>
        <?=$clientMessage?>
        <form method="POST" action="/phpmotors/accounts/" id="account-update">
          <p>
            <label for="clientFirstname">First Name:</label>
            <input type="text" class="" id="clientFirstname" name="clientFirstname" value="<?=$clientFirstname?>" required>
          </p>
          <p>
            <label for="clientLastname">Last Name:</label>
            <input type="text" class="" id="clientLastname" name="clientLastname" value="<?=$clientLastname?>" required>
          </p>
          <p>
            <label for="clientEmail">Email:</label>
            <input type="email" class="" id="clientEmail" name="clientEmail" value="<?=$clientEmail?>" required>
          </p>
          <div class="submit">
            <input class="submit-btn btn" type="submit" name="submit" id="updateAccount" value="Update Account">
            <input type="hidden" name="action" value="updateAccount">
            <input type="hidden" name="clientId" value="<?=$clientId?>">
          </div>
        </form>
      </div>
      <h1>Update Password</h1>
      <div>
        <?=$passwordMessage?>
        <form method="POST" action="/phpmotors/accounts/" id="change-password">
          <div>
            <div class="input-div">
              <p>Enter a new password.<br>This will change the previous password with the one submitted.</p>
            </div>
            <label for="clientPassword">Password:</label>
            <input type="password" class="" id="clientPassword" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
            <div class="input-div">
              <span class="password-requirements">(At least 8 characters, 1 UPPERCASE letter, 1 number, and 1 special character)</span>
            </div>
          </div>
          <div class="submit">
            <input class="submit-btn btn" type="submit" name="submit" id="changePassword" value="Change Password">
            <input type="hidden" name="action" value="changePassword">
            <input type="hidden" name="clientId" value="<?=$clientId?>">
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
  unset($_SESSION['clientMessage']);
  unset($_SESSION['passwordMessage']);