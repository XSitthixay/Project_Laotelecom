<<<<<<< HEAD
<?php
include 'connect_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
        exit();
    } else {
        $error = "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
=======
>>>>>>> 6c20be354e622da167c762960f1ecfdb4bc0b1d1

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <!-- style register -->
    <link rel="stylesheet" href="css/style_register.css">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">


              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Please enter your email and password!</p>

              <?php if(isset($error)) { echo '<div class="alert alert-danger">'.$error.'</div>'; } ?>

              <form action="index.php" method="POST">
                <div data-mdb-input-init class="form-outline form-white mb-4">
                  <input type="email" id="typeEmailX" name="email" class="form-control form-control-lg" required />
                  <label class="form-label" for="typeEmailX">Email</label>
                </div>

                <div data-mdb-input-init class="form-outline form-white mb-4">
                  <input type="password" id="typePasswordX" name="password" class="form-control form-control-lg" required />
                  <label class="form-label" for="typePasswordX">Password</label>
                </div>

                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
              </form>

              <div class="d-flex justify-content-center text-center mt-4 pt-1
