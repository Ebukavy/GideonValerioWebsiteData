<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: home.php");
    exit();
}

include('db.php');
$db = new Database();

// Admin Logout
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Handle form submissions
if (isset($_POST['addCustomer'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    // Add logic to insert the new customer into the database
    $db->addNewCustomer($name, $password);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add your head content here -->
    <style>
        /* Add your CSS styling here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1, h2 {
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            margin-bottom: 15px;
            padding: 8px;
            width: 100%;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 15px;
        }

        li p {
            margin: 0;
        }
    </style>
</head>
<body>

    <h1>Admin Dashboard</h1>

    <h2>All Reservations</h2>
    <?php
    $allReservations = $db->getAllReservations();

    if ($allReservations) {
        echo '<ul>';
        foreach ($allReservations as $reservation) {
            echo '<li>';
            echo '<p><strong>Customer/Admin:</strong> ' . $reservation['name'] . '</p>';
            echo '<p><strong>Car Model:</strong> ' . $reservation['model'] . '</p>';
            echo '<p><strong>Rental Date:</strong> ' . $reservation['rental_date'] . '</p>';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo 'No reservations available.';
    }
    ?>

    <!-- View All Customers -->
    <h2>All Customers</h2>
    <?php
    $allCustomers = $db->getAllCustomers();

    if ($allCustomers) {
        echo '<ul>';
        foreach ($allCustomers as $customer) {
            echo '<li>';
            echo '<p><strong>Name:</strong> ' . $customer['name'] . '</p>';
            echo '<p><strong>Email:</strong> ' . $customer['email'] . '</p>';
            // Add other customer details to display
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo 'No customers in the database.';
    }
    ?>

    <!-- Add New Customer Form -->
    <h2>Add New Customer</h2>
    <form method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <input type="submit" name="addCustomer" value="Add Customer">
    </form>

</body>
</html>
