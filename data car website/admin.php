<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: home.php");
    exit();
}

include('db.php');
$db = new Database();

if (isset($_POST['addCustomer'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $db->addNewCustomer($name, $password);
}

if (isset($_POST['deleteReservation'])) {
    $reservationId = $_POST['deleteReservation'];
    $db->deleteReservation($reservationId);
}

if (isset($_POST['deleteCustomer'])) {
    $customerId = $_POST['deleteCustomer'];
    $db->deleteCustomer($customerId);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
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

        .back-to-home {
            margin-top: 20px;
        }

        .back-to-home button {
            padding: 10px 15px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-to-home button:hover {
            background-color: #555;
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
    <div class="back-to-home">
        <form method="get" action="home.php">
            <button type="submit">Back to Home Page</button>
        </form>
    </div>

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
            echo '<p><strong>ID:</strong> ' . $reservation['user_id'] . '</p>';
            echo '<form method="post" action="admin.php">';
            echo '<input type="hidden" name="deleteReservation" value="' . $reservation['user_id'] . '">';
            echo '<input type="submit" value="Delete Reservation">';
            echo '</form>';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo 'No reservations available.';
    }
    ?>

    <h2>All Customers</h2>
    <?php
    $allCustomers = $db->getAllCustomers();

    if ($allCustomers) {
        echo '<ul>';
        foreach ($allCustomers as $customer) {
            echo '<li>';
            echo '<p><strong>Name:</strong> ' . $customer['name'] . '</p>';
            echo '<p><strong>Email:</strong> ' . $customer['email'] . '</p>';
            echo '<form method="post" action="admin.php">';
            echo '<input type="hidden" name="deleteCustomer" value="' . $customer['ID'] . '">';
            echo '<input type="submit" value="Delete Customer">';
            echo '</form>';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo 'No customers in the database.';
    }
    ?>

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
