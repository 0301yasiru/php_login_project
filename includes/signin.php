<?php

if(isset($_POST["signup_submit"])){
  require 'dbh.php';

  //fetch data from the signup page
  $user_name = $_POST['first_name'];
  $user_id = $_POST['user_name'];
  $user_email = $_POST['email'];
  $password = $_POST['passwd'];
  $re_password = $_POST['repasswd'];

  if(empty($user_id) ||empty($user_name) || empty($user_email) ||empty($password) ||empty($re_password)){
    header("Location: ../signup.php?error=emptyfields&first_name=".$user_name."&user_name=".$user_id."&email=".$user_email);
    exit();
  }/*end of empty checking*/
  elseif(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
    header("Location: ../signup.php?error=invalidemail&first_name=".$user_name."&user_name=".$user_id);
    exit();
  }/*end of checking email*/
  elseif(!preg_match("/^[a-zA-Z0-9]*$/", $user_id)){
    header("Location: ../signup.php?error=uid&first_name=".$user_name."&email=".$user_email);
    exit();
  }/*end of checking user id error characters*/
  elseif ($password !== $re_password) {
    header("Location: ../signup.php?error=pwdmatch&first_name=".$user_name."&user_name=".$user_id."&email=".$user_email);
    exit();
  }/*end of checking password match*/

  /*use name already taken checking*/
  else{
    $sql = "SELECT `uname` FROM `users` WHERE `uname`=?"; //this is the sql code and the ? is a place placeholder
    $stmt = mysqli_stmt_init($conn); //and this is the statement define_syslog_variables
    //and now we are checking if the statement is failed then throw an date_get_last_errors

    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../signup.php?error=sqlerror");
      exit();
    }/*end of checking for database conncection errors*/
    else{
      mysqli_stmt_bind_param($conn, "s", $user_id); //bind the statement  with the user information
      mysqli_stmt_execute($stmt); //execute the information
      mysqli_stmt_store_result($stmt); //fetching the results from SQLiteDatabase

      if(mysqli_stmt_num_rows($stmt) > 0){
        header("Location: ../signup.php?error=sameuser");
        exit();
      } /*end of checking for same user name*/
      else{
        //at this point all the errorr are handled
        //no it is time to instert user data to the database
        $sql = "INSERT INTO `users`(`name`, `uname`, `email`, `pwd`, `marks`) VALUES(?,?,?,?, 0)";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
          header("Location: ../signup.php?error=sqlerror");
          exit();
        }/*end of checking for database conncection errors*/
        else{
          $hashed_password = password_hash($password, PASSWORD_DEFAULT); //hashing the password here
          mysqli_stmt_bind_param($stmt, "ssss", $user_name, $user_id, $user_email, $hashed_password);
          mysqli_stmt_execute($stmt);

          //at this point all the errors are handled
          //then login the user
          session_start();
          $_SESSION['name'] = $_POST['first_name'];
          $_SESSION['uname'] = $_POST['user_name'];
          $_SESSION['email'] = $_POST['email'];
          $_SESSION['marks'] = 0;


          header("Location: ../signup.php?signup=success");
          exit();
        }/*end of enterting data else statement*/

      }/*end of no error else statement*/

    }/*end of sql connection error checker else statement*/

  }/*end of same username error*/

  //Now we should close all the connections with the SQLDatabase
  //Not closing will not throw any error but website will use unncessary resources
  mysqli_stmt_close($stmt);
  mysqli_close($conn);

}/*main if statement ends*/

else{
  header("Location: ../signup.php");
  exit();
}/*end of else of main isset if statement*/
