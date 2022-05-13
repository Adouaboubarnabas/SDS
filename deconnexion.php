<?php

$_SESSION['email'] = $mail;
session_start();

  if(session_destroy())
  {
    header("Location: login.php");
  }
?>