<?php

require_once 'library/connections.php';
require_once 'model/main-model.php';
require_once 'library/functions.php';

buildNavBar();

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action){
  case 'something':
    include 'view/something.php';
    break;
  
  default:
   include 'view/home.php';
 }