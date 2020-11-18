<?php

$welcome = "";
$link = '<span><a href="/phpmotors/accounts/?action=login">My Account</a></span>';

if(isset($_SESSION['loggedin']))  {
  if($_SESSION['loggedin'] === true)  
  {
    $welcome = (isset($cookieFirstname)) ? "<span>Welcome $cookieFirstname</span>" : "";
    $link = '<span><a href="/phpmotors/accounts/?action=logout">Log Out</a></span>';
  }
}
?>
<div class="logo"><img src="/phpmotors/images/site/logo.png" alt="logo"></div>
<div class="myAccount">

<?=$welcome.$link;?>

</div>