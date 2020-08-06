<?php
  /*this header variable contains header details of email*/
  $headers = "From: 0301lahiru@gmail.com; MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

  if(isset($_POST['email_submit'])){
        /*this swtitch function will toggle between reset password and contact us*/
      //$_SESSION['reset_code'] = rand(10,1000000); /*this will generate a random number*/
      $random_digit = rand(10,1000000);

      $msg =
      "<!DOCTYPE html>
      <html lang='en' dir='ltr'>
        <head>
          <script type='text/javascript'>
            function myFunction() {
            /* Get the text field */
            var copyText = document.getElementById('myInput');

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/

            /* Copy the text inside the text field */
            document.execCommand('copy');

            alert('Copied the text: ' + copyText.value);
            }
          </script>
        </head>
        <body>
          <h1> Poolnis' Site </h1>
          <img src='https://media0.giphy.com/media/fwzp8fidy4nKoZGm5k/giphy.gif'>
          <p> You have been requested to reset your accounts password. In order to reset your password,
            plese enter this <b> 6 digit number </b>in the rederected page.</p>

            <!-- The text field -->
            <input readonly type='text' value='".$random_digit."' id='myInput'>
            <!-- The button used to copy the text -->
            <button onclick='myFunction()'>Copy text</button>
        </body>
      </html>
      ";

      mail($_SESSION['mail'], '<i>Reset</i>: Poolnis Site', $msg, $headers);
  }/*end of main submis checking if statement*/

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
          <p>From: ".$_POST['first_name']." (".$_POST['email'].")<p>
        </body>
      </html>
    ";

    mail("0301yasiru@gmail.com", $_POST['subject'], $msg, $headers);
    header("location: ../success.php");
  }
?>
