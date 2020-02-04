<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OSAO Online store</title>
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/png" href="img/favicon.png">
    <!--BOOTSTRAP 4 CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--ICONS FONT AWSOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--ICONS GOOGLE-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!--CSS-->
    <link href="style.css?rnd=132" rel="stylesheet" type="text/css">
    <!--BOOTSTRAP 4 JS-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!--JS script-->
    <script src="script.js"></script>
</head>
<body>

<?php
require "action/dbconn.php";

if(isset($_SESSION["idUser"])){
    $username = $_SESSION["nameUser"];
    $myProfile = 'Settings';
    $myProfileLink = 'user-profile.php';
    $myOrders = 'My orders';

    if( $_SESSION["idUser"] == $_SESSION["adminNumber"]){
      $username = 'Admin';
      $myProfile = 'Users';
      $myProfileLink = 'users.php';
      $myOrders = 'Orders';
    }

}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-custom">
  <a class="navbar-brand nav-title" href="index.php">OSAO |</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav w-100">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="gallery.php">Shop</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact-form.php">Contacts</a>
      </li>

<?php

if(isset($_SESSION["idUser"])){
?>
      <li id="right-align" class="nav-item dropdown ml-auto">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <span class="glyphicon glyphicon-user"></span><i class="material-icons">person</i> <?php echo $username; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right bg-custom"  aria-labelledby="navbarDropdown">
          <a class="dropdown-item dropdawn-dark" href="<?php echo $myProfileLink; ?>"><i class="material-icons">settings</i> <?php echo $myProfile; ?></a>
          <a class="dropdown-item dropdawn-dark" href="orders.php"><i class="material-icons">shopping_cart</i> <?php echo $myOrders; ?></a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item dropdawn-dark" href="comments.php"><i class="material-icons">forum</i> Comments</a>

        <form action="action/logout-exc.php" method="post" id="form-logout" class="form-inline">
        <button type="submit" name="logout-submit" class="btn btn-info btn-block">Logout</button>
        </form>       

        </div>
      </li>

<?php      }else{
  echo '<a href="index.php" type="submit" id="login-btn" class="btn btn-info ml-auto">Login</a>'; 
}


?>

    </ul>
  </div>


</nav>