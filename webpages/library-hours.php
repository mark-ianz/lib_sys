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
  <link rel="stylesheet" href="../css/library-hours.css">
</head>
<body>
  <?php
    define('header', TRUE);
    include ('../include/header.php')
  ?>
  <main>
    <div class="text-container">
      <p class="title">
        Library Hours
      </p>
      <p class="subtitle">
        To serve you better, we are now open for onsite transaction. 
          <span class="bold">Monday</span> to <span class="bold">Friday</span> 8:00 A.M to 5:00 P.M
      </p>
    </div>
  </main>
</body>
</html>