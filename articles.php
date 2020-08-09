<?php require 'includes/header.php' ?>
  <main>

  <?php
    if ($login){
    ?>

    <div class="col100">
      <div class="centered-content-ilastic">
        <h1>Welcome to QA section</h1>

        <p>Hello <?php echo $_SESSION['name']; ?> this is your Q and A section..... this page is
        not yet programmed well, so make sure your spelling is correct! Otherwise the program will
        return garbage.</p>

        <?php
          //first of all we should access the database so require the database handler
          require 'includes/dbh.php';


          $sql = "SELECT `marks` FROM `users` WHERE `uname` = '".$_SESSION['uname']."'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          $_SESSION['marks'] = $row['marks'];

         ?>

        <h3>Your Total is    <?php echo $_SESSION['marks'] ?>     Points.</h3>
      </div>
    </div>

    <?php
      if (isset($_GET['qa'])){
          if($_GET['qa'] == 'OK'){
            $message = "අන්නා හලිම හුලතල් බොලයක්නෙ මේ කෙල්ල. මේම මේම හලියට උත්තල දුන්නද ආ...උම්ම්ම්ම්ම්ම්ම්ම්ම්ම්ම්ම්ම්ම්ම්ම්මා.. කොකො දැන් උඩ යන්නි නැතුව ඊලග එක කලන්න බලන්න";
          }else{
            $message = "හප් හප් හප් හප්... දෙනව චටස් එකක් මන්. හලියට කලන්නයි කිව්වෙ දූප්...";
          }

          ?>

          <div class="col100">
            <div class="centered-content-ilastic">
              <p class='sinhla'> <?php echo $message; ?> </p>
            </div>
          </div>
          <?php
      }
    ?>



    <?php
      //this is the sql code for the sqldatabase
      $sql = "SELECT * FROM `q_a_users` WHERE `user_name` = ? AND `done` != 1";
      $stmt = mysqli_stmt_init($conn); //this is the mysql statemt

      if(!mysqli_stmt_prepare($stmt, $sql)){
          header("Location: ../index.php?error=sqlerror");
          exit();
      }//end of checking for sql errors
      else{
          mysqli_stmt_bind_param($stmt, 's', $_SESSION['uname']);
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);

          if($result -> num_rows > 0){
            //uestion counter will increment for a question
            $row = mysqli_fetch_assoc($result)
              ?>

              <div class="col100">
                <div class="q_box">
                  <p><?php echo $row['question']; ?> </p>
                  <form class="col100" action="includes/qa_result.php" method="post">
                    <input type="hidden" name="qid" value="<?php echo $row['Id']; ?>">
                    <input autocomplete="off" type="text" name="answer" placeholder="write your answer">
                    <button type="submit" name="ans_submit">GO</button>
                  </form>
                </div>
              </div>

            <?php

        }//end of if therre questions cheking if statement

      }//end of sql error checking if statements else statement

      mysqli_stmt_close($stmt);//closing the statement
      mysqli_close($conn);//closing connection tab
    ?>

    <?php
    }else{
      ?>

      <div class="col100">
        <div class="centered-content-ilastic">
          <h1>Welcome to QA section</h1>
          <p> Please login to view this page. If you don't have an account please Sign in</p>
        </div>
      </div>

      <?php
    }
  ?>

  </main>
<?php require 'includes/footer.php' ?>
