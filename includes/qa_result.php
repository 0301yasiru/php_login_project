<?php

session_start();

if (isset($_POST['ans_submit'])){
  //first of all get the database handler
  require 'dbh.php';

  //fetching data from the user form
  $given_answer = trim(strtolower($_POST['answer']));
  $question_id = (int)$_POST['qid'];

  //now get the answer from the database
  $sql = "SELECT `answer` FROM `q_a_users` WHERE `id` = ?";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../articles.php?error=sqlerror");
      exit();
  }//end of checking for sql errors
  else{
      mysqli_stmt_bind_param($stmt, 's', $question_id);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      //fething the answer from the database and turn into lowercase
      $answer =trim(strtolower(mysqli_fetch_assoc($result)['answer']));

      if ($answer == $given_answer){
        $sql = "UPDATE `q_a_users` SET `done`= 1 WHERE `Id` = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "i", $question_id);
        mysqli_stmt_execute($stmt);

        $sql = "UPDATE `users` SET `marks`= ".($_SESSION['marks'] + 1)." WHERE `uname` = '".$_SESSION['uname']."'";
        mysqli_query($conn, $sql);

        header("Location: ../articles.php?qa=OK");
        exit();
      }else{
        header("Location: ../articles.php?qa=NO");
        exit();
      }

  }//end of connections else statement

  mysqli_close($conn); //closing the connection to the database
}//end of main isset if statements
else{
  header("Location: ../index.php");
  exit();
}//end of main else statement
