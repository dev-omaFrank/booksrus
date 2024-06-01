<?php
$parsed_json = '';
 if (isset($_POST['book_search'])) {
    $json_path = '../config/dump/search.json';
    $json_data_str = file_get_contents($json_path);
    $parsed_json = json_decode($json_data_str, true);
    $searched_str = $_POST['book_search'];
    $search_results = array_filter($parsed_json, function($parsed_json) use ($searched_str){
      return stripos($parsed_json['title'], $searched_str) !== false;
    });

    header('Content-Type: application/json');
    echo json_encode($search_results);
  }
?>