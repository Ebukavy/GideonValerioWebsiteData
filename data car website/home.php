
<?php
session_start();

include('db.php');

$db = new Database();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Company - Your Trusted Auto Partner</title>

    <style>
                body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 15px;
            text-align: center;
            position: relative;
        }

        nav {
            background-color: #444;
            overflow: hidden;
        }

        nav a {
            float: left;
            display: block;
            color: #fff;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #ddd;
            color: #333;
        }

        .hamburger-btn {
            display: none;
            position: absolute;
            top: 15px;
            right: 15px;
            cursor: pointer;
            background: none;
            border: none;
        }

        .hamburger-icon {
            width: 30px;
            height: 20px;
            background-image: url('hamburger.png');
            background-size: cover;
        }

        .hero-section {
            min-height: 75vh;
            background: url('cargif.gif') center center no-repeat;
            background-size: cover;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        .hero-section h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
            font-family: 'YourFancyFont', sans-serif;
            animation: colorSwitch 3.5s infinite;
        }

        @keyframes colorSwitch {
            0% {
                color: white;
            }

            50% {
                color: black;
            }

            100% {
                color: white;
            }
        }

        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .welcome-message {
            position: absolute;
            top: 15px;
            right: 15px;
            color: #fff;
            font-weight: bold;
        }

        .logout-btn {
            background-color: #333;
            color: #fff;
            padding: 8px 12px;
            margin-top: 5px;
            border: none;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #555;
        }

        nav a.cart-btn {
            float: right;
            background-color: #3498db;
            color: #fff;
        }

        nav a.cart-btn:hover {
            background-color: #2980b9;
        }

        @media (max-width: 768px) {
            nav {
                display: none;
            }

            .hamburger-btn {
                display: block;
            }
        }
    </style>
</head>

<body>

    <header>
        <button class="hamburger-btn" onclick="toggleMenu()">
            <div class="hamburger-icon"></div>
        </button>
        <h1>Auto Company</h1>

        <?php
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            echo '<div class="welcome-message">Welcome, ' . $user['name'] . '!';
            echo '<form action="logout.php" method="post" style="display:inline;">
                  <input type="submit" class="logout-btn" value="Logout">
                  </form>';
            echo '</div>';
        }
        ?>
    </header>

    <nav id="navbar">
        <a href="home.php">Home</a>

        <?php
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if ($user['Role'] == 'admin') {
                echo '<a href="admin.php">Admin Dashboard</a>';
            }
        }
        ?>

        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>

        <?php
        if (!isset($_SESSION['user'])) {
            echo '<a href="register.php">Register</a>';
            echo '<a href="login.php">Login</a>';
        } else {
            echo '<a href="buy.php">Rent</a>';
            echo '<a href="viewcart.php" class="cart-btn">Cart</a>';
        }
        ?>

    </nav>

     <div class="hero-section">
        <h2>Your Trusted Auto Partner</h2>
    </div>
    <footer class="footer">
        &copy; 2023 Auto Company. All rights reserved.
    </footer>

    <script>
        function toggleMenu() {
            var navbar = document.getElementById("navbar");
            navbar.style.display = (navbar.style.display === "block") ? "none" : "block";
        }
    </script>
</body>

</html>
