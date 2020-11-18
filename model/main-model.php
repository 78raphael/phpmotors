<?php
/** 
 *    Main PHPmotors Model
 */

 /**
 *     Get all classification names only
 */
 function getClassifications() 
 {
  $db = phpmotorsConnect();
  
  $stmt = $db->prepare('SELECT classificationName FROM carclassification ORDER BY classificationName ASC');
  $stmt->execute();

  $classifications = $stmt->fetchAll();
  $stmt->closeCursor();

  return $classifications;
}