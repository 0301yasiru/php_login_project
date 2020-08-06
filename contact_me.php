<?php require "includes/header.php"; ?> <!-- including the header file -->

<main>
  <div class="col60" style="margin: 0 auto;">
    <div class="centered-content-ilastic">
      <h1>Contact Me</h1>

      <p>
        Hello, If you want to contact with me for any reason please use the contact form below..
      </p><br>

      <form action="includes/email.php" method="post" style="width: 97%;">
        <?php
          if(!$login){
            echo '<input class="col100" type="text" name="first_name" placeholder="Your Name"><br>';
            echo '<input class="col100" type="text" name="email" placeholder="E-mail address"><br>';
          }
        ?>
        <input class="col100" type="text" name="subject" placeholder="Subject"><br>
        <textarea class="col100" name="message" placeholder="Your Message here"></textarea><br>
        <button type="submit" name="message_submit">Submit</button>
      </form>
    </div>
  </div>
</main>

<?php require "includes/footer.php"; ?> <!-- including the footer file -->
