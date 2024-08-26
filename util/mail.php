<?php
  if (!defined('mail')) {
    header("Location: ../index.php");
  }
  //Import PHPMailer classes into the global namespace
  //These must be at the top of your script, not inside a function
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  function sendCode ($address, $code) {
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
      //Server settings
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'code.email.verifyer@gmail.com';                     //SMTP username
      $mail->Password   = 'ubriczqrnylitgtg';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
      $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom('from@example.com', 'QCU Library Management System');
      $mail->addAddress($address);               //Name is optional

      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Verification Code';
      $mail->Body    = 'Your verification code is <b>'.$code.'</b>';
      $mail->AltBody = 'Your verification code is'.$code;

      $mail->send();
    } catch (Exception $e) {
      echo "An error occured when sending the email. Please try again later.";
    }
  }
?>
