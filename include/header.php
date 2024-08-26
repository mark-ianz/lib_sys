<?php
  if (!defined('header')) {
    header("Location: /lib_sys/index.php");
  }
  $currentFile = $_SERVER['REQUEST_URI'];

  function generateNav ($currentFile, $navPath, $navName) {
    echo "<a";
      if (str_contains($currentFile, $navPath)) {
        echo " class=\"selected-nav\"";
      }
      echo " href=$navPath ?>
        <li>
          $navName
        </li>
      </a>
    ";
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="/lib_sys/css/header.css">
</head>

<body>
  <header>
    <div class="header-top">
      <a href="/lib_sys/index.php" class="header-top-logo">
        <img src="/lib_sys/images/logo/QCU_LOGO.png" class="logo-image">
        <p class="logo-text">
          Quezon City University Library System
        </p>
      </a>
      <div class="header-socials">
        <a href="https://www.facebook.com/qculibrary" class="socials">
          <img src="/lib_sys/images/fb-logo.png" alt="" class="socials-image">
        </a>
        <a href="https://twitter.com/QCULibrary" class="socials">
          <img src="/lib_sys/images/twitter-logo.png" alt="" class="socials-image">
        </a>
        <a href="https://instagram.com/QCULibrary" class="socials">
          <img src="/lib_sys/images/instagram-logo.png" alt="" class="socials-image">
        </a>
      </div>
    </div>
    <div class="header-bottom">
      <ul class="navs">
        <?php /* NAVS */
          generateNav($currentFile, "/lib_sys/index.php", "Home");
          if (isset ($_SESSION ['access']) && $_SESSION ['access'] == 'librarian') {
            generateNav($currentFile, "/lib_sys/webpages/add-books.php", "Add Books");
          }
          generateNav($currentFile, "/lib_sys/webpages/view-books.php", "View Books");
          generateNav($currentFile, "/lib_sys/webpages/mission.php", "Mission");
          generateNav($currentFile, "/lib_sys/webpages/vision.php", "Vision");
          generateNav($currentFile, "/lib_sys/webpages/library-hours.php", "Library Hours");
          generateNav($currentFile, "/lib_sys/webpages/contact-us.php", "Contact Us");
          if (isset ($_SESSION ['user-id'])) {
            $userID = $_SESSION ['user-id'];
            generateNav($currentFile, "/lib_sys/webpages/profile.php?id=$userID", "Profile");
            generateNav($currentFile, "/lib_sys/webpages/logout.php", "Logout");
          } else {
            generateNav($currentFile, "/lib_sys/webpages/login.php", "Login");
          }
        ?>
      </ul>
    </div>
  </header>
</body>

</html>