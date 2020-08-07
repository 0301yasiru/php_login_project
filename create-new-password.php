<?php require "includes/header.php"; ?> <!-- including the header file -->
    <main>
      <div class="col50" style="margin: 0 auto;">
        <div class="centered-content-ilastic">
          <?php
            if(isset($_GET['selector']) && isset($_GET['validator'])){
              //fetch data from the url
              $selector = $_GET['selector'];
              $token = $_GET['validator'];

              //now checking for errors
              if (ctype_xdigit($selector) && ctype_xdigit($token) && !empty($selector) && !empty($token)){
                ?>

                <h1>Reset your Password</h1>
                <p>You have reached reset password form sequrely please set up a new password.</p>

                <form class="col100" action="includes/password_reset.php" method="post">
                  <input type="hidden" name="selector" value="<?php echo $selector ?>">
                  <input type="hidden" name="token" value="<?php echo $token ?>">
                  <input class="col100" type="password" name="password" placeholder="Your new Password">
                  <input class="col100" type="password" name="re-password" placeholder="re-type Password">
                  <button class = "col100" type="submit" name="pwd-reset-submit">Reset my Password</button>
                </form>

                <?php
                  if(isset($_GET['error'])){
                    if($_GET['error'] == 'sqlerror'){
                      echo '<p class = "error_msg">Database Connection error occured</p>';
                    }
                  }elseif(isset($_GET['reset'])){
                    echo '<p class = "success_msg">An email sent successfully to your account</p>';
                  }
                 ?>

                <?php
              }//end of empty checking if statemtns else statemenr

            }//end of the main if statement to check the get method is settled
            else{

              //checking for error messages first
              if(isset($_GET['error'])){

                if ($_GET['error'] == 'emptyfields'){
                    echo "<p class='error_msg'>Please fill all the blanks!</p>";
                }elseif ($_GET['error'] == 'nomatch'){
                    echo "<p class='error_msg'>Passwords you entered do not match!</p>";
                }elseif ($_GET['error'] == 'expired'){
                    echo "<p class='error_msg'>The reset link we sent you is expired please get another link!</p>";
                }elseif ($_GET['error'] == 'forbidden'){
                    echo "<p class='error_msg'>This page is forbidden!</p>";
                }elseif ($_GET['error'] == 'token'){
                    echo "<p class='error_msg'>The url is not valid!</p>";
                }elseif ($_GET['error'] == 'sqlerror'){
                    echo "<p class='error_msg'>An error occured while connecting to the database!</p>";
                }else{
                  echo "<p class='error_msg'>This page is forbidden!</p>";
                }

              }elseif(isset($_GET['reset'])){
                echo "<p class='success_msg'>Your password reset succesfull</p>";
              }//end of reset success else staement

            }//end of errors and success showing main else statement

          ?>

        </div>
      </div>
    </main>

<?php require "includes/footer.php"; ?> <!-- including the footer file -->
