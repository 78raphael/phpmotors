<?php
/** 
 *    Login View
 */

  $root_snip = $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snip/';
  
  $message = (isset($_SESSION['message'])) ? $_SESSION['message'] : "";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/phpmotors/css/main.css" media="screen">
  <link rel="stylesheet" href="/phpmotors/css/login.css" media="screen">
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
      <h1>Login</h1>
      
<?=$message?>

      <form method="POST" action="/phpmotors/accounts/">
        <div class="input-div">
          <div class="box-label"><label for="clientEmail">Email:</label></div>
          <div class="box"><input name="clientEmail" id="clientEmail" type="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required></div>
        </div>
        <div class="input-div">
          <div class="box-label">
            <label for="clientPassword">Password:</label>
          </div>
          <div class="box">
            <input name="clientPassword" id="clientPassword" type="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
          </div>
        </div>
        <div class="input-div">
          <span class="password-requirements">(At least 8 characters, 1 UPPERCASE letter, 1 number, and 1 special character)</span>
        </div>

        <div class="submit">
          <input class="" type="submit" name="submit" id="signIn" value="Sign In">
          <input type="hidden" name="action" value="validate">
        </div>
        <hr>
        <div class="register">
          <a href="?action=registration">
            <div class="register-btn btn">Create a New Account</div>
          </a>
        </div>
      </form>

    </main>
    <footer>
      <?php require $root_snip . 'footer.php'; ?>
    </footer>
  </div>  
</body>
</html>
<?php
  unset($_SESSION['message']);