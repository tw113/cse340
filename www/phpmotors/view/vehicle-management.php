<?php
  // Check if user is logged in and correct level. If not, send to home
  if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
    header('Location: /phpmotors/index.php');
  }
  if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/phpmotors/css/style_.css" media="screen">
  <link rel="stylesheet" href="/phpmotors/css/style_large.css" media="screen">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono&display=swap" rel="stylesheet">
  <title>PHP Motors</title>
</head>
<body>
  <header id="header">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
  </header>
  <nav id="navigation">
    <?php echo $navList; ?>
  </nav>
  <?php
    if (isset($message)) {
    echo $message;
    }
  ?>
  <h1>Vehicle Management</h1>
  <div class="btn-container">
    <a class="btn" href="/phpmotors/vehicles/index.php?action=addClass">Add Classification</a>
    <a class="btn" href="/phpmotors/vehicles/index.php?action=addVehicle">Add Vehicle</a>
  </div>
  <?php
    // if (isset($message)) { 
    // echo $message; 
    // } 
    if (isset($classificationList)) { 
    echo '<h2>Vehicles By Classification</h2>'; 
    echo '<p>Choose a classification to see those vehicles</p>'; 
    echo $classificationList; 
    }
  ?>
  <noscript>
    <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
  </noscript>
  <table id="inventoryDisplay"></table>
  <footer id="footer">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
  <script src="../javascript/inventory.js"></script>
</body>
</html>
<?php unset($_SESSION['message']); ?>