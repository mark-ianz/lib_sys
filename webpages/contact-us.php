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
  <link rel="stylesheet" href="../css/contact-us.css">
</head>
<body>
  <?php
    define('header', TRUE);
    include ('../include/header.php')
  ?>
  <main>
    <div class="main-content">
      <div class="mc-top">
        <img src="../images/logo/QCU_Logo.png" class="logo">
        <p class="title">
          Contact Us
        </p>
      </div>
      <div class="mc-bottom">
        <div class="contact">
          <img src="../images/png_gmail.webp" class="contact-logo">
          <a href="mailto:qculibrarysystem@gmail.com" class="default-anchor">
            <span class="text-underline">
              : qculibrarysystem@gmail.com
            </span>
          </a>
        </div>
        <div class="contact">
          <img src="../images/facebook-logo.png" class="contact-logo">
          <a href="https://www.facebook.com/qculibrary" target="_blank" class="default-anchor">
            <span class="text-underline">
              : QCU Library
            </span>
          </a>
        </div>
        <div class="contact">
          <img src="../images/phone-svgrepo-com.svg" class="contact-logo filter-green">
          <span class="text-underline">
            : 09299067084
          </span>
        </div>
      </div>
    </div>
  </main>
</body>
</html>