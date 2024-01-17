<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
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
            padding: 15px;
            text-align: center;
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

        .btn-primary {
            background-color: #333;
            color: #fff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #555;
        }

        .back-button {
            display: block;
            position: absolute;
            top: 15px;
            left: 15px;
            padding: 10px;
            background-color: #444;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <h1>Welcome <?php echo $user['name']; ?>!</h1>
        <a href="home.php" class="back-button">Back</a>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <p>You are now logged in. Enjoy your experience!</p>
                        <a href="logout.php" class="btn btn-primary btn-block">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
