<?php
if (isset($_POST['login_submit'])) {
  //first of all require the dtabase dba_handlers
  require 'dbh.php';

  //fetching the data from the login forms
  $useridentity = $_POST['userid'];
  $password = $_POST['password'];

  //now we should check for errors
  if(empty($useridentity) || empty($password)){
    header("Location: ../index.php");
    exit();
  }//end of checking for empty emptyfields
  else{
    $sql = "SELECT * FROM `users` WHERE `uname` = ? OR `email` = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../index.php?error=sqlerror");
        exit();
    }//end of checking for sql errors
    else{
        mysqli_stmt_bind_param($stmt, 'ss', $useridentity, $useridentity);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if(!$row = mysqli_fetch_assoc($result)){
          header("Location: ../index.php?error=nouser");
          exit();
        }//end of checking if users exists
        else{
          //now rehash the password and check matching
          $pwd_check = password_verify($password, $row['pwd']);
          if(!$pwd_check){
            header("Location: ../index.php?error=wrongpwd");
            exit();
          }//end of checking PASSWORD
          elseif($pwd_check){

            //at this point all the errors are handled
            //then login the user
            session_start();
            $_SESSION['name'] = $row['name'];
            $_SESSION['uname'] = $row['uname'];
            $_SESSION['email'] = $row['email'];

            header("Location: ../index.php?login=success");

          }//end of chekcing password else statemenr

        }//end of checking user exests else statement

    }//end of the sql erorr checking else statement

  }//end of no error excep sql error else statement



}//end of main isset cheching if statement
else{
  header("Location: ../index.php");
  exit();
}//end of main if statements else statement
