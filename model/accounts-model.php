<?php
/**
 *     Accounts Model
 * 
 *      New function will handle site registration
 */

/**
 *     Register client info
 */
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword)  
{
  $db = phpmotorsConnect();

  $stmt = $db->prepare('INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword) VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)');

  $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
  $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
  $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
  $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);

  $stmt->execute();

  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();

  return $rowsChanged;
}

/**
 *     Check submitted email against email in DB
 * 
 *      - Return boolean: 1 || 0
 */
function checkExistingEmail($clientEmail)
{
  $db = phpmotorsConnect();

  $stmt = $db->prepare('SELECT * FROM clients WHERE clientEmail = :clientEmail');
  $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
  $stmt->execute();

  $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
  $stmt->closeCursor();

  if(empty($matchEmail))  {
    return 0;
   } else {
    return 1;
   }
}

/**
 *     Get client info using email argument
 */
function getClient($clientEmail)
{
  $db = phpmotorsConnect();

  $stmt = $db->prepare("SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail");
  $stmt->bindValue(":clientEmail", $clientEmail, PDO::PARAM_STR);
  $stmt->execute();

  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  
  return $clientData;
}

/**
 *     Update client info by clientId
 */
function updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId)  
{
  $db = phpmotorsConnect();

  $stmt = $db->prepare('UPDATE clients 
    SET clientFirstname = :clientFirstname, 
        clientLastname = :clientLastname,
        clientEmail =  :clientEmail
    WHERE clientId = :clientId');

  $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
  $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
  $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

  $stmt->execute();

  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();

  return $rowsChanged;
}

/**
 *     Get client info by clientId
 */
function getClientById($clientId)
{
  $db = phpmotorsConnect();

  $stmt = $db->prepare("SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel FROM clients WHERE clientId = :clientId");
  $stmt->bindValue(":clientId", $clientId, PDO::PARAM_INT);
  $stmt->execute();

  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  
  return $clientData;
}

/**
 *     Update password by clientId
 */
function updatePassword($clientPassword, $clientId)  
{
  $db = phpmotorsConnect();

  $stmt = $db->prepare('UPDATE clients 
    SET clientPassword = :clientPassword
    WHERE clientId = :clientId');

  $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

  $stmt->execute();

  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();

  return $rowsChanged;
}