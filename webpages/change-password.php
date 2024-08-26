<?php
  if (!isset ($_SESSION)) {
    session_start();
  }

  include_once ('../connection/connection.php');
  $conn = connect();

  if (!isset($_GET ['id']) || isset ($_SESSION ['user-id']) 
    && isset ($_SESSION ['user-id']) != $_GET ['id'] || !isset ($_SESSION ['user-id'])) {
    header("Location: /lib_sys/index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    define('head', TRUE);
    include ('../include/head.php');
  ?>
  <link rel="stylesheet" href="../css/forgot-password.css">
</head>
<body>
  <?php
    define('header', TRUE);
    include ('../include/header.php')
  ?>
  <main>
    <form action="<?php $_SERVER ['PHP_SELF'] ?>" method="post" class="js-reg-form">
      <div class="container">
        <p class="title bold white">
          CHANGE PASSWORD
        </p>
        <div class="input">
          <input type="password" name="password" class="auth-input js-password" placeholder="ENTER NEW PASSWORD" required>
          <input type="password" name="confirm-password" class="auth-input js-confirm-password" 
          placeholder="CONFIRM NEW PASSWORD" required>
          <div class="show-password">
          <input type="checkbox" class="js-show-pw-cb">
          <p class="js-show-pw-text">Show Password</p>
        </div>
          <p class="err-msg js-err-msg white"></p>
        </div>
        <div class="submit white">
          <button class="submit-button" type="submit" name="submit">
            Change Password
          </button>
        </div>
      </div>
    </form>
  </main>
  <script src="../script/change-password.js"></script>
</body>
</html>

<?php
  if (isset ($_POST ['submit'])) {
    $id = $_GET ['id'];
    $password = password_hash($_POST ['password'], PASSWORD_DEFAULT);

    $sql = "UPDATE `library_members` SET `password` = '$password' 
      WHERE `library_members`.`id` = 3 AND `library_members`.`id` = '$id'";
    $conn->query($sql) or die ($conn->error);
    header("Location: /lib_sys/webpages/profile.php?id=".$_SESSION ['user-id']);
  }
?>

