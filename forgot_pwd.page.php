<?php require "includes/header.php"; ?> <!-- including the header file -->
    <main>
      <div class="col50" style="margin: 0 auto;">
        <div class="centered-content-ilastic">
          <h1>Forgot Password?</h1>
          <p>Please enter your email for the account. An reset link will be sent to your account.</p>

          <form class="col100" action="includes/reset_pwd.php" method="post">
            <input class="col100" type="text" name="email" placeholder="E-mail Address">
            <button class = "col100" type="submit" name="pwd-reset-submit">Send Reset Link</button>
          </form>

          <?php
            if(isset($_GET['error'])){
              if($_GET['error'] == 'sqlerror'){
                echo '<p class = "error_msg">Database Connection error occured</p>';
              }elseif($_GET['error'] == 'emptyfields'){
                echo '<p class = "error_msg">Please Give your email</p>';
              }elseif($_GET['error'] == 'emailerror'){
                echo '<p class = "error_msg">The email you entered is not valid</p>';
              }elseif($_GET['error'] == 'nouser'){
                echo '<p class = "error_msg">The emmail you entered is not registered. please sign in first</p>';
              }
  
            }elseif(isset($_GET['reset'])){
              echo '<p class = "success_msg">An email sent successfully to your account</p>';
            }



           ?>

        </div>
      </div>
    </main>
<?php require "includes/footer.php"; ?> <!-- including the footer file -->
