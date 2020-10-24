<?php

function phpmotorsConnect()  
{
  $server = 'localhost';
  $db = 'phpmotors';
  $username = 'roboClient';
  $password = 'N8KWEYkza2QhR1rJ';
  $dsn = "mysql:host=$server;dbname=$db";
  $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

  try 
  {
    $link = new PDO($dsn, $username, $password, $options);
    return $link;
  } 
  catch(PDOException $e) 
  {
    header('LOCATION: /phpmotors/view/500.php');
    exit;
  }
}

// phpmotorsConnect();