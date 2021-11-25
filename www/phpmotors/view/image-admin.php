<?php
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
  <title>Image Management</title>
</head>
<body>
  <header id="header">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
  </header>
  <nav id="navigation">
    <?php echo $navList; ?>
  </nav>
  <h1>Image Management</h1>
  <h2>Add New Vehicle Image</h2>
  <?php
  if (isset($message)) {
    echo $message;
  } ?>
  <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
    <label for="invItem">Vehicle</label>
      <?php echo $prodSelect; ?>
      <fieldset>
        <label>Is this the main image for the vehicle?</label>
        <label for="priYes" class="pImage">Yes</label>
        <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
        <label for="priNo" class="pImage">No</label>
        <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
      </fieldset>
    <label>Upload Image:</label>
    <input type="file" name="file1">
    <input type="submit" class="regbtn" value="Upload">
    <input type="hidden" name="action" value="upload">
  </form>
  <hr>
  <h2>Existing Images</h2>
  <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
  <?php
  if (isset($imageDisplay)) {
    echo $imageDisplay;
  } ?>
  <footer id="footer">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>
<?php unset($_SESSION['message']); ?>