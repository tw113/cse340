<?php

function phpmotorsConnect(){
  $server = 'mysql';
  $dbname= 'phpmotors';
  $username = 'iClient';
  $password = 'CLIENT_PASS'; 
  $dsn = "mysql:host=$server;dbname=$dbname";
  $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
 
  // Create the actual connection object and assign it to a variable
  try {
   $link = new PDO($dsn, $username, $password, $options);
   //echo 'Connection succesful!';
   return $link;
  } catch(PDOException $e) {
   header('Location: /phpmotors/view/500.php');
   exit;
  }
 }