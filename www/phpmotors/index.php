<?php

require_once 'library/connections.php';
require_once 'model/main-model.php';

$classifications = getClassifications();

// var_dump($classifications);
//   exit;

// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";

foreach ($classifications as $classification) {
  $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}

$navList .= '</ul>';

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action){
  case 'login':
    include 'view/login.php';
    break;
  case 'register':
    include 'view/register.php';
    break;
  
  default:
   include 'view/home.php';
 }