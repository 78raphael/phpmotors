<?php
/** 
 *    Vehicles Model
 */

  /**
   *     Grabs list of classifications from DB
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

  /**
   *     Grabs all inventory items
   */
  function getInventory()  
  {
    $db = phpmotorsConnect();

    $stmt = $db->prepare('SELECT * FROM inventory');
    $stmt->execute();

    $allInventory = $stmt->fetchAll();
    $stmt->closeCursor();

    return $allInventory;
  }

  /**
   *     INSERTS new classification name to DB
   */
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

  /**
  *     INSERTS vehicle and data into DB
  */
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

  /**
   *    Grabs all inventory by id
   */
  function getInvItemInfo($invId)
  {
    $db = phpmotorsConnect();

    $stmt = $db->prepare('SELECT * FROM inventory WHERE invId = :invId');
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();

    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $invInfo;
  }

  /**
   *    Grab all inventory items based on classificationId
   */
  function getInventoryByClassification($classificationId)
  {
    $db = phpmotorsConnect();

    $stmt = $db->prepare('SELECT * FROM inventory WHERE classificationId = :classificationId');
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->execute();

    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $inventory;
  }

  /**
   *    Update vehicle info
   */
  function updateVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $invId)
  {
    $db = phpmotorsConnect();

    $stmt = $db->prepare('UPDATE inventory 
      SET invMake = :invMake, 
          invModel = :invModel, 
          invDescription = :invDescription, 
          invImage = :invImage, 
          invThumbnail = :invThumbnail, 
          invPrice = :invPrice, 
          invStock = :invStock, 
          invColor = :invColor, 
          classificationId = :classificationId 
      WHERE invId = :invId');

    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
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

  /**
   *    Delete vehicle info
   */
  function deleteVehicle($invId)
  {
    $db = phpmotorsConnect();

    $stmt = $db->prepare('DELETE FROM inventory WHERE invId = :invId');

    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();

    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();

    return $rowsChanged;
  }

  /**
   *    Get vehicles by the classification name
   */
  function getVehiclesByClassification($classificationName, $isPrimary = 0)
  {
    $db = phpmotorsConnect();

    $stmt = $db->prepare('
    SELECT i.invId, i.invMake, i.invModel, i.invDescription, i.invPrice, i.invStock, i.invColor, i.classificationId, ii.imgPath
    FROM inventory i
    JOIN images ii ON ii.invId = i.invId
    WHERE i.classificationId 
    IN (
      SELECT classificationId 
      FROM carclassification 
      WHERE classificationName = :classificationName
    ) 
    AND ii.imgPath LIKE "%-tn%"
    AND ii.imgPrimary = :isPrimary;
    ');

    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->bindValue(':isPrimary', $isPrimary, PDO::PARAM_INT);
    $stmt->execute();

    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $vehicles;
  }

  /**
   *    Get vehicle info by Id
   */
  function getVehicleById($invId)  
  {
    $db = phpmotorsConnect();

    $stmt = $db->prepare('SELECT * FROM inventory WHERE invId = :invId');

    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();

    $vehicleInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $vehicleInfo;
  }

  /**
   *    Get vehicle info by Id (Refactor)
   */
  function getVehicleDetailsById($invId)  
  {
    $db = phpmotorsConnect();

    $stmt = $db->prepare('SELECT i.invId, i.invMake, i.invModel, i.invDescription, i.invPrice, i.invStock, i.invColor, ii.imgPath 
    FROM inventory i
    JOIN images ii ON ii.invId = i.invId 
    WHERE i.invId = :invId
    AND ii.imgPath NOT LIKE "%-tn%"');

    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();

    $vehicleInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $vehicleInfo;
  }

  /**
   *    Get info of all vehicles
   */
  function getVehicles()
  {
    $db = phpmotorsConnect();

    $stmt = $db->prepare('SELECT invId, invMake, invModel FROM inventory');
    $stmt->execute();

    $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $invInfo;
  }