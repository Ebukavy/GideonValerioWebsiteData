<?php
session_start();

include('db.php');

$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = $_POST["identifier"];
    $password = $_POST["password"];

    $user = $db->loginUser($identifier, $password);

    if ($user) {
        $_SESSION['user'] = $user;
        $_SESSION['admin'] = ($user['Role'] == 'admin');
        header("Location: loggedin.php");
        exit();
    } else {
        echo "Login failed. Please check your username or email and password.";
    }
}

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Login</title>
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

            .welcome-message {
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 20px;
            }
        </style>
    </head>

    <body>
        <div class="navbar">
            <h1>Login</h1>
            <a href="home.php" class="back-button">Back</a>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="welcome-message">
                                Welcome, <?php echo $user['name']; ?>!
                            </div>
                            <form method="post" action="logout.php">
                                <button type="submit">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
    <?php
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Login</title>
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
            <h1>Login</h1>
            <a href="home.php" class="back-button">Back</a>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title text-center">User Login</h2>
                            <form method="post" action="" class="needs-validation" novalidate>
                                <div class="form-group">
                                    <label for="identifier">Username:</label>
                                    <input type="text" name="identifier" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Please enter your username.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Please enter your password.
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
    <?php
}
?>
