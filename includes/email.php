<?php
  session_start();

  /*this header variable contains header details of email*/
  $headers = "From: 0301lahiru@gmail.com; MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

  if(isset($_SESSION['uname'])){
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
  }else{
    $name = $_POST['first_name'];
    $email = $_POST['email'];
  }/*end of defining main variables in the code*/


  if (isset($_POST['message_submit'])){
    /*if user want to contac me he will use this case function*/
    $msg = "
      <!DOCTYPE html>
      <html lang=\"en\" dir=\"ltr\">
        <head>
          <meta charset=\"utf-8\">
          <title></title>
        </head>
        <body>
          <h1>".$_POST['subject']."</h1>
          <p>".$_POST['message']." </p> <br>
          <p>From: ".$name." (".$email.")<p>
        </body>
      </html>
    ";

    if(mail("0301yasiru@gmail.com", $_POST['subject'], $msg, $headers)){
        header("Location: ../contact_me.php?sending=success");
        exit();
    }else{
      header("Location: ../contact_me.php?sending=error");
      exit();
    }
  }/*end of use sent message main if statement*/
  else{
    header("Location: ../contact_me.php");
    exit();
  }/*end of main if tatements else statement*/
?>
