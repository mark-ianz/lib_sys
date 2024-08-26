<?php
  if (!isset ($_SESSION)) {
    session_start();
  }

  include_once ('../connection/connection.php');
  $conn = connect();

  include_once ('../util/functions.php');

  $formalLibrary = "a";
  if (isset ($_GET ['lib'])) {
    $library = $_GET ['lib'];
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
        $formalLibrary = "a";
    }
  } 

  if (isset ($_GET ['sort'])) {
    $sort = $_GET ['sort'];
    switch ($sort) {
      case "book_title":
        $formalSort = "Book Title";
        break;
      case "book_author":
        $formalSort = "Author";
        break;
      case "book_category":
        $formalSort = "Category";
        break;
      case "book_stocks":
        $formalSort = "Stocks";
        break;
      default:
        $formalSort = "Sort by";
    }
  } else {
    $sort = 'book_title';
  }

  if (isset ($_GET ['order']) && strtoupper($_GET ['order']) == 'ASC' ) {
    $order = 'ASC';
  } else if (!isset ($_GET ['order'])) {
    $order = 'ASC';
  } else {
    $order = 'DESC';
  }

  unset ($_SESSION ['selected-book-id']);

  /* QUERY BOOKS */
  if (isset ($_GET ['search'])) {
    $search = $_GET ['search'];
    $sql = "SELECT * FROM `books` 
      WHERE book_title LIKE '%$search%' 
      OR isbn LIKE '%$search%' 
      OR book_author LIKE '%$search%' 
      OR book_category LIKE '%$search%' 
      OR book_published LIKE '%$search%' 
      ORDER BY 'book_title' ASC";
    $books = $conn->query($sql) or die ($conn->error);
    $row = $books->fetch_assoc();
    $booksCount = $books->num_rows;
  } else {
    $sql = "SELECT * FROM `books` WHERE library LIKE '%$formalLibrary%' ORDER BY `$sort` $order ;";
    $books = $conn->query($sql) or die ($conn->error);
    $row = $books->fetch_assoc();
    $booksCount = $books->num_rows;
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
  <link rel="stylesheet" href="../css/main-bottom.css">
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
    <form action="<?php $_SERVER ['PHP_SELF'] ?>" method="post" class="main-bottom">       
      <div class="user-control">
        <p class="subtitle blue bold">
          List of books
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
          name="submit">
          Reserve Selected Books
        </button>
      </div>
      <p class="error-message js-err-msg"></p>
      <div class="book-list">
        <?php if ($booksCount > 0) { do { ?>
        <div class="book-container">
          <div class="library js-library">
            <input type="checkbox" class="checkbox js-cb" name="book[<?php echo $row ['book_id'] ?>]">
            <p>
              <?php echo $row ['library'] ?> Library
            </p>
          </div>
          <a href="./books.php?id=<?php echo $row ['book_id'] ?>" class="default-anchor flex-grow flex-row">
            <div class="book-image-container">
              <img src="/lib_sys/<?php echo $row ['book_image'] ?>" class="book-image">
            </div>
            <div class="book-info">
              <p class="book-title">
                <?php echo $row ['book_title'] ?>
              </p>
              <p class="details subtext">
                Author: <?php echo $row ['book_author'] ?>
              </p>
              <p class="details subtext">
                Category: <?php echo $row ['book_category'] ?>
              </p>
              <p class="details subtext">
                Published on: <?php echo date_format(date_create($row ['book_published']), 'Y') ?>
              </p>
              <p class="details subtext">
                ISBN: <?php echo $row ['isbn'] ?>
              </p>
              <p class="stocks orange subtext">
                Available: (<?php echo $row ['book_stocks'] ?>)
              </p>
            </div>
          </a>
          <?php if ($row ['book_stocks'] <= 0) { ?>
            <a href="./books.php?id=<?php echo $row ['book_id'] ?>">
              <div class="out-of-stock">
                <p>
                  Out of stock
                </p>
              </div>
            </a>
          <?php } ?>
        </div>
        <?php } while ($row = $books->fetch_assoc()); } else { ?>
          <p>
            No books found.
          </p>
        <?php } ?>
      </div>
    </form>
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

<?php
  if (isset ($_POST['submit'])) {
    if (isset ($_POST ['book'])) {
      $selectedBooks = $_POST['book'];
      $_SESSION ['selected-book-id'] = implode (',',array_keys($selectedBooks));
      echo "<script>location.href = \"./borrow-confirmation.php\"</script>";
    } else {
      echo "<script>displayError (\"No books selected.\")</script>";
    }
  };
?>

