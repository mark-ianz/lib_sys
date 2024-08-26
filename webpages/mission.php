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
  <link rel="stylesheet" href="../css/mission-vission.css">
</head>
<body>
  <?php
    define('header', TRUE);
    include ('../include/header.php')
  ?>
  <main>
    <div class="left">
      <img src="../images/logo/QCU_Logo.png" class="body-logo">
      <p class="subtitle text-align-center white">
        Quezon City University
        <br> Library System
      </p>
      <p class="title white">
        MISSION
      </p>
    </div>
    <div class="right">
      <div>
        <p>
          "To enhance the student academic experience by providing easy access to a diverse range of books through an innovative and user-friendly online platform. We are dedicated to fostering a culture of exploration, learning, and research, utilizing cutting-edge technologies to create a seamless and enjoyable experience for students to discover and engage with our extensive library resources."
        </p>
      </div>
    </div>
  </main>
</body>
</html> 