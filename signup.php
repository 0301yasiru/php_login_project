<?php require "includes/header.php"; ?> <!-- including the header file -->
    <main>
      <div class="col60" style="margin: 0 auto;">
        <div class="centered-content-ilastic">
          <h1>Sign me up</h1>
            <?php
              if(isset($_GET['error'])){
                  if ($_GET['error'] == "emptyfields") {
                    echo "<p class='error_msg'> Fill all the fields!!! </p>";
                  }
                  elseif($_GET['error'] == "invalidemail"){
                    echo "<p class='error_msg'> E-mail you entered is invalid!!! </p>";
                  }
                  elseif($_GET['error'] == "uid"){
                    echo "<p class='error_msg'> User name you enterd is invalid!!!</p>";
                  }
                  elseif($_GET['error'] == "pwdmatch"){
                    echo "<p class='error_msg'> Two passwords doesnt match!!! </p>";
                  }
                  elseif($_GET['error'] == "sqlerror"){
                    echo "<p class='error_msg'> A connection error occured </p>";
                  }
                  elseif($_GET['error'] == "sameuser"){
                    echo "<p class='error_msg'> The user name you enterd is already taken </p>";
                  }
              }//end of the main error checking statement
              elseif(isset($_GET['signup'])){
                if($_GET['signup'] == 'success'){
                    echo "<p class='success_msg'> You signedup succesfully. </p>";
                }
              }//end of succes PDOStatement
              else{
                echo '<p>
                      Hello, If you want to unlok all the features in this web site plese join with me.
                    </p><br>


                    <form action="includes/signin.php" method="post" style="width: 97%;">
                      <input class="col100" type="text" name="first_name" placeholder="Your Name"><br>
                      <input class="col100" type="text" name="user_name" placeholder="User Name"><br>
                      <input class="col100" type="text" name="email" placeholder="E-mail address"><br>
                      <input class="col100" type="password" name="passwd" placeholder="Password"><br>
                      <input class="col100" type="password" name="repasswd" placeholder="Password"><br>
                      <button type="submit" name="signup_submit">Sign Up</button>
                    </form>';
              }
            ?>
        </div>
      </div>
    </main>
<?php require "includes/footer.php"; ?> <!-- including the footer file -->
