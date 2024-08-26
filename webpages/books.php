<?php
  if (!isset ($_SESSION)) {
    session_start();
  }

  include_once ('../connection/connection.php');
  $conn = connect();

  include_once ('../util/functions.php');

  $bookID = $_GET ['id'];
  $sql = "SELECT * FROM books WHERE book_id = '$bookID'";
  $book = $conn->query($sql) or die ($conn->error);
  $row = $book->fetch_assoc();
  $queried = $book->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    define('head', TRUE);
    include ('../include/head.php');
  ?>
  <link rel="stylesheet" href="../css/view-books.css">
  <link rel="stylesheet" href="../css/main-bottom.css">
  <link rel="stylesheet" href="../css/books.css">
</head>
<body>
  <?php
    define('header', TRUE);
    include ('../include/header.php')
  ?>
  <main>
    <?php
      define('main-top-nav', TRUE);
      include ('../include/main-top-nav.php');
    ?>
    <?php if ($queried > 0) { ?> 
      <div class="main-bottom">  
        <div class="book-main-container">
          <div class="image-container">
            <img src="../<?php echo $row ['book_image'] ?>" class="book-image">
          </div>
          <div class="viewed-book-info">
            <p class="bold subtitle">
              <?php echo $row ['book_title'] ?>
            </p>
            <p>
              Category: <?php echo $row ['book_category'] ?>
            </p>
            <p>
              Author: <?php echo $row ['book_author'] ?>
            </p>
            <p>
              Published on: <?php echo date_format(date_create($row ['book_published']), 'Y') ?>
            </p>
            <?php if ($row ['book_stocks'] > 0) {?>
              <p>
                Stocks: <?php echo $row ['book_stocks'] ?>
              </p>
            <?php } else { ?>
              <p class="bold orange">
                Out of Stock
              </p>
            <?php } ?>
            <?php if (isset ($_SESSION ['access']) && $_SESSION ['access'] == 'librarian') { ?>
              <a href="./edit-book.php?id=<?php echo $bookID ?>">
                Edit Book
              </a>
            <?php } ?>
          </div>
        </div>  
        <div class="close-button js-cb">
          x
        </div>   
      </div>
    <?php } else { ?>
      <p>
        Book not found.
      </p>
    <?php } ?>
  </main>
  <script src="../script/books.js"></script>
</body>
</html>