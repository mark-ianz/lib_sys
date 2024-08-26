<?php
  if (!isset ($_SESSION)) {
    session_start();
  }

  session_destroy();
  header("Location: /lib_sys/index.php")
?>