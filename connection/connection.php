<?php
  function connect () {
    $host = 'localhost';
    $username = 'root';
    $password = '1q!2w@3e#';
    $db = 'lib_sys';

    $conn = new mysqli($host, $username, $password, $db);

    if ($conn->connect_error) {
      echo "There was an connection error. Please try again later.";
    } else {
      return $conn;
    }
  }
?>