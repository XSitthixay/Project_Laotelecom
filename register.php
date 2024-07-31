<?php 
include 'connect_db.php';

if (isset($_POST['register'])) {
    $permission = $_POST['radio_permission'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = isset($_POST['password']) ? md5($_POST['password']) : '';
    $created_at = date('Y-m-d'); // Adding the created_at field

    // Check if email already exists
    $email_check_query = "(SELECT admin_email AS email FROM admins WHERE admin_email='$email') 
                          UNION 
                          (SELECT email FROM saler WHERE email='$email') 
                          UNION 
                          (SELECT email FROM accountant WHERE email='$email')";
    $result = mysqli_query($conn, $email_check_query);

    if (mysqli_num_rows($result) > 0) {
        echo '<script>alert("Error: Email already exists."); window.location.href="register.php"</script>';
    } else {
        if ($permission == 'admin') {
            $query = "INSERT INTO admins (admin_name, admin_username, admin_email, admin_password, created_at) VALUES ('$name', '$username', '$email', '$password', '$created_at')";
        } elseif ($permission == 'saler') {
            $query = "INSERT INTO saler (name, contact, email, status) VALUES ('$name', '$contact', '$email', 'active')";
        } else {
            $query = "INSERT INTO accountant (name, contact, email, status) VALUES ('$name', '$contact', '$email', 'active')";
        }

        if (mysqli_query($conn, $query)) {
            echo '<script>alert("Registration successful!"); window.location.href="login.php"</script>';
        } else {
            echo '<script>alert("Error: Could not register."); window.location.href="register.php"</script>';
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- style register -->
    <link rel="stylesheet" href="css/style_register.css">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <style>
        body {
            font-family: 'Noto Sans', sans-serif;
            background-color: #283747;
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
                                    <h2 class="fw-bold mb-2 text-uppercase text-center">Register</h2>
                                    <p class="text-white-50 mb-5 text-center">Please enter your details to register!</p>
                                    <div class="form-white mb-4">
                                        <div class="row">
                                            <div class="col-4">
                                                <label class="form-label">Register as:</label>
                                            </div>

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

                                    <div class="form-white mb-4" id="nameDiv">
                                        <label class="form-label" for="typeNameX">Name</label>
                                        <input type="text" id="typeNameX" class="form-control form-control-md" name="name" required/>
                                    </div>

                                    <div class="form-white mb-4" id="contactDiv">
                                        <label class="form-label" for="typeContactX">Contact</label>
                                        <input type="text" id="typeContactX" class="form-control form-control-md" name="contact" required/>
                                    </div>

                                    <div class="form-white mb-4" id="usernameDiv">
                                        <label class="form-label" for="typeUsernameX">Username</label>
                                        <input type="text" id="typeUsernameX" class="form-control form-control-md" name="username" required/>
                                    </div>

                                    <div class="form-white mb-4">
                                        <label class="form-label" for="typeEmailX">Email</label>
                                        <input type="email" id="typeEmailX" class="form-control form-control-md" required name="email"/>
                                    </div>

                                    <div class="form-outline form-white mb-5" id="passwordDiv">
                                        <label class="form-label" for="typePasswordX">Password</label>
                                        <input type="password" id="typePasswordX" class="form-control form-control-md" name="password" required/>
                                    </div>

                                    <div class="text-center">
                                        <button class="btn btn-outline-light btn-md px-5" type="submit" name="register">Register</button>
                                    </div>

                                </div>
                            </form>

                            <div class="text-center">
                                <p class="mb-0">Already registered? <a href="login.php" class="text-white-50 fw-bold">Login here</a></p>
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
                    document.getElementById("usernameDiv").style.display = "block";
                    document.getElementById("passwordDiv").style.display = "block";
                    document.getElementById("contactDiv").style.display = "none";
                    document.getElementById("typeContactX").required = false;
                    document.getElementById("typeUsernameX").required = true;
                    document.getElementById("typePasswordX").required = true;
                } else {
                    document.getElementById("usernameDiv").style.display = "none";
                    document.getElementById("passwordDiv").style.display = "none";
                    document.getElementById("contactDiv").style.display = "block";
                    document.getElementById("typeContactX").required = true;
                    document.getElementById("typeUsernameX").required = false;
                    document.getElementById("typePasswordX").required = false;
                }
            });
        });

        window.onload = function() {
            var checkedValue = document.querySelector('input[name="radio_permission"]:checked').value;
            if (checkedValue === "admin") {
                document.getElementById("usernameDiv").style.display = "block";
                document.getElementById("passwordDiv").style.display = "block";
                document.getElementById("contactDiv").style.display = "none";
                document.getElementById("typeContactX").required = false;
                document.getElementById("typeUsernameX").required = true;
                document.getElementById("typePasswordX").required = true;
            } else {
                document.getElementById("usernameDiv").style.display = "none";
                document.getElementById("passwordDiv").style.display = "none";
                document.getElementById("contactDiv").style.display = "block";
                document.getElementById("typeContactX").required = true;
                document.getElementById("typeUsernameX").required = false;
                document.getElementById("typePasswordX").required = false;
            }
        }
    </script>
</body>

</html>
