<?php 
  session_start();
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
  <title>Admin Dashboard - Books Available</title>
</head>

<body>
  <nav class="navbar text-dark navbar-expand-lg bg-dark mr-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Books R Us / Admin Dashboard/ Books Available</a>
      </div>
    </div>
  </nav>
  <table class="table mt-5">
    <thead class="bg-dark text-white">
      <tr>
        <th scope="col">Book Title</th>
        <th scope="col">Status</th>
        <th scope="col">No of books</th>
        <th scope="col">Creation Date</th>
        <th scope="col">Last Updated</th>
        <th scope="col">Action</th>
      </tr>
    </thead class="text-dark">
    <tbody>
    <?php 
      foreach ($paginated_data as $book_data) {
        echo '<tr>';
        echo '<th scope="col" id="category-name">' . $book_data['title'] . '</th>';
        echo '<th scope="col">' . $book_data['status'] . '</th>';
        echo '<th scope="col">' . $book_data['number_of_copies'] . '</th>';
        echo '<th scope="col">' . $book_data['created_date'] . '</th>';
        echo '<th scope="col">' . $book_data['last_updated'] . '</th>';
        echo '<th scope="col"><div class="d-grid gap-2 d-md-block">
        <button class="btn btn-primary" id="edit" type="button">Edit</button>
        <button class="btn btn-danger"id="delete" type="button">Delete</button>
      </div></th>';
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
<script>
  var category_to_be_edited = document.querySelectorAll('#edit');
    category_to_be_edited.forEach(category => {
    category.addEventListener('click',(e)=>{
        updated_category = prompt('Enter new authors name');
        if (updated_category !== null && updated_category.trim() !== '') {
            console.log(updated_category);
            console.log(category);
            category.parentNode.parentNode.parentNode.firstChild.innerHTML = updated_category.toUpperCase();
        } else {
            alert('Authors name cannot be empty');
        }
    });
});

document.querySelectorAll('#delete').forEach(element => {
  element.addEventListener('click', (e)=>{
    e.preventDefault();
    alert ('Confirm you want to delete the data')
    element.parentNode.parentNode.parentNode.style.display = 'none'
  })
});

</script>
</body>
</html>
