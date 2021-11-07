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
  <h1>Register for an account</h1>
  <?php
    if (isset($message)) {
    echo $message;
    }
  ?>
  <form name="form" method="post">
    <input name="clientFirstname" id="clientFirstname" type="text" placeholder="First Name*" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required>
    <input name="clientLastname" id="clientLastname" type="text" placeholder="Last Name*" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required>
    <input name="clientEmail" id="clientEmail" type="email" placeholder="Email*" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required>
    <input name="clientPassword" id="clientPassword" type="password" placeholder="Password*" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
    <span class="password">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
    <input type="submit" name="submit" value="Submit">
    <input type="hidden" name="action" value="register">
  </form>
  <div id="sign-up-button">
    <h4>Already have an account? <a href="/phpmotors/accounts/index.php?action=login"><span>Login</span></a></h4>
  </div>
  <footer id="footer">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>