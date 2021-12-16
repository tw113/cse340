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
  <title><?php echo $vehicle['invMake'] . " " . $vehicle['invModel']; ?> | PHP Motors, Inc.</title>
</head>
<body>
  <header id="header">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
  </header>
  <nav id="navigation">
    <?php echo $navList; ?>
  </nav>
  <h1 hidden><?php echo $vehicle['invMake'] . " " . $vehicle['invModel'];?></h1>
  <?php if(isset($message)){
    echo $message; }
  ?>
  <div class="details-container">
    <div id="vehicle-imgs">
      <img <?php echo "src='$vehicle[imgPath]' alt='$vehicle[invMake] $vehicle[invModel]'" ?>>
      <div id="thumbnails">
        <?php echo $vehicleImageDisplay ?>
      </div>
    </div>
    <div id="vehicle-details">
      <h2 style="color: black"><?php echo $vehicle['invMake'] . " " . $vehicle['invModel'] ?></h2>
      <h2><span>$<?php echo number_format($vehicle['invPrice']) ?></span></h2>
      <p class="justify-left"><?php echo $vehicle['invDescription'] ?></p>
      <h6>Color: <?php echo $vehicle['invColor'] ?></h6>
      <h6>In Stock: <?php echo $vehicle['invStock'] ?></h6>
    </div>
  </div>
  <hr>
  <div class="reviews-container">
    <h2>Customer Reviews</h2>
    <?php 
      if($_SESSION['loggedin'] == False) { 
        echo "You must login to write a review.";
      } else {
        echo $writeReview;
      }

      if($clientReviews == False) { 
        echo "Be the first to write a review.";
      } else {
        echo $clientReviews;
      }
    ?>
  </div>
  <footer id="footer">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>