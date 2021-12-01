<?php
  session_start();
  if(isset($_POST['isLoggedOut'])){
    if(isset($_SESSION['isLogin'])){
      unset($_SESSION['isLogin']);
      header("Location: ../login.php");
    }
  }


?>