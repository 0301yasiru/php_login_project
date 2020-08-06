<?php
session_start(); //start the session before close

session_unset(); //unsettig all the session variables
session_destroy(); //destroying the session_start

header("Location: ../index.php");
