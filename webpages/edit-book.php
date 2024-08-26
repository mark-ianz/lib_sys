<?php
  if (!isset ($_SESSION)) {
    session_start();
  }

  if (!isset ($_SESSION ['access']) || $_SESSION ['access'] == 'student') {
    header("Location: /lib_sys/index.php");
  }

  include_once ('../connection/connection.php');
  $conn = connect();

  include_once ('../util/functions.php');

  $bookID = $_GET ['id'];
  $sql = "SELECT * FROM books WHERE book_id = '$bookID'";
  $book = $conn->query($sql) or die ($conn->error);
  $row = $book->fetch_assoc();
  $total = $book->num_rows;

  if ($total <= 0) {
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
  <link rel="stylesheet" href="../css/view-books.css">
  <link rel="stylesheet" href="../css/main-bottom.css">
  <link rel="stylesheet" href="../css/books.css">
  <link rel="stylesheet" href="../css/add-books.css">
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
    <div class="main-bottom">  
      <div class="add-book-container">
        <p class="title">
          Edit Book
        </p>
        <form action="<?php $_SERVER ['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" class="form">
          <div class="input-container">
            <label for="title" class="label">Title</label>
            <input 
              <?php echo "value="."\"". $row ['book_title']."\""?>
            type="text" id="title" name="title">
          </div>
          <div class="input-container">
            <label for="author" class="label" >Author</label>
            <input 
              <?php echo "value="."\"". $row ['book_author']."\""?>
            type="text" id="author" name="author">
          </div>
          <div class="input-container">
            <label for="category" class="label" >Category</label>
            <select name="category" id="category">
              <?php
                generateCategory($row ['book_category']);
              ?>
            </select>
          </div>
          <div class="input-container">
            <label for="published-date" class="label" >Published date</label>
            <input
              <?php echo "value="."\"". $row ['book_published']."\""?>
            type="date" id="published-date" name="published-date">
          </div>
          <div class="input-container">
            <label for="library" class="label" >Library</label>
            <select id="library" name="library">
              <?php generateOption ($row ['library']) ?>
            </select>
          </div>
          <div class="input-container">
            <label for="stocks" class="label">Stocks</label>
            <input 
              <?php echo "value="."\"". $row ['book_stocks']."\""?>
            type="number" id="stocks" name="stocks">
          </div>
          <div class="input-container">
            <label for="isbn" class="label" >ISBN</label>
            <input
              <?php echo "value="."\"". $row ['isbn']."\""?>
            type="text" id="isbn" name="isbn" placeholder="Format: 9780789560995">
          </div>
          <div class="input-container">
            <label for="book-image" class="label" >Upload new image</label>
            <input type="file" id="book-image" name="book-image">
          </div>
          <p class="error-message js-error-message"></p>
          <div class="submit-container">
            <button name="submit" class="submit">
              Submit
            </button>
          </div>
        </form>
      </div>
      <div class="close-button js-cb">
        x
      </div>   
    </div>    
  </main>
  <script src="../script/add-books.js"></script>
</body>
</html>

<?php
  if (isset ($_POST ['submit'])) {
    $isbn = $_POST ['isbn'];
    $library = $_POST ['library'];
    $title = $_POST ['title'];
    $author = $_POST ['author'];
    $published = $_POST ['published-date'];
    $category = $_POST ['category'];
    $stocks = $_POST ['stocks'];

    if ($_FILES ['book-image']['size'] == 0) {
      $sql = "UPDATE `books` 
        SET `isbn` = '$isbn', 
        `library` = '$library', 
        `book_title` = '$title', 
        `book_author` = '$author', 
        `book_published` = '$published', 
        `book_category` = '$category', 
        `book_stocks` = '$stocks' 
        WHERE `books`.`book_id` = '$bookID'";
    } else {
      $file = $_FILES ['book-image'];
      $file_name = $file['name'];
      $tmp_name = $file ['tmp_name'];
      
      $file_name_seperator = explode('.', $file_name);
      $extension = end($file_name_seperator);
      $allowed_extension = ['jpeg', 'jpg', 'png','webp'];

      if (in_array($extension, $allowed_extension)) {
        $image_name = "BOOK_".strtoupper(uniqid()).'.'.$extension;
        $upload_image = "images/books/".$image_name;
        $folder_upload = "../".$upload_image;
        move_uploaded_file($tmp_name, $folder_upload);

        $sql = "UPDATE `books` 
          SET `isbn` = '$isbn', 
          `library` = '$library', 
          `book_title` = '$title', 
          `book_author` = '$author', 
          `book_published` = '$published', 
          `book_category` = '$category', 
          `book_image` = '$upload_image', 
          `book_stocks` = '$stocks' 
          WHERE `books`.`book_id` = '$bookID'";
      } else {
        echo "<script>displayError (\"Only PNG/JPG/JPEG/WEBP files are allowed.\")</script>";
        return;
      }
    }

    $conn->query($sql) or die ($conn->error);
    echo "<script>location.href = \"/lib_sys/webpages/books.php?id=$bookID\"</script>";
  }
?>