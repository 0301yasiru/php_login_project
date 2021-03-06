<?php
session_start();
if (isset($_SESSION['uname'])){
  $login=true;
}else{
  $login=false;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="images/icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;700&family=Dancing+Script&family=Indie+Flower&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/reset.css">
    <link rel="stylesheet" href="style/master.css">
    <title>login</title>
  </head>
  <body>

    <header>
      <nav>
        <ul>
          <div class="main-header-logo">
            <img src='images/giphy.gif'>
          </div>

          <div class="main-header-links">
            <li> <a <?php  if($_SERVER['REQUEST_URI'] == '/php_login_project/index.php' || $_SERVER['REQUEST_URI'] == '/php_login_project/'){echo 'class="active_link"';} ?> href="index.php"> Home </a> </li>
            <li> <a <?php  if($_SERVER['REQUEST_URI'] == '/php_login_project/aboutme.php'){echo 'class="active_link"';} ?> href="aboutme.php"> About me </a> </li>
            <li> <a <?php  if($_SERVER['REQUEST_URI'] == '/php_login_project/contact_me.php'){echo 'class="active_link"';} ?> href="contact_me.php"> Contact Us </a> </li>
            <li> <a <?php  if($_SERVER['REQUEST_URI'] == '/php_login_project/articles.php'){echo 'class="active_link"';} ?> href="articles.php"> Articles </a> </li>
          </div>

          <div class='main-header-forms'>
            <?php
              if($login){
                echo '<p>'.$_SESSION['uname'].'</p>
                      <form class="header-logout" action="includes/logout.php" method="post">
                        <button type="submit" name="logout_submit"> Logout </button>
                      </form>';
              }else{
                echo '<form class="header-login" action="includes/login.php" method="post">
                        <input type="text" name="userid" placeholder="Username/Email">
                        <input type="password" name="password" placeholder="Password">
                        <button type="submit" name="login_submit"> Login </button>
                      </form>
                      <a class="header-signup" href="signup.php">Sign Up</a>';
              }

            ?>

          </div>
        </ul>

      </nav>
    </header>
