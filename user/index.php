<?php
    session_start();
    include '../xhr/books_available.php';
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
      <a class="navbar-brand" href="#">Books R Us / Books Available</a>
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
              <a class="nav-link" href="search_book.php">Search Book</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="../xhr/logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <table class="table mt-5">
    <thead class="bg-dark text-white">
      <tr>
        <th scope="col">Book Title</th>
        <th scope="col">Book Author</th>
        <th scope="col">Issue Date</th>
        <th scope="col">Return Date</th>
        <th scope="col">Status</th>
      </tr>
    </thead class="text-dark">
    <tbody>
    <?php foreach ($paginated_data as $book_data) {
      echo '<tr>';
      echo '<th scope="col">' . $book_data['title'] . '</th>';
      echo '<th scope="col">' . $book_data['author'] . '</th>';
      echo '<th scope="col">' . $book_data['issue_date'] . '</th>';
      echo '<th scope="col">' . $book_data['return_date'] . '</th>';
      echo '<th scope="col">' . $book_data['status'] . '</th>';
    }
    ?>
    </tbody>
  </table>

  <ul class="pagination">
    <?php for ($page=0; $page < $total_pages; $page++) { 
       echo "<li class='page-item me-4'><a href='?page=$page' class='page-link'";
       if ($page == $current_page);
       echo ">$page</a>";
    }?>
  </ul>
</body>

</html>