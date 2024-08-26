<?php
  function generateOption ($selectedLib) {
    $library = [
      'San Bartolome',
      'San Francisco',
      'Batasan'
    ];
    foreach ($library as $lib) {
      if ($selectedLib == $lib) {
        echo "
          <option value=\"$lib\" selected>
            $lib
          </option>
        ";
      } else {
        echo "
          <option value=\"$lib\">
            $lib
          </option>
        ";
      }
    }
  }

  

  function generateCategory ($selected) {
    $categoryList = [
      'Action and adventure',
      'Art/architecture',
      'Alternate history',
      'Autobiography',
      'Anthology',
      'Biography',
      'Business/economics',
      'Chick lit',
      'Children\'s',
      'Crafts/hobbies',
      'Classic',
      'Crime',
      'Cookbook',
      'Comic book',
      'Coming-of-age',
      'Diary',
      'Dictionary',
      'Drama',
      'Encyclopedia',
      'Fairytale',
      'Fantasy',
      'Guide',
      'Graphic novel',
      'Health/fitness',
      'History',
      'Home and garden',
      'Historical fiction',
      'Humor',
      'Horror',
      'Information Technology',
      'Journal',
      'Math',
      'Mystery',
      'Memoir',
      'Novel',
      'Paranormal romance',
      'Picture book',
      'Philosophy',
      'Poetry',
      'Prayer',
      'Productivity',
      'Political thriller',
      'Review',
      'Religion, spirituality, and new age',
      'Romance',
      'Relationship',
      'Satire',
      'Science',
      'Science fiction',
      'Self help',
      'Suspense',
      'Short story',
      'Textbook',
      'Thriller',
      'True crime',
      'Sports and leisure',
      'Travel',
      'True crime',
      'Western',
      'Young adult'
    ];
    foreach ($categoryList as $category) {
      if ($selected == $category) {
        echo "
          <option value=\"$category\" selected>
            $category
          </option>
        ";
      } else {
        echo "
          <option value=\"$category\">
            $category
          </option>
        ";
      }
    }
  }
?>