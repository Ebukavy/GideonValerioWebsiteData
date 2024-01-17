<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteModel'])) {
    $modelToDelete = $_POST['deleteModel'];
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['model'] === $modelToDelete) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
    }
    header("Location: viewcart.php");
    exit();
} else {
    header("Location: home.php");
    exit();
}
?>
