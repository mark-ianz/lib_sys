<?php
  if (!isset ($_SESSION)) {
    session_start();
  }

  include_once ('../connection/connection.php');
  $conn = connect();

  $userID = $_GET ['id'];

  $sql = "SELECT * FROM library_members WHERE `id` = '$userID'";
  $student = $conn->query($sql) or die ($conn->error);
  $studentRow = $student->fetch_assoc();
  $totalStudent = $student->num_rows;

  if (!$totalStudent > 0) {
    header("Location: /lib_sys/index.php");
  }

  $sql = "SELECT * FROM borrowed_books WHERE borrower_id = '$userID'";
  $borrowedBooks = $conn->query($sql) or die ($conn->error);
  $borrowedBookRow = $borrowedBooks->fetch_assoc();
  $totalBorrowed = $borrowedBooks->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    define('head', TRUE);
    include ('../include/head.php');
  ?>
  <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
  <?php
    define('header', TRUE);
    include ('../include/header.php')
  ?>
  <main>
    <div class="container">
      <div class="user-container">
        <div class="profile-info">
          <p class="title">
            <?php
              if (isset ($_SESSION ['user-id']) && $_SESSION ['user-id'] == $userID) {
                echo "Your Profile";
              } else {
                echo $studentRow ['first_name'].'\'s Profile';
              }
            ?>
          </p>
          <p>
            Name: <?php echo $studentRow ['first_name'].' '.$studentRow ['last_name'] ?>
          </p>
          <p>
            Student ID: <?php echo $studentRow ['student_id'] ?>
          </p>
          <p>
            Email: <?php echo $studentRow ['email'] ?>
          </p>
        </div>
        <div class="hr"></div>
        <div class="borrowed-books">
          <p class="title">
            Borrowed Books
          </p>

          <?php if ($totalBorrowed > 0) {?>
            <ol class="book-list">
              <?php $counter = 1; ?>
              <?php do { ?>
                <?php
                  /* GET BOOK INFO OF CURRENT QUERY */
                  $bookID = $borrowedBookRow ['book_id'];
                  $sql = "SELECT * FROM books WHERE book_id = '$bookID'";
                  $books = $conn->query($sql) or die ($conn->error);
                  $bookRow = $books->fetch_assoc();
                ?>
                <li>
                  <div class="book-title-container">
                    <p>
                      <?php echo $counter.'.' ?>
                    </p>
                    <a href="./books.php?id=<?php echo $bookRow ['book_id'] ?>" class="default-anchor bold">
                      <?php echo ' '. $bookRow ['book_title'] ?>
                    </a>
                  </div>
                  <p>
                    Due Date: 
                    <?php 
                      $borrowedDate = $borrowedBookRow ['borrowed_date'];
                      echo $dueDate = date('F d, Y', strtotime($borrowedDate . ' +3 day'));
                    ?>
                  </p>
                </li>
              <?php $counter++; } while ($borrowedBookRow = $borrowedBooks->fetch_assoc()) ?>
            </ol>
          <?php } else { ?>
            <p>No borrowed books found.</p>
          <?php } ?>
        </div>
      </div>
      <a href="/lib_sys/index.php" class="close-button">
        x
      </a>
    </div>
  </main>
  <script>
    
  </script>
</body>
</html> 