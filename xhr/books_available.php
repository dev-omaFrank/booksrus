<?php

  if (isset($_SESSION['email'])) {
    $email = $book_title = $book_author = $issue_date = $return_date = $status = '';
    $email = $_SESSION['email'];
    $json_path = '../config/dump/books-available.json';
    $json_data_str = file_get_contents($json_path);
    $parsed_json = json_decode($json_data_str, true);
    $records_per_page = 10;
    $total_pages = ceil(count($parsed_json) / $records_per_page);
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $records_per_page;
    $paginated_data = array_slice($parsed_json, $offset, $records_per_page);
  }else {
   header('Location: ../index.html');
  }
?>