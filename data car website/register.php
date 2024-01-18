<?php
session_start();

include('db.php');

$db = new Database();
$registrationSuccess = false; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    $role = 'customer';

    $db->addNewCustomer($name, $password, $email, $role);

    $registrationSuccess = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body class="bg-light">

    <div class="navbar navbar-dark bg-dark" style="height: 65px;">
        <a href="home.php" class="back-button">Back</a>
        <a class="navbar-brand mx-auto" href="#" style="font-size: 24px; line-height: 65px;">Register</a>
    </div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <?php if ($registrationSuccess): ?>
                            <div class="alert alert-success" role="alert" id="registrationSuccessMessage">
                                Successfully registered! Please <a href="login.php">log in here</a>.
                            </div>
                        <?php endif; ?>

                        <h2 class="card-title text-center">User Registration</h2>

                        <form method="POST" action="" class="needs-validation" novalidate>
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" class="form-control" required>
                                <div class="invalid-feedback">
                                    Please enter your name.
                                </div>
                            </div>
                            <div class="form-group">
                            <label for="email">Email:</label>
                             <input type="email" name="email" class="form-control" required>
                             <div class="invalid-feedback">
                             Please enter your email.
                              </div>
                          </div>

                            
                                       

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" class="form-control" required>
                                <div class="invalid-feedback">
                                    Please enter your password.
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(document).ready(function () {
            $('form').validate();
        });
    </script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .navbar {
            background-color: #333;
            color: #fff;
            padding: 25px;
            text-align: center;
        }

        .navbar-brand {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .back-button {
            position: absolute;
            top: 0;
            left: 0;
            padding: 10px;
            background-color: #444;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .container {
            margin-top: 5rem;
        }

        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .btn-primary {
            background-color: #333;
            color: #fff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #555;
        }
    </style>

</body>

</html>
