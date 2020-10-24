<?php
/**
 *     Accounts Model
 * 
 *      New function will handle site registration
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