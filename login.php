<?php 
include 'connect_db.php';

if (isset($_POST['login'])) {
    $username_or_email = $_POST['username_or_email'];
    $password = isset($_POST['password']) ? md5($_POST['password']) : '';
    $permission = $_POST['radio_permission'];

    // Set up the base query based on user type
    if ($permission == 'admin') {
        $query = "SELECT * FROM admins WHERE (admin_username = '$username_or_email' OR admin_email = '$username_or_email') AND admin_password = '$password' AND status = 'active'";
    } elseif ($permission == 'saler') {
        $query = "SELECT * FROM saler WHERE email = '$username_or_email' AND status = 'active'";
    } else { // permission == 'accountant'
        $query = "SELECT * FROM accountant WHERE email = '$username_or_email' AND status = 'active'";
    }

    $result = mysqli_query($conn, $query);
    $result_num = mysqli_num_rows($result);

    if ($result_num == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['status'] == 'active') {
            echo '<script>window.location.href="dashboard.php"</script>';
        } else {
            echo '<script>alert("Your account is inactive. Please contact support."); window.location.href="login.php"</script>';
        }
    } else {
        echo '<script>alert("Invalid login credentials."); window.location.href="login.php"</script>';
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- style login -->
    <!-- <link rel="stylesheet" href="css/style_login.css"> -->

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <style>
        body {
            font-family: 'Noto Sans', sans-serif;
            background-color:  #283747;
        }
    </style>
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5">

                            <form action="" method="post">
                                <div class="mb-md-5 mt-md-4">
                                    <h2 class="fw-bold mb-2 text-uppercase text-center">Login</h2>
                                    <p class="text-white-50 mb-5 text-center">Please enter your login credentials!</p>
                                    <div class="form-white mb-4">
                                        <h6 class="mb-4 text-center">Login as:</h6>
                                        <div class="row">
                                            <!-- <div class="col-4">
                                                <label class="form-label">Login as:</label>
                                            </div> -->

                                            <div class="col-4">
                                                <input class="form-check-input" type="radio" name="radio_permission" checked value="admin">
                                                <span style="margin-left: 5px;">Admin</span>
                                            </div>

                                            <div class="col-4">
                                                <input class="form-check-input" type="radio" name="radio_permission" value="saler">
                                                <span style="margin-left: 5px;">Saler</span>
                                            </div>

                                            <div class="col-4">
                                                <input class="form-check-input" type="radio" name="radio_permission" value="accountant">
                                                <span style="margin-left: 5px;">Accountant</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-white mb-4">
                                        <label class="form-label" for="typeEmailX">Username or Email</label>
                                        <input type="text" id="typeEmailX" class="form-control form-control-md" required name="username_or_email"/>
                                    </div>

                                    <div class="form-outline form-white mb-5" id="passwordDiv">
                                        <label class="form-label" for="typePasswordX">Password</label>
                                        <input type="password" id="typePasswordX" class="form-control form-control-md" name="password"/>
                                    </div>

                                    <div class="text-center">
                                        <button class="btn btn-outline-light btn-md px-5" type="submit" name="login">Login</button>
                                    </div>

                                </div>
                            </form>

                            <div class="text-center">
                                <p class="mb-0">Not registered? <a href="register.php" class="text-white-50 fw-bold">Click here to register</a></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.querySelectorAll('input[name="radio_permission"]').forEach((elem) => {
            elem.addEventListener("change", function(event) {
                var item = event.target.value;
                if (item === "admin") {
                    document.getElementById("passwordDiv").style.display = "block";
                    document.getElementById("typePasswordX").required = true;
                } else {
                    document.getElementById("passwordDiv").style.display = "none";
                    document.getElementById("typePasswordX").required = false;
                }
            });
        });

        window.onload = function() {
            var checkedValue = document.querySelector('input[name="radio_permission"]:checked').value;
            if (checkedValue === "admin") {
                document.getElementById("passwordDiv").style.display = "block";
                document.getElementById("typePasswordX").required = true;
            } else {
                document.getElementById("passwordDiv").style.display = "none";
                document.getElementById("typePasswordX").required = false;
            }
        }
    </script>
</body>

</html>
