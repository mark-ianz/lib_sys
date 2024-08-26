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
  <link rel="stylesheet" href="../css/register-login.css">
</head>
<body>
  <?php
    define('header', TRUE);
    include ('../include/header.php')
  ?>
  <main>
    <div class="left white">
      <img src="../images/logo/QCU_Logo.png" class="body-logo">
      <p class="subtitle text-align-center">
        Welcome to QCU
        <br> Library System!
      </p>
      <p class="white text-align-center">
        If you do not have an account yet, <br> we invite you to register now.
      </p>
      <a href="./register.php">
        <button class="submit-button">
          Register here
        </button>
      </a>
    </div>
    <form action="<?php $_SERVER ['PHP_SELF'] ?>" method="post" class="right">
      <p class="title bold white">
        LOG IN TO LIBRARY SYSTEM
      </p>
      <div class="input">
        <input type="text" name="email" class="auth-input" placeholder="ENTER EMAIL" required>
        <input type="password" name="password" class="auth-input js-password" placeholder="ENTER PASSWORD" required>
        <div class="show-password">
          <input type="checkbox" class="js-show-pw-cb">
          <p class="js-show-pw-text">Show Password</p>
        </div>
        <p class="err-msg js-err-msg orange"></p>
      </div>
      <div class="submit white">
        <a href="./forgot-password.php" class="default-anchor">
          FORGOT PASSWORD?
        </a>
        <button class="submit-button" type="submit" name="submit">
          LOG IN
        </button>
      </div>
    </form>
  </main>
  <script src="../script/login.js"></script>
</body>
</html>

<?php
  if (isset ($_POST ['submit'])) {
    $email = $_POST ['email'];
    $password = $_POST ['password'];

    $sql = "SELECT * FROM library_members WHERE `email` = '$email'";
    $accounts = $conn->query($sql) or die ($conn->error);
    $count = $accounts->num_rows;
    $row = $accounts->fetch_assoc();

    if ($count > 0) {
      if ($row ['email'] == $email && password_verify($password, $row ['password'])) {
        $_SESSION ['user-id'] = $row ['id'];
        $_SESSION ['access'] = $row ['access'];
        $_SESSION ['student-id'] = $row ['student_id'];
        $_SESSION ['fname'] = $row ['first_name'];
        $_SESSION ['lname'] = $row ['last_name'];
        $_SESSION ['email'] = $row ['email'];
        header("Location: /lib_sys/index.php");
      } else {
        echo "<script>displayError (\"Incorrect Password\")</script>";
      }
    } else {
      echo "<script>displayError (\"Incorrect Email\")</script>";
    }
  }
?>