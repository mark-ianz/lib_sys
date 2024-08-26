<?php
  if (!isset ($_SESSION)) {
    session_start();
  }

  include_once ('./connection/connection.php');
  $conn = connect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    define('head', TRUE);
    include ('./include/head.php')
  ?>
  <link rel="stylesheet" href="./css/main-bottom.css">
  <link rel="stylesheet" href="./css/index.css">
</head>
<body>
  <?php
    define('header', TRUE);
    include ('./include/header.php')
  ?>
  <main>
    <?php
      define('main-top-nav', TRUE);
      include ('./include/main-top-nav.php');
    ?>
    <div class="main-bottom">
      <p class="subtitle bold blue">
        Welcome to Quezon City University Library
      </p>
      <div class="button-container">
        <a href="https://docs.google.com/forms/d/e/1FAIpQLSfsEcaKtuX8L_bCO0xVvaTS-FkdBaJLKvfNPEoH3v9X5eXKPA/closedform">
          <button>
            Borrower's Card Application
          </button>
        </a>
        <?php if (isset ($_SESSION ['email'])) { ?>
          <a href="./webpages/profile.php?id=<?php echo $_SESSION ['user-id'] ?>">
            <button>
              View Your Profile
            </button>
          </a>
        <?php } else { ?>
          <a href="./webpages/register.php">
            <button>
              Register
            </button>
          </a>
        <?php } ?>
      </div>
    </div>
  </main>
</body>
</html>