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
  <h1>Welcome to PHP Motors!</h1>
  <section id="page-container">
    <div id="page-landing">
      <div id="features">
        <h2>DMC Delorean</h2>
        <h3>3 Cup Holders</h3>
        <h3>Superman Doors</h3>
        <h3>Fuzzy Dice!</h3>
      </div>
      <div id="landing-img">
        <img src="/phpmotors/images/vehicles/delorean.jpg" alt="DMC Delorean Illustration"/>
      </div>
      <div id="landing-btn">
        <button><strong>Own Today</strong></button>
      </div>
    </div>
    <div id="reviews">
      <h4>DMC Delorean Reviews</h4>
      <ul>
        <li>"So fast it's almost like traveling in time." (4/5)</li>
        <li>"Coolest ride on the road." (4/5)</li>
        <li>"I'm feeling Marty McFly!." (5/5)</li>
        <li>"The most futuristic ride of our day." (4.5/5)</li>
        <li>"80's livin and I love it!." (5/5)</li>
      </ul>
    </div>
    <div id="upgrades">
      <h4>Delorean Upgrades</h4>
      <div id="upgrade-flex-container">
        <div class="upgrade-box">
          <img src="/phpmotors/images/upgrades/flux-cap.png" alt="Flux Capacitor for the DMC Delorean car"/>
          <a href="#">Flux Capacitor</a>
        </div>
        <div class="upgrade-box">
          <img src="/phpmotors/images/upgrades/flame.jpg" alt="Flame Decal for the DMC Delorean car"/>
          <a href="#">Flame Decal</a>
        </div>
        <div class="upgrade-box">
          <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="Bumper Sticker for the DMC Delorean Car"/>
          <a href="#">Bumper Sticker</a>
        </div>
        <div class="upgrade-box">
          <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="Hub Cap for the DMC Delorean car"/>
          <a href="#">Hub Cap</a>
        </div>
      </div>
    </div>
</section>
  <footer id="footer">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>