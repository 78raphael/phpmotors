<?php
/** 
 *    Vehicles Model
 */

  function getClassificationsList() 
  {
    $db = phpmotorsConnect();

    $stmt = $db->prepare('SELECT * FROM carclassification ORDER BY classificationName ASC');
    $stmt->execute();

    $allclassifications = $stmt->fetchall();
    $stmt->closeCursor();

    return $allclassifications;
  }

  function getInventory()  
  {
    $db = phpmotorsConnect();

    $stmt = $db->prepare('SELECT * FROM inventory');
    $stmt->execute();

    $allInventory = $stmt->fetchAll();
    $stmt->closeCursor();

    return $allInventory;
  }

  function setClassification($classificationName) 
  {
    $db = phpmotorsConnect();

    $stmt = $db->prepare("INSERT INTO carclassification (classificationName) VALUES (:classificationName)");

    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);

    $stmt->execute();

    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();

    return $rowsChanged;
  }

  function setVehicle($invMake, $invModel, $invDescription, $invPrice, $invStock, $invColor, $invImage, $invThumbnail, $classificationId)  
  {
    $db = phpmotorsConnect();

    $stmt = $db->prepare("INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId) VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)");

    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);

    $stmt->execute();

    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();

    return $rowsChanged;
  }