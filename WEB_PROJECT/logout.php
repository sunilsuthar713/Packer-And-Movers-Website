<!-- This script is executed when logout link is clicked in the home_page.php -->
<!-- it clears all the session variables -->
<?php
  if(isset($_GET['logout']))
  {
    session_start();
    session_unset();
    session_destroy();
    header("Location: index.php");
  }
?>