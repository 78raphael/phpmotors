<?php
/** 
 *    Login View
 */

  $root_snip = $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snip/';
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
<?php
  if(isset($message))  {
    echo $message;
  }
?>

      <form method="POST" action="/phpmotors/accounts/index.php">
        <div class="input-div">
          <div class="box-label"><label for="clientEmail">Email:</label></div>
          <div class="box"><input name="clientEmail" id="clientEmail" type="email"></div>
        </div>
        <div class="input-div">
          <div class="box-label">
            <label for="clientPassword">Password:</label>
          </div>
          <div class="box">
            <input name="clientPassword" id="clientPassword" type="password" required>
          </div>
        </div>

        <div class="signIn">
          <a href="?action=validate">
            <div class="signIn-btn btn">Sign In</div>
          </a>
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