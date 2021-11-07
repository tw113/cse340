<a href="/phpmotors/index.php"><img id="logo" src="/phpmotors/images/site/logo.png" alt="PHP Motors Logo"/></a>
<?php 
  if($_SESSION['loggedin']) {
    echo "<a href='/phpmotors/accounts/index.php?action=admin'><span>Welcome, " . 
    $_SESSION['clientData']['clientFirstname'] . "</span></a>";
    echo "<a href='/phpmotors/accounts/index.php?action=logout'>Logout</a>";
  } 
  else {
    echo "<a href='/phpmotors/accounts/index.php?action=login'>My Account</a>";
  }
?>