<?php 
  session_start();
  include '../xhr/search_book.php';
  if (isset($_SESSION['email'])) {
    $email = $book_title = $book_author = $issue_date = $return_date = $status = '';
    $email = $_SESSION['email'];
    $json_path = '../config/dump/search.json';
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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../assets/css/bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>User Dashboard</title>
</head>
<body>
  <nav class="navbar text-dark navbar-expand-lg bg-dark mr-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Books R Us / Search Books</a>
      <div class="d-flex">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <p class="nav-link text-white">Hello <?php echo $email?></p>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="index.php">My History</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="../xhr/logout.php">Logout</a>
            </li>
          </ul>
        </div>
     
      </div>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" name="book_search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </nav>
  <table class="table mt-5">
    <thead class="bg-dark text-white">
      <tr>
        <th scope="col">Book Title</th>
        <th scope="col">Book Author</th>
        <th scope="col">Category</th>
        <th scope="col">Shelf Location</th>
        <th scope="col">Copies Available</th>
        <th scope="col">Status</th>
      </tr>
    </thead class="text-dark">
    <tbody>
    <?php foreach ($paginated_data as $book_data) {
      echo '<tr>';
      echo '<td scope="col">' . $book_data['title'] . '</td>';
      echo '<td scope="col">' . $book_data['author'] . '</td>';
      echo '<td scope="col">' . $book_data['category'] . '</td>';
      echo '<td scope="col">' . $book_data['location'] . '</td>';
      echo '<td scope="col">' . $book_data['number_of_copies'] . '</td>';
      echo '<td scope="col">' . $book_data['status'] . '</td>';
      echo '</tr>';
    }
    ?>
    </tbody>
  </table>

  <ul class="pagination justify-content-center">
    <?php for ($page=0; $page < $total_pages; $page++) { 
       echo "<li class='page-item me-4'><a href='?page=$page' class='page-link'";
       if ($page == $current_page);
       echo ">$page</a>";
    }?>
  </ul>

<script src="../assets/js/handlers/search-book.js"></script>
</body>

</html>