<?php
  if (!defined('main-top-nav')) {
    header("Location: /lib_sys/index.php");
  }

  if (!isset ($_GET['order'])) {
    $order = 'asc';
  }

  if (isset ($_GET ['order']) && strtoupper($_GET ['order']) == 'ASC' ) {
    $order = 'desc';
  } else {
    $order = 'asc';
  }
?>



<link rel="stylesheet" href="/lib_sys/css/main-top.css">

<div class="main-top">
  <div class="library-nav">
    <p>
      <?php
      if (isset($library)) {
        echo $formalLibrary." Library";
      } else {
        echo "All Libraries";
      }
      ?>
      <img src="/lib_sys/images/arrow-down.svg" class="arrow-down">
    </p>
    <ul class="dropdown-list">
      <li>
        <a href="/lib_sys/webpages/view-books.php" class="default-anchor">
          All Libraries
        </a>
      </li>
      <li>
        <a href="/lib_sys/webpages/view-books.php?lib=batasan" class="default-anchor">
          Batasan Library
        </a>
      </li>
      <li>
        <a href="/lib_sys/webpages/view-books.php?lib=san-bartolome" class="default-anchor">
          San Bartolome Library
        </a>
      </li>
      <li>
        <a href="/lib_sys/webpages/view-books.php?lib=san-francisco" class="default-anchor">
          San Francisco Library
        </a>
      </li>
    </ul>
  </div>

  <div class="sort-by">
    <p>
      <?php if (isset($formalSort)) {
        echo "Sorted by ". $formalSort;
      } else {
        echo "Sort by";
      } ?>
      <img src="/lib_sys/images/arrow-down.svg" class="arrow-down">
    </p>
    <ul class="dropdown-list">
      <li>
        <a href="/lib_sys/webpages/view-books.php?sort=book_title&order=<?php echo $order ?><?php if (isset($library)) {
            echo "&lib=" . $library;
          } ?>"
          class="default-anchor">
          Book Name
        </a>
      </li>
      <li>
        <a href="/lib_sys/webpages/view-books.php?sort=book_author&order=<?php echo $order ?><?php if (isset($library)) {
            echo "&lib=" . $library;
          } ?>"
          class="default-anchor">
          Author
        </a>
      </li>
      <li>
        <a href="/lib_sys/webpages/view-books.php?sort=book_category&order=<?php echo $order ?><?php if (isset($library)) {
            echo "&lib=" . $library;
          } ?>"
          class="default-anchor">
          Category
        </a>
      </li>
      <li>
        <a href="/lib_sys/webpages/view-books.php?sort=book_stocks&order=<?php echo $order ?><?php if (isset($library)) {
            echo "&lib=" . $library;
          } ?>"
          class="default-anchor">
          Stocks
        </a>
      </li>
    </ul>
  </div>
  <form action="/lib_sys/webpages/view-books.php?>" method="get" class="body-search-form">
    <input type="search" name="search" class="search body-search-input" placeholder="Search books, authors, ISBN, category, published date...">
    <button class="body-search-button test" type="submit" name="submit">
      <img src="/lib_sys/images/search.svg" class="search-image invert">
    </button>
  </form>
</div>

