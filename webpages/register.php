<?php
  if (!isset ($_SESSION)) {
    session_start();
  }

  include_once ('../connection/connection.php');
  $conn = connect();

  define('mail', TRUE);
  include_once ('../util/mail.php');
  //Load Composer's autoloader
  require '../PHPMailer/src/PHPMailer.php';
  require '../PHPMailer/src/SMTP.php';
  require '../PHPMailer/src/Exception.php';
  require '../vendor/autoload.php'; 
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
        If you already have an account,<br>kindly proceed to log in now.
      </p>
      <a href="./login.php">
        <button class="submit-button">
          Login here
        </button>
      </a>
    </div>
    <form action="<?php $_SERVER ['PHP_SELF'] ?>" method="post" class="right js-reg-form">
      <p class="title bold white">
        REGISTER TO LIBRARY SYSTEM
      </p>
      <div class="input">
        <input type="text" 
          <?php
            if (isset ($_POST ['student-id'])) {
              echo "value="."\"".$_POST ['student-id']."\"";
            }
          ?>
        name="student-id" class="auth-input" placeholder="ENTER STUDENT ID" required>
        <div class="name-input">
          <input type="text" 
            <?php
            if (isset ($_POST ['fname'])) {
              echo "value="."\"".$_POST ['fname']."\"";
            }
            ?>
          name="fname" class="auth-input" placeholder="FIRST NAME" required>
          <input type="text" 
            <?php
            if (isset ($_POST ['lname'])) {
              echo "value="."\"".$_POST ['lname']."\"";
            }
            ?>
          name="lname" class="auth-input" placeholder="LAST NAME" required>
        </div>
        <input type="email" name="email" class="auth-input" placeholder="ENTER EMAIL" required>
        <div class="password-input">
          <input type="password" 
            <?php
              if (isset ($_POST ['password'])) {
                echo "value="."\"".$_POST ['password']."\"";
              }
            ?>
          name="password" class="auth-input js-password" placeholder="PASSWORD" min="8" required>
          <input type="password" 
            <?php
              if (isset ($_POST ['confirm-password'])) {
                echo "value="."\"".$_POST ['confirm-password']."\"";
              }
            ?>
          name="confirm-password" class="auth-input js-confirm-password" placeholder="CONFIRM PASSWORD">
        </div>
        <div class="show-password">
          <input type="checkbox" class="js-show-pw-cb">
          <p class="js-show-pw-text">Show Password</p>
        </div>
        <p class="err-msg js-err-msg white"></p>
      </div>
      <div class="submit white">
        <button class="submit-button js-register-button" type="submit" name="submit">
          REGISTER
        </button>
      </div>
    </form>
  </main>
  <script src="../script/register.js"></script>
</body>
</html> 

<?php
  /* REFERENCE FOR REGISTER.PHP */
  if (isset ($_POST ['submit'])) {
    $email = $_POST ['email'];
    $sql = "SELECT * FROM library_members WHERE `email` = '$email'";
    $accounts = $conn->query($sql) or die ($conn->error);
    $count = $accounts->num_rows;

    /* CHECK IF THE USER IS IN STUDENT LIST */

    

    if ($count > 0) {
      echo '<script>displayError ("Email already exist.")</script>';
    } else {
      $_SESSION ['temp-student-id'] = $_POST ['student-id'];
      $_SESSION ['temp-fname'] = $_POST ['fname'];
      $_SESSION ['temp-lname'] = $_POST ['lname'];
      $_SESSION ['temp-email'] = $_POST ['email'];
      $_SESSION ['temp-password'] = password_hash($_POST ['password'], PASSWORD_DEFAULT);
  
      $_SESSION ['email-code'] = rand(100000, 999999);
      sendCode($_SESSION ['temp-email'], $_SESSION ['email-code']);
      echo '<script>location.href = "./confirm-email.php"</script>';
    }
  }
?>