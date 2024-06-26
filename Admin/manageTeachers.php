<?php
  session_start();
  if (!isset($_SESSION["loggedInA"]) || $_SESSION["loggedInA"] !== true) {
    header("Location: ../index_admin.php");
    exit;
  }
  $host = "localhost";
$user = "root";
$password = "";
$db = "presentseek";

$con = mysqli_connect($host, $user, $password, $db);

if (isset($_POST['submitS'])) {

  $uname = $_POST['user'];
  $password = $_POST['pass'];
  $name = $_POST['name'];
  $mail = $_POST['email'];
  $phone = $_POST['phone'];
  $area = $_POST['area'];
  $position = $_POST['position'];
  $experience = $_POST['exp'];

  $sql = "select `user` from loginformteacher; ";
  $result = mysqli_query($con, $sql);
  $rows = mysqli_fetch_array($result);

  foreach ($rows as $value) {
    if ($value == $uname) {
      echo "<script>alert('User with same credentials Exist');
      window.location.replace('manageTeachers.php');
      </script>";
      exit();
    }
    if ($uname=="") {
      echo "<script>alert('Invalid Credentials');
      window.location.replace('manageTeachers.php');
      </script>";
      exit();
    }
  }

  $sql2 = "INSERT INTO `loginformteacher`(`user`, `pass`, `name`, `email`, `phone`, `position`,`experience`,`area_of_expertise`) VALUES ('$uname','$password','$name','$mail','$phone','$position','$experience','$area')";
  mysqli_query($con, $sql2);

  echo "<script>alert('User Added Successfully');
    window.location.replace('manageTeachers.php');
    </script>";
    exit();
}

if (isset($_POST['submitU'])) {

  $user = $_POST['user'];
  $pass = $_POST['pass'];

  $uquery = "UPDATE `loginformteacher` SET `pass`='$pass' WHERE `user`=$user";
  mysqli_query($con, $uquery);

  echo "<script>alert('Credentials Updated Successfully');</script>";
 
}
  ?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.104.2">
  <title>Admin</title>
  <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">
  <link href="../CSS/bootstrap.min.css" rel="stylesheet">
  <link href="../CSS/dashboard.css" rel="stylesheet">
  <link href="../CSS/dash.css" rel="stylesheet">
</head>
<body>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">

<a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#"><strong>Student Attendance</strong></a>

  <button class="navbar-toggler position-absolute d-md-none collapsed" id="BANTI" type="button"
    data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
    aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>


  <ul class="nav justify-content-center form-control form-control-dark w-100 rounded-0 border-0 p-0 bg-dark ">
    <li class="nav-item">
      <a class="nav-link active" href="./index.php">Home</a>

    </li>
    <li class="nav-item">
      <a class="nav-link text-light" href="../features.html">Features</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light" href="../about.html">About Us</a>
    </li>
    <li>
      <a class="nav-link btn text-light" id="signout" onclick="signOut()">Sign out</a>
    </li>
  </ul>
</header>
  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3 sidebar-sticky">

        <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
<!--            <span>Key functionalities</span>-->
          </h6>

          <ul class="nav flex-column">
          <li class="nav-item">
              <a class="nav-link" href="./dashboard.php">
                <span data-feather="home" class="align-text-bottom"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./manageStudents.php">
                <span data-feather="shopping-cart" class="align-text-bottom"></span>
                Manage Students
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="./manageTeachers.php">
                <span data-feather="user-plus" class="align-text-bottom"></span>
                Manage Teachers
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./addBranches.php">
                <span data-feather="file" class="align-text-bottom"></span>
                Add Branches
              </a>
            </li>
            
          </ul>
          <hr>
        
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="accordion mt-4" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                aria-expanded="true" aria-controls="collapseOne">
                Add Teachers
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
              data-bs-parent="#accordionExample">
              <div class="accordion-body">
              <form method="POST">
                  <div>
                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">User ID:<span class="star">*</span></label>
                      <input name="user" type="number" class="form-control" id="roll" required>
                    </div>

                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Name:<span class="star">*</span></label>
                      <input name="name" type="text" class="form-control" id="name" required>
                    </div>

                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Password:<span class="star">*</span></label>
                      <input name="pass" type="password" class="form-control" id="pass" required>
                      <span id="show-password" class="fa fa-eye-slash password-eye-icon"></span>
                    </div>

                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Position:<span class="star">*</span></label>
                      <input name="position" type="text" class="form-control" id="position" required>
                    </div>

                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Experience:<span class="star">*</span></label>
                      <input name='exp' type="text" class="form-control" id="Experience" required>
                    </div>

                    

                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Areas of Expertise:<span class="star">*</span></label>
                      <input name='area' type="text" class="form-control" id="Experience" required>
                    </div>

                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Email:<span class="star">*</span></label>
                      <input name="email" type="email" class="form-control" id="Email" required>
                    </div>

                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Phone:<span class="star">*</span></label>
                      <input name="phone" type="number" class="form-control" id="phone" required>
                    </div>

                  </div>

                  <button name="submitS" type="submit" class="btn btn-primary">Save</button>

                </form>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Reset Teachers Password
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
              data-bs-parent="#accordionExample">
              <div class="accordion-body">
              <form method="POST">
                  <div>
                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">User ID:<span class="star">*</span></label>
                      <input name="user" type="number" class="form-control" id="roll" required>
                    </div>

                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">New Password:<span class="star">*</span></label>
                      <input name="pass" type="password" class="form-control" id="pass" required>
                      <span id="show-password" class="fa fa-eye-slash password-eye-icon"></span>
                    </div>
                  </div>
                  <button name="submitU" type="submit" class="btn btn-primary">Save</button>
                </form>
              </div>
            </div>
          </div>
        </div>   
        </main>
    </div>
  </div>

  <script src="../JS/bootstrap.bundle.min.js"></script>
  <script src="../JS/dashboard.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
    integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE"
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
    integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha"
    crossorigin="anonymous"></script>

  <script>
    function signOut() {
      fetch('signout.php')
        .then(response => {
          if (response.ok) {
            // redirect to login page
            window.location = '../index.php';
          }
        });
    }
  </script>
  
</body>
</html>