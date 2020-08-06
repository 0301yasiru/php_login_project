<?php require "includes/header.php"; ?> <!-- including the header file -->
    <main>
      <div class="col60" style="margin: 0 auto;">
        <div class="centered-content-ilastic">
          <h1>Sign me up</h1>

          <p>
            Hello, If you want to unlok all the features in this web site plese join with me.
          </p><br>

          <form action="includes/signin.php" method="post" style="width: 97%;">
            <input class="col100" type="text" name="first_name" placeholder="Your Name"><br>
            <input class="col100" type="text" name="user_name" placeholder="User Name"><br>
            <input class="col100" type="text" name="email" placeholder="E-mail address"><br>
            <input class="col100" type="password" name="passwd" placeholder="Password"><br>
            <input class="col100" type="password" name="repasswd" placeholder="Password"><br>
            <button type="submit" name="signup_submit">Sign Up</button>
          </form>
        </div>
      </div>
    </main>
<?php require "includes/footer.php"; ?> <!-- including the footer file -->
