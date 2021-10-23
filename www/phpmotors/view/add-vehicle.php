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
  <h1>Add a new Vehicle to the Inventory</h1>
  <form name="add-vehicle-form" method="post" action="/phpmotors/vehicles/index.php">
    <input name="invMake" id="invMake" type="text" placeholder="Make*">
    <input name="invModel" id="invModel" type="text" placeholder="Model*">
    <input name="invDescription" id="invDescription" type="text" placeholder="Description*">
    <label for="invImage">Choose Image Path:</label>
    <input name="invImage" id="invImage" type="text" placeholder="Image Path*" value="/phpmotors/images/no-image.png">
    <label for="invImage">Choose Thumbnail Path:</label>
    <input name="invThumbnail" id="invThumbnail" type="text" placeholder="Thumbnail Path*" value="/phpmotors/images/no-image.png">
    <input name="invPrice" id="invPrice" type="number" placeholder="Price*">
    <input name="invStock" id="invStock" type="text" placeholder="Stock*">
    <input name="invColor" id="invColor" type="text" placeholder="Color*">
    <label for="classificationId">Choose Vehicle Classification:</label>
    <select name="classificationId" id="classificationId">
      <?php 
        foreach ($classifications as $class => $id) {
          echo "<option value='$id'>$class</option>";
        }
      ?>
    </select>
    <input type="submit" name="submit" value="Submit">
    <input type="hidden" name="action" value="putVehicle">
  </form>
  <footer id="footer">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>