<?php

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';

buildNavBar();

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

switch ($action){
  case 'addClass':
    include '../view/add-classification.php';
    break;
  case 'addVehicle':
    include '../view/add-vehicle.php';
    break;
  case 'putClass':
    // Filter and store the data
    $classificationName = filter_input(INPUT_POST, 'classificationName');

    // Check for missing data
    if(empty($classificationName)){
      $message = '<p>Please provide information for all empty form fields.</p>';
      include '../view/add-classification.php';
      exit; 
    }

    // Send to vehicle model
    $addClassResult = addCarClassification($classificationName);

    // Check and report the result
    if($addClassResult === 1){
      header("Location: /phpmotors/vehicles/index.php");
      exit;
    } else {
      $message = "<p>Sorry, something went wrong, $classificationName was not added. Please try again.</p>";
      include '../view/add-classification.php';
      exit;
    }

    case 'putVehicle':
      // Filter and store the data
      $invMake = filter_input(INPUT_POST, 'invMake');
      $invModel = filter_input(INPUT_POST, 'invModel');
      $invDescription = filter_input(INPUT_POST, 'invDescription');
      $invImage = filter_input(INPUT_POST, 'invImage');
      $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
      $invPrice = filter_input(INPUT_POST, 'invPrice');
      $invStock = filter_input(INPUT_POST, 'invStock');
      $invColor = filter_input(INPUT_POST, 'invColor');
      $classificationId = filter_input(INPUT_POST, 'classificationId');

      // Check for missing data
      if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) 
                || empty($invThumbnail) || empty($invPrice) || empty($invStock) 
                || empty($invColor) || empty($classificationId)) {
        $message = '<p>Please provide information for all empty form fields.</p>';
        include '../view/add-vehicle.php';
        exit; 
      }

      // Send to vehicle model
      $addVehicleResult = addVehicleToInventory($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

      // Check and report the result
      if($addVehicleResult === 1) {
        $message = "<p class='success'>Success, You have added $invMake $invModel to the inventory.</p>";
        include '../view/add-vehicle.php';
        exit;
      } else {
        $message = "<p class='error'>Sorry, something went wrong, $invMake $invModel was not added. Please try again.</p>";
        include '../view/add-vehicle.php';
        exit;
      }

  default:
    include '../view/vehicle-management.php';
}