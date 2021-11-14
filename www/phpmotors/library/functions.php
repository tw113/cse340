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
    $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($class)."' title='View our $class product line'>$class</a></li>";
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