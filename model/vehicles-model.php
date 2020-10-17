<?php
/** 
 *    Vehicles Model
 */

 function getClassificationsList() {
   $db = phpmotorsConnect();

   $stmt = $db->prepare('SELECT * FROM carclassification ORDER BY classificationName ASC');
   $stmt->execute();

   $allclassifications = $stmt->fetchall();
   $stmt->closeCursor();

   return $allclassifications;
 }

 function getInventory()  {
   $db = phpmotorsConnect();

   $stmt = $db->prepare('SELECT * FROM inventory');
   $stmt->execute();

   $allInventory = $stmt->fetchAll();
   $stmt->closeCursor();

   return $allInventory;
 }