<?php
    session_start();
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
    }
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../assets/css/bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Admin Dashboard</title>
</head>


<body>

  <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none;background-color:#212529;color:#fff;" id="mySidebar" >
    <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
    <a href="users.php" class="w3-bar-item w3-button" style="margin:20px;">Users</a>
    <a href="category.php" class="w3-bar-item w3-button" style="margin:20px;">Category</a>
    <a href="authors-available.php" class="w3-bar-item w3-button" style="margin:20px;">Author</a>
    <a href="location.php" class="w3-bar-item w3-button" style="margin:20px;">Location Rack</a>
    <a href="books_available.php" class="w3-bar-item w3-button" style="margin:20px;">Books Available</a>
    <a href="../xhr/logout.php" class="w3-bar-item w3-button" style="margin:20px;">Logout</a>
  </div>

  <div id="main">
    <div class="w3-teal">
      <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
      <div class="w3-container">
        <h1>Welcome <?php echo $email;?></h1>
      </div>
    </div>

    <div class="w3-container" style="margin-left: 10%;display: flex;width: 90%;margin-top:5%;">
      <div class="card-columns" style="display: flex;flex-wrap: wrap;">
        <div class="card bg-primary" style="padding: 50px;
            margin: 5px; width:20vw;
            ">
          <div class="card-body text-center">
            <p class="card-text" style="font-size:xxx-large;">173</p>
            <p class="card-text" style="font-size:large;">Total Book Returned</p>
          </div>
        </div>
        <div class="card bg-warning" style="padding: 50px;
            margin: 5px;width:20vw;
            ">
          <div class="card-body text-center">
            <p class="card-text" style="font-size:xxx-large;">23</p>
            <p class="card-text" style="font-size:large;">Total Book Issued</p>
          </div>
        </div>
        <div class="card bg-success" style="padding: 50px;
            margin: 5px;width:20vw;
            ">
          <div class="card-body text-center">
            <p class="card-text" style="font-size:xxx-large;">24</p>
            <p class="card-text" style="font-size:large;">Total Book Not Returned</p>
          </div>
        </div>
        <div class="card bg-danger" style="padding: 50px;
            margin: 5px;width:20vw;
            ">
          <div class="card-body text-center">
            <p class="card-text" style="font-size:xxx-large;">93</p>
            <p class="card-text" style="font-size:large;">Total FInes Received</p>
          </div>
        </div>
        <div class="card bg-light" style="padding: 50px;
            margin: 5px;width:20vw;
            ">
          <div class="card-body text-center">
            <p class="card-text" style="font-size:xxx-large;">83</p>
            <p class="card-text" style="font-size:large;">Total Book Available</p>
          </div>
        </div>
        <div class="card bg-info" style="padding: 50px;
            margin: 5px;width:20vw;
            ">
          <div class="card-body text-center">
            <p class="card-text" style="font-size:xxx-large;">08</p>
            <p class="card-text" style="font-size:large;">Authors In Store</p>
          </div>
        </div>
        <div class="card bg-info" style="padding: 50px;
            margin: 5px;width:20vw;
            ">
          <div class="card-body text-center">
            <p class="card-text" style="font-size:xxx-large;">78</p>
            <p class="card-text" style="font-size:large;">Available Cateories</p>
          </div>
        </div>
        <div class="card bg-info" style="padding: 50px;
            margin: 5px;width:20vw;
            ">
          <div class="card-body text-center">
            <p class="card-text" style="font-size:xxx-large;">54</p>
            <p class="card-text" style="font-size:large;">Total Location Rack</p>
          </div>
        </div>
      </div>
    </div>
  </div>
    <footer></footer>
  <script>
      var color = document.querySelectorAll('.w3-container')[0].style.backgroundColor
  function w3_open() {
    document.getElementById("main").style.marginLeft = "25%";
    document.getElementById("mySidebar").style.width = "25%";
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("openNav").style.display = 'none';
    document.querySelectorAll('.w3-container')[0].style.backgroundColor = '#212529';
  }

  function w3_close() {
    document.getElementById("main").style.marginLeft = "0%";
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("openNav").style.display = "inline-block";
    document.querySelectorAll('.w3-container')[0].style.backgroundColor = color
  }
  </script>

</body>

</html>