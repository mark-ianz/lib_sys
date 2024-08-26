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
          Add Book
        </p>
        <form action="<?php $_SERVER ['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" class="form">
          <div class="input-container">
            <label for="title" class="label" >Title</label>
            <input type="text" id="title" name="title">
          </div>
          <div class="input-container">
            <label for="author" class="label" >Author</label>
            <input type="text" id="author" name="author">
          </div>
          <div class="input-container">
            <label for="category" class="label" >Category</label>
            <select name="category" id="category">
              <?php
                generateCategory("");
              ?>
            </select>
          </div>
          <div class="input-container">
            <label for="published-date" class="label" >Published date</label>
            <input type="date" id="published-date" name="published-date">
          </div>
          <div class="input-container">
            <label for="library" class="label" >Library</label>
            <select id="library" name="library">
              <?php generateOption ("") ?>
            </select>
          </div>
          <div class="input-container">
            <label for="stocks" class="label" >Stocks</label>
            <input type="number" id="stocks" name="stocks" value="0">
          </div>
          <div class="input-container">
            <label for="isbn" class="label" >ISBN</label>
            <input type="text" id="isbn" name="isbn" placeholder="Format: 9780789560995">
          </div>
          <div class="input-container">
            <label for="book-image" class="label" >Book Image</label>
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

      $sql = "INSERT INTO `books` 
        (`book_id`, `isbn`, `library`, `book_title`, `book_author`, `book_published`, `book_category`, `book_image`, `book_stocks`) 
        VALUES (NULL, '$isbn', '$library', '$title', '$author', '$published', '$category', '$upload_image', '$stocks')";
      $conn->query($sql) or die ($conn->error);
      echo "<script>location.href = \"/lib_sys/webpages/view-books.php\"</script>";
    } else {
      echo "<script>displayError (\"Only PNG/JPG/JPEG/WEBP files are allowed.\")</script>";
      return;
    }
  }
?>