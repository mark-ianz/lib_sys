<?php
  if (!isset ($_SESSION)) {
    session_start();
  }

  if (!isset ($_SESSION ['selected-book-id'])) {
    header("Location: /lib_sys/webpages/view-books.php");
  }

  include_once ('../connection/connection.php');
  $conn = connect();

  include_once ('../util/functions.php');

  
  if (isset ($_GET ['lib'])) {
    $library = $_GET ['lib'];
    $formalLibrary;
    switch ($library) {
      case "batasan":
        $formalLibrary = "Batasan";
        break;
      case "san-bartolome":
        $formalLibrary = "San Bartolome";
        break;
      case "san-francisco":
        $formalLibrary = "San Francisco";
        break;
      default:
        $formalLibrary = "All Libraries";
    }
  }

  if (isset ($_GET ['sort'])) {
    $sort = $_GET ['sort'];
    $formalSort;
    switch ($sort) {
      case "book_name":
        $formalSort = "Book Name";
        break;
      case "author":
        $formalSort = "Author";
        break;
      case "genre":
        $formalSort = "Genre";
        break;
      case "stocks":
        $formalSort = "Stocks";
        break;
      default:
        $formalSort = "Sort by";
    }
  }

  $referenceNumber = rand(1000000000, 9999999999);

  $selected_book_id = $_SESSION ['selected-book-id'];
  $selected_book_id_array = explode (',',$selected_book_id);

  $sql = "SELECT * FROM `books` WHERE book_id IN ($selected_book_id)";
  $books = $conn->query($sql) or die ($conn->error);
  $row = $books->fetch_assoc();
  $booksCount = $books->num_rows;

  $success = false;
  if (isset ($_POST ['submit-reservation'])) {
    $userID = $_SESSION ['user-id'];
    foreach ($selected_book_id_array as $book_id) {
      $sql = "INSERT INTO `borrowed_books` (`borrowed_id`, `book_id`, `borrower_id`, `reference_number`)
        VALUES (NULL, '$book_id', '$userID', '$referenceNumber')";
      $conn->query($sql) or die ($conn->error);
    }
    $sql = "UPDATE `books` SET `book_stocks` = book_stocks -1 WHERE `book_id` IN ($selected_book_id)";
    $conn->query($sql) or die ($conn->error);
    $success = true;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    define('head', TRUE);
    include ('../include/head.php');
  ?>
  <link rel="stylesheet" href="../css/view-books.css">
  <link rel="stylesheet" href="../css/borrow-confirmation.css">
  <link rel="stylesheet" href="../css/main-bottom.css">

</head>
<body>
  <?php
    define('header', TRUE);
    include ('../include/header.php')
  ?>

  

  <main>
    <?php if (!$success) { ?>
      <?php
        define('main-top-nav', TRUE);
        include ('../include/main-top-nav.php');
      ?>
      <form action="./borrow-confirmation.php" method="post" class="main-bottom">       
        <div class="user-control">
          <p class="subtitle blue bold">
            Reserve Confirmation
          </p>
          <button
            <?php
              if (!isset ($_SESSION ['email'])) {
                echo "type=\"button\"";
                echo "class=\"borrow-button js-borrow-button\"";
              } else {
                echo "type=\"submit\"";
                echo "class=\"borrow-button\"";
              }
            ?>
            name="submit-reservation">
            Confirm Reservation!
          </button>
        </div>
        <div class="confirmation-container">
          <div class="borrowed-book-list">
            <div class="left">
              <p>
                List of Books to Borrow
              </p>
            </div>
            <div class="right">
              <?php do { ?>
                <p>&#x2022 <?php echo $row ['book_title'] ?></p>
              <?php } while ($row = $books->fetch_assoc()) ?>
            </div>
          </div>
          <div class="reservation-details">
            <div class="top">
              <p>
                Reservation Details
              </p>
            </div>
            <div class="bottom">
              <p>
                Reference number: <?php echo $referenceNumber ?>
              </p>
              <p>
                Pickup Hours: 8:00 A.M - 5:00 P.M (Monday - Saturday)
              </p>
              <p>
                Due Date: <?php 
                $currentDate = date ('F d, Y');
                echo $dueDate = date('F d, Y', strtotime($currentDate . ' +3 day'));
                ?>
              </p>
            </div>
          </div>
        </div>
        <p class="error-message js-err-msg"></p>
      </form>
    <?php } else {?>
      <div class="message">
        <img src="../images/circle-check-solid.svg" class="check">
        <p class="white message-title">
          Reservation was successful
        </p>
        <p>
          Will redirected to home page in 5 seconds.
        </p>
      </div>
      <?php
        header("Refresh: 5; url=/lib_sys/index.php");
        unset ($_SESSION ['selected-book-id']);
        exit;
      ?>
    <?php } ?>
  </main>
  <div class="modal-bg">
    <div class="modal-container">
      <p class="title">
        Login to Library System
      </p>
      <p>
        Oops! It looks like you need to log in to access this feature. Please log in or create an account to continue.
      </p>
      <div class="option">
        <a href="./login.php">
          <button>
            LOGIN
          </button>
        </a>
        <a href="./register.php">
          <button>
            SIGNUP
          </button>
        </a>
      </div>        
      <a href="<?php echo $_SERVER ['REQUEST_URI'] ?>" class="close-button default-anchor">
        <p>x</p>
      </a>
    </div>
  </div>
  <script src="../script/view-books.js"></script>
</body>
</html>

