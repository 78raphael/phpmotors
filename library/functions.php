<?php

/**
 *     Check submitted email is in the form for an email
 */
function checkEmail($clientEmail)
{
  return filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
}

/**
 *     Check password fits requirements
 *      - at least (1):
 *        - Digit
 *        - Special Character
 *        - Uppercase letter
 *      - at least 8 characters long
 */
function checkPassword($clientPassword)
{
  $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
  return preg_match($pattern, $clientPassword);
}

/**
 *     Create Navigation menu
 */
function navList($classifications)
{
  $navList = '<ul class="nav-links">';
  $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors homepage'>Home</a></li>";

  foreach($classifications as $classification) 
  {
    $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
  }
  $navList .= '</ul>';

  return $navList;
}

/**
 *     Create Classification drop-down menu
 */
function buildClassificationList($classifications)
{
  $classificationList = '<select name="classificationId" id="classificationList">';
  $classificationList .= '<option disabled selected>Choose a Classification</option>';

  foreach($classifications as $option)  {
    $classificationList .= "<option value='$option[classificationId]'>$option[classificationName]</option>";
  }

  $classificationList .= '</select>';

  return $classificationList;
}

/**
 *    
 */
function buildVehiclesDisplay($vehicles)
{
  $dv = '<ul id="inv-display">';

  foreach ($vehicles as $vehicle) {
    $dv .= '<li>';
    $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
    $dv .= '<hr>';
    $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
    $dv .= "<span>$vehicle[invPrice]</span>";
    $dv .= '</li>';
  }

  $dv .= '</ul>';
  return $dv;
}