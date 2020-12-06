<?php
/** 
 *    Reviews Model
 */

/**
*   Get all Reviews for a signed in Client
*/
function getReviewByClientId($clientId)
{
  $db = phpmotorsConnect();

  $stmt = $db->prepare('SELECT * FROM reviews WHERE clientId = :clientId');

  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();

  $reviews = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();

  return $reviews;
}

/**
*   Get all Reviews for an Inventory item
*/
function getReviewByInvId($invId)
{
  $db = phpmotorsConnect();

  $stmt = $db->prepare('SELECT * FROM reviews WHERE invId = :invId');

  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();

  $reviews = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();

  return $reviews;
}

/**
*   Get a Review by Id
*/
function getReviewById($reviewId)
{
  $db = phpmotorsConnect();

  $stmt = $db->prepare('SELECT * FROM reviews WHERE reviewId = :reviewId');

  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
  $stmt->execute();

  $reviews = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();

  return $reviews;
}

/**
*   Insert a Review
*/
function storeReview($reviewText, $invId, $clientId)
{
  $db = phpmotorsConnect();

  $stmt = $db->prepare('INSERT INTO reviews (reviewText, invId, clientId) VALUES (:reviewText, :invId, :clientId)');

  $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();

  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();

  return $rowsChanged;
}

/**
*   Update a Review
*/
function updateReview($reviewText, $reviewId)
{
  $db = phpmotorsConnect();

  $stmt = $db->prepare('UPDATE reviews 
    SET reviewText = :reviewText
    WHERE invId = :invId');

  $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

  $stmt->execute();

  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();

  return $rowsChanged;
}

/**
*   Delete a Review
*/
function deleteReview()
{
  //
}