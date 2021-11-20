<?php

function checkEmail($clientEmail){
 $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
 return $valEmail;
}

function checkPassword($clientPassword){
  $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
  return preg_match($pattern, $clientPassword);
 }

function buildNavBar()
{
  global $navList;
  global $classifications;
  
  $classifications = getClassifications();

  // var_dump($classifications);
  //   exit;

  // Build a navigation bar using the $classifications array
  $navList = '<ul>';
  $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";

  foreach ($classifications as $class => $id) {
    $navList .= "<li><a href='/phpmotors/vehicles/index.php?action=classification&classificationName=".urlencode($class)."' title='View our $class product line'>$class</a></li>";
  }

  $navList .= '</ul>';
}

// Build the classifications select list 
function buildClassificationList($classifications) { 
  global $classificationsList;
  $classificationList = '<select name="classificationId" id="classificationList">'; 
  $classificationList .= "<option>Choose a Classification</option>"; 
  foreach ($classifications as $class => $id) { 
   $classificationList .= "<option value='$id'>$class</option>"; 
  } 
  $classificationList .= '</select>'; 
  return $classificationList; 
}

function buildVehiclesDisplay($vehicles) {
  $dv = '<ul id="inv-display">';
  foreach ($vehicles as $vehicle) {
    $dv .= '<li>';
    $dv .= "<a href='/phpmotors/vehicles/index.php?action=vehicle&invId=$vehicle[invId]'>";
    $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
    $dv .= '<hr>';
    $dv .= "<h5>$vehicle[invMake] $vehicle[invModel]</h5>";
    $dv .= "<p>$$vehicle[invPrice]</p>";
    $dv .= '</a>';
    $dv .= '</li>';
  }
  $dv .= '</ul>';
  return $dv;
}