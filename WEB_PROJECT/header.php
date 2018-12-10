<?php
  session_start();
  if(isset($_SESSION) && isset($_SESSION['payment_status']))
  {
    if($_SESSION['payment_status'] != "")
    {
      echo '<script>alert("'.$_SESSION["payment_status"].'");</script>';
      $_SESSION['payment_status'] = "";
    }
    unset($_SESSION['payment_status']);

  }
  if(isset($_GET['message']))
  {
    if($_GET['message'] != "")
    {
      $msg = $_GET['message'];
      echo '<script>alert("'.$msg.'");</script>';
    }
    $_GET['message'] = "";
    unset($_GET['message']);
  }
?>

<!DOCTYPE html>
<html>
<head>

  <title>S&S Packers Movers</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <!-- External CSS and JS -->
  <script type="text/javascript" src="external.js"></script>
  <link rel="stylesheet" type="text/css" href="index.css">

</head>

<body >

	<!--Navigation Bar Starts Here-->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <!-- Logo -->
    <a class="navbar-brand" href="index.php">
      <img src="images/logo.png" style="width:100px;height:60px;" class="d-inline-block"> S&S Packers & Movers
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Other menu options -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-left: 100px">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="#services">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="calculate_cost.php">Calculate Cost</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#reviews">Reviews</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact_us.php">Contact Us</a>
        </li>
      </ul>
      
      <!-- Login, Sign Up and Logout links-->
      <?php
        if(isset($_SESSION['username']))
        {
          echo '<form class="form-inline" method="get" action="logout.php">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item" style="margin: 5px">
                      <button class="btn btn-outline-primary" name="logout" style="color:#ccc;">Logout</button>
                    </li>
                  </ul>
                </form>';
        }
        else if(!isset($_SESSION['username']))
        {
          echo '<form class="form-inline">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item" style="margin: 5px">
                      <a class="btn btn-outline-primary" data-toggle="modal" data-target="#modalLoginForm" style="color:#ccc;">Login</a>
                    </li>
                    <li class="nav-item" style="margin: 5px">
                      <a class="btn btn-outline-primary" data-toggle="modal" data-target="#modalRegisterForm" style="color:#ccc;">Sign Up</a>
                    </li>
                  </ul>
                </form>';
        }
      ?>

      <!-- Modal form for Sign up. It pops up when sign up button on the navigation bar is clicked -->
      <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header text-center">
              <h4 class="modal-title w-100 font-weight-bold">Sign up</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <hr>
            <form method="post" action="register.php">
              <div class="modal-body mx-3">
                <div class="md-form mb-5">
                  <input class="form-control" name="name" placeholder="Name..." required><br>
                  <input class="form-control" name="email" type="email" placeholder="Email..." required><br>
                  <input class="form-control" name="password" type="password" placeholder="Password..." required><br>
                  <input class="form-control" name="cPassword" type="password" placeholder="Confirm Password..." required><br>
                </div>
              </div>
              <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-deep-orange" type="submit" name="submit">Sign up</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal form for Login. It pops when login link is clicked on the navigation bar -->
      <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header text-center">
              <h4 class="modal-title w-100 font-weight-bold">Login</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <hr>
            <form method="post" action="login.php">
              <div class="modal-body mx-3">
                <div class="md-form mb-5">
                  <input class="form-control" name="email" type="email" placeholder="Email..." required><br>
                  <input class="form-control" name="password" type="password" placeholder="Password..." required><br>
                </div>
              </div>
              <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-deep-orange" type="login" name="login">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      
    </div>
  </nav>
  <!-- Navigation Bar Ends Here -->