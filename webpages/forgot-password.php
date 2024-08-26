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

  $toSubmitCode = false; 
  if (isset ($_SESSION ['password-code']) && isset ($_SESSION ['temp-email'])) {
    $toSubmitCode = true;
    $email = $_SESSION ['temp-email'];
  };

  if (isset ($_SESSION ['email'])) {
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
    <?php if (!$toSubmitCode) { ?>
    <form action="<?php $_SERVER ['PHP_SELF'] ?>" method="post" >
      <div class="container">
        <p class="title bold white">
          FORGOT PASSWORD
        </p>
        <div class="input">
          <input type="text" name="email" class="auth-input" placeholder="ENTER EMAIL" required>
          <p class="err-msg js-err-msg white"></p>
        </div>
        <div class="submit white">
          <button class="submit-button" type="submit" name="email-submit">
            Send Code
          </button>
        </div>
      </div>
    </form>
    <?php } else if ($toSubmitCode) { ?>
      <form action="<?php $_SERVER ['PHP_SELF'] ?>" method="post" >
        <div class="container">
          <p class="title bold white">
            SUBMIT CODE
          </p>
          <p>
            Enter the code that we sent on <span class="bold"><?php echo $email; ?></span>
          </p>
          <div class="input">
            <input type="text" name="code-input" class="auth-input" placeholder="ENTER CODE" required>
            <p class="err-msg js-err-msg white"></p>
          </div>
          <div class="submit white">
            <button class="submit-button" type="submit" name="code-submit">
              Submit Code
            </button>
          </div>
        </div>
      </form>
    <?php } ?>
  </main>
  <script src="../script/forgot-password.js"></script>
</body>
</html>

<?php
  if (isset ($_POST ['email-submit'])) {
    $email = $_POST ['email'];

    $_SESSION ['temp-email'] = $email;

    $code = rand(100000,999999);

    sendCode($email, $code);
    $_SESSION ['password-code'] = $code;
    header ("Location: ".$_SERVER ['PHP_SELF']);
  };

  if (isset ($_POST ['code-submit'])) {
    /* WILL VALIDATE THE CODE */
    $code = $_SESSION ['password-code'];
    $codeInput = $_POST ['code-input'];

    if ($code == $codeInput) {
      $email = $_SESSION ['temp-email'];
      $sql = "SELECT * FROM library_members WHERE email = '$email'";
      $student = $conn->query($sql) or die ($conn->error);
      $row = $student->fetch_assoc();

      unset ($_SESSION ['password-code']);

      $_SESSION ['user-id'] = $row ['id'];
      $_SESSION ['access'] = $row ['access'];
      $_SESSION ['student-id'] = $row ['student_id'];
      $_SESSION ['fname'] = $row ['first_name'];
      $_SESSION ['lname'] = $row ['last_name'];
      $_SESSION ['email'] = $row ['email'];
      header("Location: /lib_sys/webpages/change-password.php?id=".$_SESSION ['user-id']);
      unset ($_SESSION ['temp-email'], $_SESSION['password-code']);
    } else {
      $maxTry = 3;
      $_SESSION ['tries']++;
      
      if ($_SESSION ['tries'] >= $maxTry) {
        echo "<script>displayError (\"Maximum tries has been reached. Try again later.\")</script>";
        unset ($_POST ['email'], $_SESSION ['password-code'], $_POST ['temp-email'], $_SESSION ['tries']); 
        header("Refresh: 5; url=/lib_sys/index.php");
        exit;
      }

      header("Location: ".$_SERVER['PHP_SELF']);
    }
  }
?>

