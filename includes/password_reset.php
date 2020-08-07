<?php
  if (isset($_POST['pwd-reset-submit'])) {

    //first of all fetch data from the user form
    $selector = $_POST['selector'];
    $token = $_POST['token'];
    $password = $_POST['password'];
    $password_repeat = $_POST['re-password'];

    //now check for any error can be occured
    if (empty($selector) || empty($token) || empty($password) || empty($password_repeat)){
      header("Location: ../create-new-password.php?error=emptyfields");
      exit();
    }//end of checking for error messages
    elseif ($password !== $password_repeat){
      header("Location: ../create-new-password.php?error=nomatch");
      exit();
    }//end of password matching errors

    //now it is time to check if the time is expired in the Database
    $currentdate = date('U');
    //hence we are going to connect to the databse get the conn variables
    require 'dbh.php';
    $sql = "SELECT * FROM `pwdReset` WHERE `pwdResetSelector` = ? AND `pwdExpiration` >= ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../create-new-password.php?error=expired");
        exit();
    }//end of checking sql connection
    else{
      mysqli_stmt_bind_param($stmt, 'ss' , $selector, $currentdate);
      mysqli_stmt_execute($stmt);

      //and now we should fetch data from the database and proccess
      $result = mysqli_stmt_get_result($stmt); // fetching raw data

      //now checking for fetching every row to a variables
      //if there are no rows thow an error messages
      if(!$row = mysqli_fetch_assoc($result)){
        header("Location: ../create-new-password.php?error=forbidden");
        exit();
      }//end of empty row checking
      else{

        //hence the token inside the database is binary and encryped first of all we should convert hext token to encypted binary
        $binary_token = hex2bin($token);
        $token_match = password_verify($binary_token, $row['pwdResetToken']);

        //now if the token matches reset the passwird
        if(!$token_match){
          header("Location: ../create-new-password.php?error=token");
          exit();
        }//end of tiken doenst match erroro statement
        else{

          //in order to filter the user from the user table fetch the email
          $user_email = $row['pwdResetEmail'];

          $sql = "UPDATE `users` SET `pwd`= ? WHERE `email` = ?";
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);
          $stmt = mysqli_stmt_init($conn);

          if(!mysqli_stmt_prepare($stmt, $sql)){
              header("Location: ../create-new-password.php?error=sqlerror");
              exit();
          }//end of checking sql connection
          else{
            // now update the password
            mysqli_stmt_bind_param($stmt, 'ss' , $hashed_password, $user_email);
            mysqli_stmt_execute($stmt);

            //end now we should delete the the token and selecter in the table

            $sql = "DELETE FROM `pwdReset` WHERE `pwdResetEmail` = ?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../create-new-password.php?error=sqlerror");
                exit();
            }//end of checking sql connection
            else{
              //if there was no error just delete the reord
              mysqli_stmt_bind_param($stmt, 's', $user_email);
              mysqli_stmt_execute($stmt);
            }//end of  //end of checking sql connection if statementselse statemnt

            header("Location: ../create-new-password.php?reset=success");

          }//end of inserting else statenemt

        }//end of token doesnt match else statement

      }//end of no row errors else statement

    }//end of  //end of checking sql connection if statementselse statemnt

  }else{
    header("Location: ../index.php");
    exit();
  }//end of main if statements else statement
