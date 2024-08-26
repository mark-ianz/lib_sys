<?php
  if (!isset ($_SESSION)) {
    session_start();
  }

  include_once ('../connection/connection.php');
  $conn = connect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    define('head', TRUE);
    include ('../include/head.php');
  ?>
</head>
<body>
  <?php
    define('header', TRUE);
    include ('../include/header.php')
  ?>
</body>
</html>