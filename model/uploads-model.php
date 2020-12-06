<?php
/** 
 *    Uploads Model
 */

/**
*   Insert images into DB:images
*     - Make a thumbnail image and also insert into DB
*/
function storeImages($imgPath, $invId, $imgName, $imgPrimary)
{
  $db = phpmotorsConnect();

  $stmt = $db->prepare('INSERT INTO images (invId, imgPath, imgName, imgPrimary) VALUES (:invId, :imgPath, :imgName, :imgPrimary)');

  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
  $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
  $stmt->bindValue(':imgPrimary', $imgPrimary, PDO::PARAM_INT);
  $stmt->execute();
      
  $imgPath = makeThumbnailName($imgPath);
  $imgName = makeThumbnailName($imgName);

  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
  $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
  $stmt->bindValue(':imgPrimary', $imgPrimary, PDO::PARAM_INT);
  $stmt->execute();

  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();

  return $rowsChanged;
}

/**
 *    Get all images from DB:images
 */
function getImages()
{
  $db = phpmotorsConnect();

  $stmt = $db->prepare('SELECT i.imgId, i.imgPath, i.imgName, i.imgDate, ii.invId, ii.invMake, ii.invModel FROM images i JOIN inventory ii ON i.invId = ii.invId');
  $stmt->execute();

  $imageArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();

  return $imageArray;
}

/**
 *    Destroy images from DB by Id
 */
function deleteImage($imgId)
{
  $db = phpmotorsConnect();

  $stmt = $db->prepare('DELETE FROM images WHERE imgId = :imgId');
  $stmt->bindValue(':imgId', $imgId, PDO::PARAM_INT);
  $stmt->execute();

  $result = $stmt->rowCount();
  $stmt->closeCursor();

  return $result;
}

/**
 *    Find image in DB with same image name
 */
function checkExistingImage($imgName)
{
  $db = phpmotorsConnect();

  $stmt = $db->prepare('SELECT imgName FROM images WHERE imgName = :name');
  $stmt->bindValue(':name', $imgName, PDO::PARAM_STR);
  $stmt->execute();

  $imageMatch = $stmt->fetch();
  $stmt->closeCursor();

  return $imageMatch;
}

/**
 *    Get thumbnail images from DB:images by Id
 */
function getThumbnailsById($invId)
{
  $db = phpmotorsConnect();

  $stmt = $db->prepare('SELECT i.imgId, i.imgPath, i.imgName, i.imgDate, ii.invId, ii.invMake, ii.invModel 
  FROM images i 
  JOIN inventory ii ON i.invId = ii.invId
  WHERE i.imgPath LIKE "%-tn%"
  AND ii.invId = :invId');
  $stmt->bindValue('invId', $invId, PDO::PARAM_INT);
  $stmt->execute();

  $imageArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();

  return $imageArray;
}