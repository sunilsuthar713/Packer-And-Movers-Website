<!-- This script is executed when the user clicks on the link that he recieves in his mail.
  After the link is clicked, the user can use his account. This part is little buggy. Sometimes the user is able to login even without verifying. That bug would be corrected later. Mostly within a week.
-->
<?php
  function redirect() {
    header("Location: index.php");
    exit();
  }
  if (!isset($_GET['email']) || !isset($_GET['token'])) {
    redirect();
  }
  else {
    $con = new mysqli('localhost', 'webdev', 'root123', 'webproject');
    $email = $con->real_escape_string($_GET['email']);
    $token = $con->real_escape_string($_GET['token']);
    $sql = $con->query("SELECT email FROM accounts WHERE email='$email' AND token='$token' AND isEmailConfirmed=0");
    if ($sql->num_rows > 0)
    {
      $con->query("UPDATE accounts SET isEmailConfirmed=1, token='' WHERE email='$email'");
      echo 'Your email has been verified! You can log in now!';
    } else
    {
      redirect();
    }
  }
?>