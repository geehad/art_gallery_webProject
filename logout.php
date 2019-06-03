<?php
//session_destroy(); // Is Used To Destroy All Sessions
//Or
session_start();
if(isset($_SESSION['username']))
unset($_SESSION['username']);  //Is Used To Destroy Specified Session

//w 3ayza lw a2dr azwd message
if(session_destroy()) {
      header("Location: wel.php");
   }
   ?>