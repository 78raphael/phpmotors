<?php
/** 
 *    Reviews Model
 */

/**
*   Get all Reviews for a signed in Client
*/
function getReviewsByClientId($clientId)
{
  $db = phpmotorsConnect();

  $stmt = $db->prepare('SELECT *, i.invMake, i.invModel FROM reviews r
  JOIN inventory i ON i.invId = r.invId
  WHERE r.clientId = :clientId');

  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();

  $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();

  return $reviews;
}

/**
*   Get all Reviews for an Inventory item
*/
function getReviewByInvId($invId)
{
  $db = phpmotorsConnect();

  $stmt = $db->prepare('SELECT r.reviewId, r.reviewText, r.reviewDate, r.invId, r.clientId, c.clientFirstname, c.clientLastname FROM reviews r
    JOIN clients c ON c.clientId = r.clientId
    WHERE invId = :invId
    ORDER BY r.reviewDate DESC');

  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();

  $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();

  return $reviews;
}

/**
*   Get a Review by Id
*/
function getReviewById($reviewId)
{
  $db = phpmotorsConnect();

  $stmt = $db->prepare('SELECT r.reviewId, r.reviewText, r.reviewDate, r.invId, r.clientId, c.clientFirstname, c.clientLastname FROM reviews r
    JOIN clients c ON c.clientId = r.clientId
    WHERE reviewId = :reviewId');

  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
  $stmt->execute();

  $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

  $stmt = $db->prepare('UPDATE reviews r
    SET r.reviewText = :reviewText
    WHERE r.reviewId = :reviewId');

  $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);

  $stmt->execute();

  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();

  return $rowsChanged;
}

/**
*   Delete a Review
*/
function deleteReview($reviewId)
{
  $db = phpmotorsConnect();

  $stmt = $db->prepare('DELETE FROM reviews
  WHERE reviewId = :reviewId');

  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);

  $stmt->execute();

  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();

  return $rowsChanged;
}