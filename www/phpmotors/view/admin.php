<?php
  // Check if user is logged in. If not, send to home
  if(!$_SESSION['loggedin']) {
    header('Location: /phpmotors/index.php');
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
  <h1><?php echo $_SESSION['clientData']['clientFirstname'] . " " . $_SESSION['clientData']['clientLastname'] ?></h1>
  <div class="flex-container">
    <h2>You are logged in.</h2>
    <ul>
      <li><?php echo "First Name: " .  $_SESSION['clientData']['clientFirstname'] ?></li>
      <li><?php echo "Last Name: " .  $_SESSION['clientData']['clientLastname'] ?></li>
      <li><?php echo "Email: " .  $_SESSION['clientData']['clientEmail'] ?></li>
    </ul>
    <?php
      $clientLevel = (int)$_SESSION['clientData']['clientLevel'];
      if($clientLevel > 1) {
        echo "<a class='button' href='/phpmotors/vehicles/index.php'>Vehicle Management</a>";
      }
    ?>
  </div>
  <footer id="footer">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>