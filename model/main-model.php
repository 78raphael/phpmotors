<?php
/** 
 *    Main PHPmotors Model
 */

 function getClassifications() {
  $db = phpmotorsConnect();
  
  $stmt = $db->prepare('SELECT classificationName FROM carclassification ORDER BY classificationName ASC');
  $stmt->execute();

  $classifications = $stmt->fetchAll();
  $stmt->closeCursor();

  return $classifications;
}