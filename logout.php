<?php
  session_start();
  if (isset($_SESSION["login"]) && $_SESSION["login"] === true){
    session_unset();
  }
  setcookie("login", false, time()-3600);
  setcookie("uid", "", time()-3600);
  setcookie("name", "", time()-3600);
  echo "<script>alert('You have logged out from the Banana Forum!');window.location.href='./index.php';</script>";
  die();
?>