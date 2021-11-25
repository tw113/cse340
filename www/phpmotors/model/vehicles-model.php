<?php

// This is the Vehicles Model

function addCarClassification($classificationName) {
  // Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();
  // The SQL statement
  $sql = 'INSERT INTO carclassification (classificationName)
      VALUES (:classificationName)';
  // Create the prepared statement using the phpmotors connection
  $stmt = $db->prepare($sql);
  
  $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
  // Insert the data
  $stmt->execute();
  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged; 
}

function addVehicleToInventory($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId) {
  // Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();
  // The SQL statement
  $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId)
      VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';
  // Create the prepared statement using the phpmotors connection
  $stmt = $db->prepare($sql);
  
  $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
  $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
  $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
  $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
  $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
  $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
  $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
  $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);

  // Insert the data
  $stmt->execute();
  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged; 
}

// Get vehicles by classificationId 
function getInventoryByClassification($classificationId) { 
  $db = phpmotorsConnect(); 
  $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
  $stmt->execute(); 
  $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  $stmt->closeCursor(); 
  return $inventory; 
}

 // Get vehicle information by invId
function getInvItemInfo($invId) {
  $db = phpmotorsConnect();
  $sql = 'SELECT * FROM inventory WHERE invId = :invId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $invInfo;
}

function updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId) {
  // Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();
  // The SQL statement
  $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, 
	        invDescription = :invDescription, invImage = :invImage, 
	        invThumbnail = :invThumbnail, invPrice = :invPrice, 
	        invStock = :invStock, invColor = :invColor, 
	        classificationId = :classificationId WHERE invId = :invId';
  // Create the prepared statement using the phpmotors connection
  $stmt = $db->prepare($sql);
  
  $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
  $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
  $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
  $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
  $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
  $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
  $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
  $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

  // Insert the data
  $stmt->execute();
  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged; 
}

function deleteVehicle($invId) {
  // Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();
  // The SQL statement
  $sql = $sql = 'DELETE FROM inventory WHERE invId = :invId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged; 
}

function getVehiclesByClassification($classificationName) {
  $db = phpmotorsConnect();
  $sql = "SELECT * FROM inventory AS inv
          JOIN images AS img ON img.invId = inv.invId
          WHERE classificationId IN
          (SELECT classificationId FROM carclassification
          WHERE classificationName = :classificationName)
          AND img.imgName LIKE '%-tn%'
          AND img.imgPrimary = 1";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
  $stmt->execute();
  $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $vehicles;
}

// Get information for all vehicles
function getVehicles() {
	$db = phpmotorsConnect();
	$sql = 'SELECT invId, invMake, invModel FROM inventory';
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $invInfo;
}

// Get vehicle information and vehicle images by invId
function getInvItemInfoAndImages($invId) {
  $db = phpmotorsConnect();
  $sql = "SELECT * FROM inventory AS inv 
          JOIN images img ON img.invId = inv.invId
          WHERE inv.invId = :invId";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $invInfo;
}