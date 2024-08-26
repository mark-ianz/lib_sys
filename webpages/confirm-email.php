<?php
  if (!isset ($_SESSION)) {
    session_start();
  }

  include_once ('../connection/connection.php');
  $conn = connect();
?>

<?php
  
  $maxTry = 3;

  if (!isset ($_SESSION['temp-email'])) {
    header("Location: /lib_sys/index.php");
  } 

  if (!isset ($_SESSION ['try-counter'])) {
    $_SESSION ['try-counter'] = 1;
  }

  if (isset ($_POST ['submit-code'])) {
    $code_input = $_POST ['code-input'];

    if ($code_input == $_SESSION ['email-code']) {
      $studentID = $_SESSION ['temp-student-id'];
      $fname = $_SESSION ['temp-fname'];
      $lname = $_SESSION ['temp-lname'];
      $email = $_SESSION ['temp-email'];
      $password = $_SESSION ['temp-password'];
      $sql = "INSERT INTO `library_members` (`id`, `student_id`, `first_name`, `last_name`, `email`, `password`,`access`) 
        VALUES (NULL, '$studentID', '$fname', '$lname', '$email', '$password', NULL);";
      $conn->query($sql) or die ($conn->error);

      $sql2 = "SELECT * FROM library_members WHERE email = '$email'";
      $library_members = $conn->query($sql2) or die ($conn->error);
      $row = $library_members->fetch_assoc();

      $_SESSION ['user-id'] = $row ['id'];
      $_SESSION ['student-id'] = $row ['student_id'];
      $_SESSION ['fname'] = $row ['first_name'];
      $_SESSION ['lname'] = $row ['last_name'];
      $_SESSION ['email'] = $row ['email'];
      $_SESSION ['password'] = $row ['password'];
      unset ($_SESSION['email-code'],
        $_SESSION ['try-counter'],
        $_SESSION ['temp-student-id'], 
        $_SESSION ['temp-fname'],
        $_SESSION ['temp-lname'],
        $_SESSION ['temp-email'],
        $_SESSION ['temp-password']);
      header("Location: /lib_sys/index.php");

    } else if ($_SESSION ['try-counter'] >= 3) {
      unset ($_SESSION ['try-counter']);
    } else {
      $_SESSION ['try-counter']++;
      header("Location: ".$_SERVER ['PHP_SELF']);
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    define('head', TRUE);
    include ('../include/head.php');
  ?>
  <link rel="stylesheet" href="../css/confirm-email.css">
</head>
<body>
  <?php
    define('header', TRUE);
    include ('../include/header.php')
  ?>
  <main>
    <div class="text-container">
    <?php if (isset ($_SESSION ['try-counter']) && $_SESSION ['try-counter'] <= 3) { ?>
      <p class="title">
        2nd Step: Email Verification
      </p>
      <p class="subtitle">
        Input below the code that we sent on
        <span class="bold">
          <?php echo $_SESSION ['temp-email'] ?>
        </span>
      </p>
      <p>
        You have maximum of (<?php echo $maxTry?>) tries.
      </p>
      <form action="<?php $_SERVER ['REQUEST_URI'] ?>" method="post" class="code-submit">
        <input type="text" name="code-input" placeholder="Verification Code" class="code-input" required minlength="6" maxlength="6">
        <button class="submit-button" name="submit-code">
          Register!
        </button>
      </form>
      <?php } else { 
        unset ($_SESSION['email-code'],
        $_SESSION ['temp-student-id'], 
        $_SESSION ['temp-fname'],
        $_SESSION ['temp-lname'],
        $_SESSION ['temp-password']);
      ?>
        <p class="title">
          Max try has been reached.
        </p>
        <p>
          Will redirected to home page in 5 seconds.
        </p>
        <?php
          header("Refresh: 5; url=/lib_sys/index.php");
          unset ($_SESSION ['try-counter'], $_SESSION ['temp-email']);
          exit;
        ?>
      <?php } ?>
    </div>
  </main>
  <script src="../script/confirm-email.js"></script>
</body>
</html>