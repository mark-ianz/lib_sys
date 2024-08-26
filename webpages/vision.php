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
        VISION
      </p>
    </div>
    <div class="right">
      <div>
        <p>
          "We envision the QCU Library Online System as a pioneering platform that simplifies and enhances the student experience by providing easy and intuitive access to a comprehensive collection of available books. Our vision is to leverage innovative technologies, ensuring students can effortlessly view and explore the wealth of resources at their fingertips. By prioritizing user-friendly interfaces and seamless navigation, we aim to empower students with efficient and enjoyable methods to discover, access, and engage with our extensive library holdings."
        </p>
      </div>
    </div>
  </main>
</body>
</html> 