<?php

function getClassifications()
{
 // Create a connection object from the phpmotors connection function
 $db = phpmotorsConnect(); 
 // The SQL statement to be used with the database 
 $sql = 'SELECT classificationName, classificationId FROM carclassification ORDER BY classificationName ASC'; 
 // The next line creates the prepared statement using the phpmotors connection      
 $stmt = $db->prepare($sql);
 // The next line runs the prepared statement 
 $stmt->execute(); 
 // The next line gets the data from the database and 
 // stores it as an array in the $classifications variable 
 $classifications = $stmt->fetchAll(PDO::FETCH_KEY_PAIR); 
 // The next line closes the interaction with the database 
 $stmt->closeCursor(); 
 // The next line sends the array of data back to where the function 
 // was called (this should be the controller) 
 return $classifications;
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