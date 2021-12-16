<?php

// This is the reviews Model

function addReview($clientId, $invId, $reviewDate, $reviewText) {
  // Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();
  // The SQL statement
  $sql = 'INSERT INTO reviews (clientId, invId, reviewDate, reviewText)
      VALUES (:clientId, :invId, :reviewDate, :reviewText)';
  // Create the prepared statement using the phpmotors connection
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
  $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
  // Insert the data
  $stmt->execute();
  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged; 
}

// Get reviews by clientId 
function getReviewsByClientId($clientId) { 
  $db = phpmotorsConnect(); 
  $sql = ' SELECT * FROM reviews r INNER JOIN inventory i ON r.invId = i.invId WHERE clientId = :clientId'; 
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT); 
  $stmt->execute(); 
  $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  $stmt->closeCursor(); 
  return $inventory; 
}

// Get reviews by invId 
function getReviewsByinvId($invId) { 
  $db = phpmotorsConnect(); 
  $sql = ' SELECT reviewId, reviewText, reviewDate, invId, r.clientId, clientFirstname, clientLastname FROM reviews as r INNER JOIN clients as c ON r.clientId = c.clientId WHERE invId = :invId ORDER BY reviewId desc'; 
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT); 
  $stmt->execute(); 
  $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  $stmt->closeCursor(); 
  return $inventory; 
}

// Get reviews by reviewId 
function getReviewsByreviewId($reviewId) { 
  $db = phpmotorsConnect(); 
  $sql = ' SELECT * FROM reviews WHERE reviewId = :reviewId'; 
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT); 
  $stmt->execute(); 
  $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  $stmt->closeCursor(); 
  return $inventory; 
}

// Update review
function updateReview($reviewId, $reviewText) {
  // Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();
  // The SQL statement
  $sql = 'UPDATE reviews SET reviewText = :reviewText
          WHERE reviewId = :reviewId';
  // Create the prepared statement using the phpmotors connection
  $stmt = $db->prepare($sql);

  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
  $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);

  // Insert the data
  $stmt->execute();
  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged; 
}

// Delete review
function deleteReview($reviewId) {
  // Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();
  // The SQL statement
  $sql = $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged; 
}