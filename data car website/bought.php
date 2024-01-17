<?php
session_start();

if (isset($_GET['action']) && $_GET['action'] == 'buy' && isset($_GET['model']) && isset($_GET['price'])) {
    $model = urldecode($_GET['model']);
    $price = urldecode($_GET['price']);
    $_SESSION['cart'][] = array('model' => $model, 'price' => $price);
    echo "Successfully added to cart: $model, $price";
} else {
    echo "Invalid request.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Successfully Added to Cart</title>
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
            text-align: center;
        }

        a {
            text-decoration: none;
            color: #008CBA;
        }
    </style>
</head>

<body>

    <header>
        <a href="home.php" style="float: left; padding: 10px;">Back</a>
        <h1>Successfully Added to Cart</h1>
    </header>

    <section>
        <p>Your selected item has been added to the cart.</p>
        <a href="viewcart.php">View Cart</a>
    </section>

</body>

</html>
