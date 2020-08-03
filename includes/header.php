<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="images/icon.png">
    <link rel="stylesheet" href="style/reset.css">
    <link rel="stylesheet" href="style/master.css">
    <title>login</title>
  </head>
  <body>

    <header>
      <nav class="nav-main-header">
        <a class="header-logo" href="#">
          Pooh & Yas
        </a>

        <ul>
          <li> <a href="#"> Home </a> </li>
          <li> <a href="#"> About me </a> </li>
          <li> <a href="#"> Contact Us </a> </li>
          <li> <a href="#"> Articles </a> </li>


          <div>


            <a class="header-signup" href="#">Sign Up</a>

            <form class="header-logout" action="includes/logout.php" method="post">
              <button type="submit" name="logout_submit"> Logout </button>
            </form>

            <form class="header-login" action="includes/login.php" method="post">
              <input type="text" name="userid" placeholder="Username/Email">
              <input type="password" name="password" placeholder="password">
              <button type="submit" name="login_submit"> Login </button>
            </form>

          </div>
        </ul>



      </nav>
    </header>
