<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
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
        }

        section {
            padding: 20px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 10px;
            padding: 10px;
            background-color: #fff;
        }

        button {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        button:hover {
            background-color: #c0392b;
        }
    </style>
</head>

<body>

    <header>
        <h1>Shopping Cart</h1>
        <a href="home.php">Back</a>
    </header>

    <section>
        <h2>Your Shopping Cart</h2>

        <?php
        session_start();

        if (!isset($_SESSION['user'])) {
            header("Location: login.php");
            exit();
        }

        $cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

        if (!empty($cartItems)) {
            echo '<ul>';
            foreach ($cartItems as $item) {
                echo '<li>';
                echo '<p><strong>Model:</strong> ' . $item['model'] . '</p>';
                echo '<p><strong>Price:</strong> ' . $item['price'] . '</p>';
                echo '<button onclick="confirmDelete(\'' . $item['model'] . '\')">Delete</button>';
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>Your cart is empty.</p>';
        }
        ?>

    </section>

    <script>
        function confirmDelete(model) {
            if (confirm('Are you sure you want to delete this item?')) {
                var form = document.createElement('form');
                form.method = 'post';
                form.action = 'delete.php';

                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'deleteModel';
                input.value = model;

                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>

</body>

</html>
