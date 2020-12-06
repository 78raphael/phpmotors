<?php

$welcome = "";
$link = '<span><a href="/phpmotors/accounts/?action=login">My Account</a></span>';

if(isset($_SESSION['loggedin']))  {
  if($_SESSION['loggedin'] === true)  
  {
    $welcome = (isset($_SESSION['clientData'])) ? "<span><a href='/phpmotors/accounts/?action=admin' class='default-link'>Welcome " . $_SESSION['clientData']['clientFirstname'] . "</a></span>" : "";
    $link = '<span><a href="/phpmotors/accounts/?action=logout" class="default-link">Log Out</a></span>';
  }
}
?>
<div class="logo"><img src="/phpmotors/images/site/logo.png" alt="logo"></div>
<div class="myAccount">

<?=$welcome.$link;?>

</div>