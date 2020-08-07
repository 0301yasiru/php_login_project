<?php

if (isset($_POST['pwd-reset-submit'])) {

  //first of all we need database handler to connect to database
  require 'dbh.php';

  $user_email = $_POST['email']; //fetch user data from the date_create_from_format

  //now it is time to check for some odbc_errormsg
  if (empty($user_email)){
      header("Location: ../forgot_pwd.page.php?error=emptyfields");
      exit();
  }//end of checking empty error
  elseif(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
    header("Location: ../forgot_pwd.page.php?error=emailerror");
    exit();
  }//end of checking validate email address
  else{
    $sql = "SELECT * FROM `users` WHERE `email` = ?"; //this is the sql oci_free_descriptor
    $stmt = mysqli_stmt_init($conn); //creating the mysqli mssql_free_statement

    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../forgot_pwd.page.php?error=sqlerror");
      exit();
    }//end of checking for connection errors
    else{
      mysqli_stmt_bind_param($stmt, 's', $user_email);
      mysqli_stmt_execute($stmt);

      //and now we should fetch data from the database and proccess
      $result = mysqli_stmt_get_result($stmt); // fetching raw data

      //now checking for fetching every row to a variables
      //if there are no rows thow an error messages
      if(!$row = mysqli_fetch_assoc($result)){
        header("Location: ../forgot_pwd.page.php?error=nouser");
        exit();
      }//end of empty row checking
      else{

        //start with tokens
        $selector = bin2hex(random_bytes(8)); //generate a random hexadecimal pg_escape_bytea
        $token = random_bytes(32);

        //create the reset links url to send to the user
        $server = 'localhost:8080';
        $url = "http://$server/login_project/create-new-password.php?selector=$selector&validator=".bin2hex($token);

        //now set the expiration after 5 minutes
        $expire = date("U") + 300;// U format give the number of seconds since 1970

        $userEmail = $_POST["email"];

        $sql = "DELETE FROM `pwdReset` WHERE `pwdResetEmail` = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../forgot_pwd.page.php?error=sqlerror");
            exit();
        }//end of checking sql connection
        else{
          //if there was no error just delete the reord
          mysqli_stmt_bind_param($stmt, 's', $userEmail);
          mysqli_stmt_execute($stmt);
        }//end of  //end of checking sql connection if statementselse statemnt

        //now it is time to insert new selector and tokens
        $sql = "INSERT INTO `pwdReset`(`pwdResetEmail`, `pwdResetSelector`, `pwdResetToken`, `pwdExpiration`) VALUES(?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../forgot_pwd.page.php?error=sqlerror");
            exit();
        }//end of checking sql connection
        else{
          //if there was no error just delete the reord
          //hence the token is a very sensitive data we must encrypt it before storing to he database
          $hashed_token = password_hash($token, PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($stmt, 'ssss', $userEmail, $selector, $hashed_token, $expire);
          mysqli_stmt_execute($stmt);
          }//end of  //end of checking sql connection if statementselse statemnt

          //now that we done all the databse stuff so closing the connection
          mysqli_stmt_close($stmt);
          mysqli_close($conn);

          $subject = "Reset Password";
          /*this header variable contains header details of email*/
          $headers = "From: 0301lahiru@gmail.com; MIME-Version: 1.0\r\n";
          $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

          $msg = '<body>
                    <h1>Reset Your Password</h1>
                    <p>Hello, to reset your password just click on the link below. Then it would rederect you to password reset page.</p>
                    <a href="'.$url.'">'.$url.'</a>
                  </body>';

          mail($userEmail, $subject, $msg, $headers);

          header("Location: ../forgot_pwd.page.php?reset=success");

      }//end of sending mail else statement

    }//end of main sql error cheking else statement

  }//end of the if tatements of error handling

































}//end of main button pressed chekinf is mssql_free_statement
else{
  header("Location: ../index.php");
}//end of main else statement
